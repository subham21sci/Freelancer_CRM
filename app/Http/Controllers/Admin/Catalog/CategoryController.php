<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {

        $category_list = Category::orderBy('id','desc')->get();
        return view('backend.catalog.category.list', compact('category_list'));
    }

    public function catStore(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Kindly enter name',
        ]);

        $cate = new Category();
        $cate->name = $request->name;
        $cate->status = '1';
        $cate->slug = Str::slug($request->name);

        $cate->save();

        return redirect()->back()->with('success', 'Category has been added successfully');
    }

    public function catUpdate(Request $request)
    {

        $cate = Category::find($request->id);

        $request->validate([
            'editname' => 'required'
        ], [
            'editname.required' => 'Kindly enter name',
        ]);

        $cate->name= $request->editname;
        $cate->slug = Str::slug($request->editname);

        $cate->update();

        return redirect()->back()->with('success', 'Category has been Updated successfully');
    }

    public function catDestroy($id)
    {
        Category::find($id)->delete();

        return redirect()->back()->with('success', 'Category Delete Successful');
    }
}
