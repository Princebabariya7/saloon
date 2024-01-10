<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\PackageStoreRequest;
use App\Http\Requests\Backend\PackageUpdateRequest;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $search   = $request->input('search', '');
        $status   = $request->input('status', '');
        $packages = Package::when($search, function ($query) use ($search)
        {
            return $query->where(function ($query) use ($search)
            {
                $query->orWhere('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('price', 'LIKE', '%' . $search . '%');
            });
        })->when($status, function ($query) use ($status)
        {
            return $query->where('status', $status);
        })->paginate(5);
        return view('Backend.package.index')->with('packages', $packages);
    }

    public function create()
    {
        return view('Backend.package.package_form')->with('editMode', false)->with('status', ['' => 'Select one', 'Active' => 'Active', 'Inactive' => 'Inactive']);
    }

    public function store(PackageStoreRequest $request)
    {
        Package::create([
            'name'       => $request->name,
            'price'      => $request->price,
            'detail'     => $request->detail,
            'duration'   => $request->duration,
            'status'     => $request->status,
            'updated_at' => now(),
            'created_at' => now(),
        ]);

        session()->put('add', 'data add');
        return redirect(route('admin.package.index'));
    }

    public function show($id)
    {
        $package = Package::find($id);

        return view('Backend.package.show', ['package' => $package]);
    }

    public function edit($id)
    {
        $package = Package::find($id);

        return view('Backend.package.package_form')
            ->with('package', $package)
            ->with('status', ['' => 'Select one', 'Active' => 'Active', 'Inactive' => 'Inactive'])
            ->with('editMode', true);
    }

    public function update(PackageUpdateRequest $request, $id)
    {


        $package           = Package::find($id);
        $package->name     = $request->input('name');
        $package->price    = $request->input('price');
        $package->detail   = $request->input('detail');
        $package->duration = $request->input('duration');
        $package->status   = $request->input('status');
        $package->update();

        session()->put('update', 'data update');
        return redirect(route('admin.package.index'));


    }

    public function destroy($id)
    {
        try
        {
            $package = Package::find($id);
            if ($package)
            {
                $package->delete();
            }

            return response()->json(['status' => true, 'message' => 'Record deleted successfully'], 200);
        }
        catch (\Exception $e)
        {
            return response()->json(['status' => false, 'message' => 'Record was not deleted'], 400);
        }

    }
}
