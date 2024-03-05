<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\Frontend\PriceRequest;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PriceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $prices = Price::when($search, function ($query, $search)
        {
            return $query->where('service', 'LIKE', '%' . $search . '%')
                ->orWhere('price', 'LIKE', '%' . $search . '%');
        })
            ->sortable(['price' => 'asc'])->paginate(5);

        return view('Frontend.price.view')->with('prices', $prices);
    }

    public function create()
    {
        return view('Frontend.price.priceAdd')->with('editMode', false);
    }

    public function store(PriceRequest $request)
    {

        $price          = new Price;
        $price->service = $request->input('service');
        $price->price   = $request->input('price');
        if  ($request->hasFile('image'))
        {
            $file     = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/gallery', $filename);
            $price->image = $filename;

        }

        $price->save();
        session()->put('add', 'your price was added');

        return redirect(route('price.create'));
    }

    public function edit($id)
    {
        $price = Price::find($id);

        return view('Frontend.price.priceAdd')
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

        session()->put('update', 'your price was updated');
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

    public function view()
    {
        return view('price.priceAdd');
    }
}
