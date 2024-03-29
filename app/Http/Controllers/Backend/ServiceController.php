<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\ServiceStoreRequest;
use App\Http\Requests\Backend\ServiceUpdateRequest;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ServiceController extends Controller
{

    public function index(Request $request)
    {
        $search    = $request->input('search', '');
        $status    = $request->input('status', '');
        $direction = $request->input('direction', 'asc');
        if (!in_array($direction, ['asc', 'desc']))
        {
            $direction = 'asc';
        }

        $query = Service::select(
            'services.id',
            'services.image',
            'categories.type',
            'services.name',
            'services.duration',
            'services.detail',
            'services.price',
            'services.status',
        )
            ->join('categories', 'categories.id', '=', 'services.category_id')
            ->search($search)
            ->status($status);
        if ($request->has('sort') && $request->sort !== '')
        {
            $query->orderBy($request->sort, $direction);
        }
        $services = $query->paginate(10);
        return view('Backend.service.index')
            ->with('services', $services);
    }

    public function create()
    {
        $category = Category::pluck('type', 'id')->toArray();
        return view('Backend.service.form')->with('editMode', false)->with('status', ['' => 'Select one', 'Active' => 'Active', 'Inactive' => 'Inactive'])->with('category', $category);
    }

    public function store(ServiceStoreRequest $request)
    {
        $service = Service::create([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'detail'      => $request->detail,
            'price'       => $request->price,
            'duration'    => $request->duration,
            'status'      => $request->status,
        ]);

        if ($request->hasFile('image'))
        {
            $file     = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/gallery', $filename);
            $service->image = $filename;
            $service->save();
        }

        session()->put('add', 'data add');
        return redirect(route('admin.service.index'));
    }

    public function show($id)
    {
        $service = Service::find($id);

        return view('Backend.service.show', ['service' => $service]);
    }

    public function edit($id)
    {
        $category = Category::pluck('type', 'id')->toArray();

        $service = Service::find($id);
        return view('Backend.service.form')
            ->with('service', $service)
            ->with('status', ['' => 'Select one', 'Active' => 'Active', 'Inactive' => 'Inactive'])
            ->with('editMode', true)
            ->with('category', $category);
    }

    public function update(ServiceUpdateRequest $request, $id)
    {

        $service              = Service::find($id);
        $service->category_id = $request->input('category_id');
        $service->name        = $request->input('name');
        $service->detail      = $request->input('detail');
        $service->price       = $request->input('price');
        $service->duration    = $request->input('duration');
        $service->status      = $request->input('status');

        if ($request->hasFile('image'))
        {
            $destination = 'uploads/gallery/' . $service->image;

            if (File::exists($destination))
            {
                File::delete($destination);
            }

            $file     = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/gallery', $filename);

            $service->image = $filename;
        }
        $service->update();

        session()->put('update', 'data update');
        return redirect(route('admin.service.index'));
    }

    public function destroy($id)
    {
        try
        {
            $service     = Service::find($id);
            $destination = 'uploads/gallery/' . $service->image;
            if (File::exists($destination))
            {
                File::delete($destination);
            }
            $service->delete();


            return response()->json(['status' => true, 'message' => 'Record deleted successfully'], 200);
        }
        catch (\Exception $e)
        {
            return response()->json(['status' => false, 'message' => 'Record was not deleted'], 400);
        }
    }
}
