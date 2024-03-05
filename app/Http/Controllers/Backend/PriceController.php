<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\PriceStoreRequest;
use App\Http\Requests\Backend\PriceUpdateRequest;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PriceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $status = $request->input('status', '');
        $prices = Price::when($search, function ($query, $search)
        {
            return $query->where(function ($query) use ($search)
            {
                $query->orwhere('service', 'LIKE', '%' . $search . '%')
                    ->orWhere('price', 'LIKE', '%' . $search . '%');
            });
        })->when($status, function ($query) use ($status)
        {
            return $query->where('status', $status);
        })->sortable(['price' => 'asc'])->paginate(5);

        return view('Backend.price.index')->with('prices', $prices);
    }

    public function create()
    {
        return view('Backend.price.form')->with('editMode', false);
    }

    public function store(PriceStoreRequest $request)
    {
        $price          = new Price;
        $price->service = $request->input('service');
        $price->price   = $request->input('price');
        $price->status  = $request->input('status');
        if ($request->hasFile('image'))
        {
            $file     = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/gallery', $filename);
            $price->image = $filename;
        }
        $price->save();
        session()->put('add', 'your price was added');
        return redirect(route('admin.price.index'));
    }

    public function show($id)
    {
        $price = Price::find($id);
        return view('Backend.price.show', ['price' => $price]);
    }

    public function edit($id)
    {
        $price = Price::find($id);
        return view('Backend.price.form')
            ->with('price', $price)
            ->with('status', ['' => 'Select one', 'Active' => 'Active', 'Inactive' => 'Inactive'])
            ->with('editMode', true);
    }

    public function update(PriceUpdateRequest $request, $id)
    {
        $price          = Price::find($id);
        $price->price   = $request->input('price');
        $price->service = $request->input('service');
        $price->status  = $request->input('status');

        if ($request->hasFile('image'))
        {
            $destination = 'uploads/gallery/' . $price->image;
            if (File::exists($destination))
            {
                File::delete($destination);
            }
            $file     = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/gallery', $filename);
            $price->image = $filename;
        }
        $price->update();
        session()->put('update', 'your price was updated');
        return redirect(route('admin.price.index'));
    }

    public function destroy($id)
    {
        {
            try
            {
                $price       = Price::find($id);
                $destination = 'uploads/gallery/' . $price->image;
                if (File::exists($destination))
                {
                    File::delete($destination);
                }
                $price->delete();

                return response()->json(['status' => true, 'message' => 'Record deleted successfully'], 200);
            }
            catch (\Exception $e)
            {
                return response()->json(['status' => false, 'message' => 'Record was not deleted'], 400);
            }
        }
    }
}
