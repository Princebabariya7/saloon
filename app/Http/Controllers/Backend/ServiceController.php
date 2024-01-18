<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\ServiceStoreRequest;
use App\Http\Requests\Backend\ServiceUpdateRequest;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $search   = $request->input('search', '');
        $status   = $request->input('status', '');
        $services = Service::when($search, function ($query) use ($search)
        {
            return $query->where(function ($query) use ($search)
            {
                $query->orWhere('service', 'LIKE', '%' . $search . '%')
//                    ->orWhere('category', 'LIKE', '%' . $search . '%')
                ;
            });
        })->when($status, function ($query) use ($status)
        {
            return $query->where('status', $status);
        })->paginate(5);
        return view('Backend.service.index')->with('services', $services);
    }

    public function create()
    {
        $category = Category::pluck('type', 'id')->toArray();
        return view('Backend.service.service_form')->with('editMode', false)->with('status', ['' => 'Select one', 'Active' => 'Active', 'Inactive' => 'Inactive'])->with('category', $category);

    }

    public function store(ServiceStoreRequest $request)
    {
        Service::create([
            'category_id' => $request->category_id,
            'service'     => $request->service,
            'detail'      => $request->detail,
            'price'       => $request->price,
            'duration'    => $request->duration,
            'status'      => $request->status,
            'updated_at'  => now(),
            'created_at'  => now(),
        ]);

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
        return view('Backend.service.service_form')
            ->with('service', $service)
            ->with('status', ['' => 'Select one', 'Active' => 'Active', 'Inactive' => 'Inactive'])
            ->with('editMode', true)
            ->with('category', $category);
    }

    public function update(ServiceUpdateRequest $request, $id)
    {

        $service              = Service::find($id);
        $service->category_id = $request->input('category_id');
        $service->service     = $request->input('service');
        $service->detail      = $request->input('detail');
        $service->price       = $request->input('price');
        $service->duration    = $request->input('duration');
        $service->status      = $request->input('status');
        $service->update();

        session()->put('update', 'data update');
        return redirect(route('admin.service.index'));
    }

    public function destroy($id)
    {
        try
        {
            $service = Service::find($id);
            if ($service)
            {
                $service->delete();
            }

            return response()->json(['status' => true, 'message' => 'Record deleted successfully'], 200);
        }
        catch (\Exception $e)
        {
            return response()->json(['status' => false, 'message' => 'Record was not deleted'], 400);
        }

    }
}
