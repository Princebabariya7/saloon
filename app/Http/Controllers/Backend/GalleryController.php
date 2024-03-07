<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\GalleryStoreRequest;
use App\Http\Requests\Backend\GalleryUpdateRequest;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $search    = $request->input('search', '');
        $status    = $request->input('status', '');
        $galleries = Gallery::search($search)->status($status)->sortable()->paginate(10);
        return view('Backend.gallery.index')
            ->with('galleries', $galleries);
    }

    public function create()
    {
        return view('Backend.gallery.form')->with('editMode', false)->with('status', ['' => 'Select one', 'Active' => 'Active', 'Inactive' => 'Inactive']);
    }

    public function store(GalleryStoreRequest $request)
    {
        $gallery             = new gallery;
        $gallery->name       = $request->input('name');
        $gallery->status     = $request->input('status');
        $gallery->created_at = now();
        $gallery->updated_at = now();

        if ($request->hasFile('image'))
        {
            $file     = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/gallery', $filename, 'public');

            $gallery->image = $filename;
        }
        $gallery->save();
        session()->put('add', 'data add');
        return redirect(route('admin.gallery.index'));
    }

    public function show($id)
    {
        $gallery = gallery::find($id);

        return view('Backend.gallery.show', ['gallery' => $gallery]);
    }

    public function edit($id)
    {
        $gallery = gallery::find($id);

        return view('Backend.gallery.form')
            ->with('gallery', $gallery)
            ->with('status', ['' => 'Select one', 'Active' => 'Active', 'Inactive' => 'Inactive'])
            ->with('editMode', true);
    }

    public function update(GalleryUpdateRequest $request, $id)
    {
        $gallery = gallery::find($id);

        $gallery->name   = $request->input('name');
        $gallery->status = $request->input('status');

        if ($request->hasFile('image'))
        {
            $destination = 'uploads/gallery/' . $gallery->image;

            if (File::exists($destination))
            {
                File::delete($destination);
            }
            $file     = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/gallery', $filename);

            $gallery->image = $filename;
        }
        $gallery->update();
        session()->put('update', 'data update');
        return redirect(route('admin.gallery.index'));
    }

    public function destroy($id)
    {
        try
        {
            $gallery     = Gallery::find($id);
            $destination = 'uploads/gallery/' . $gallery->image;

            if (File::exists($destination))
            {
                File::delete($destination);
            }
            $gallery->delete();
            return response()->json(['status' => true, 'message' => 'Record deleted successfully'], 200);
        }
        catch (\Exception $e)
        {
            return response()->json(['status' => false, 'message' => 'Record was not deleted'], 400);
        }
    }
}
