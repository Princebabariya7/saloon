<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PriceController extends Controller
{
    public function index()
    {
        return view('price.view')->with('price', Price::all());
    }

    public function create()
    {
        return view('price.priceAdd')->with('editMode', false);
    }

    public function store(Request $request)
    {

        $price          = new Price;
        $price->service = $request->input('service');
        $price->price   = $request->input('price');
        if ($request->hasFile('image'))
        {
            $file     = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/gallery', $filename);
            $price->image = $filename;

        }
        $price->save();
        return redirect(route('price.create'));
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $price = Price::find($id);

        return view('price.priceAdd')
            ->with('price', $price)
            ->with('editMode', true);
    }

    public function update(Request $request, $id)
    {
        $price          = Price::find($id);
        $price->price   = $request->input('price');
        $price->service = $request->input('service');

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


        session()->put('update', 'ok');

        return redirect(route('price.index'));
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
