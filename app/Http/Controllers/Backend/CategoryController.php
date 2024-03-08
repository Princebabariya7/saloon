<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CategoryStoreRequest;
use App\Http\Requests\Backend\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search     = $request->input('search', '');
        $status     = $request->input('status', '');
        $categories = Category::search($search)->status($status)->sortable()->paginate(10);

        return view('Backend.category.index')
            ->with('categories', $categories);
    }


    public function create()
    {
        return view('Backend.category.form')->with('editMode', false)->with('status', ['' => 'Select one', 'Active' => 'Active', 'Inactive' => 'Inactive']);
    }

    public function store(CategoryStoreRequest $request)
    {
        Category::create([
            'type'       => $request->type,
            'status'     => $request->status,
            'updated_at' => now(),
            'created_at' => now(),
        ]);
        session()->put('addCategory', 'data add');
        return redirect(route('admin.category.index'));
    }

    public function show($id)
    {
        $category = Category::find($id);
        return view('Backend.category.show', ['category' => $category]);
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('Backend.category.form')
            ->with('category', $category)
            ->with('status', ['' => 'Select one', 'Active' => 'Active', 'Inactive' => 'Inactive'])
            ->with('editMode', true);
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        $category         = Category::find($id);
        $category->type   = $request->input('type');
        $category->status = $request->input('status');
        $category->update();

        session()->put('update', 'data update');
        return redirect(route('admin.category.index'));
    }

    public function destroy($id)
    {
        try
        {
            $category = Category::find($id);
            if ($category)
            {
                $category->delete();
            }

            return response()->json(['status' => true, 'message' => 'Record deleted successfully'], 200);
        }
        catch (\Exception $e)
        {
            return response()->json(['status' => false, 'message' => 'Record was not deleted'], 400);
        }
    }
}
