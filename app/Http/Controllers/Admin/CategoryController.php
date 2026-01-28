<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use Validator;
use Auth;
use App\Helpers\Helper;

class CategoryController extends Controller
{
    public function index()
    {

        $category_list = Category::orderBy('id','desc')->get();
        return view('backend.category.list', compact('category_list'));
    }

    public function catStore(Request $request)
    {
       // dd($request->all());

        $request->validate([
            'name' => 'required',
            // 'thumbnail' => 'required',
            'discription' => 'required',

        ], [
            'name.required' => 'Kindly enter name',
            'discription.required' => 'Kindly enter discription',
        ]);

        $cate = new Category();
        $cate->name = $request->name;
        $cate->discription = $request->discription;
        $cate->status = '1';
        $cate->slug = Str::slug($request->name);

        $image = $request->file('thumbnail');
        if ($image) {
            $cate->thumbnail = Helper::ImageUpload('category/', $request->file('thumbnail'));
        }

        $cate->save();

        return redirect()->back()->with('success', 'Category has been added successfully');
    }

    public function catUpdate(Request $request)
    {

        $cate = Category::find($request->id);

        $request->validate([
            'editname' => 'required',
            'discription' => 'required',

        ], [
            'editname.required' => 'Kindly enter name',
            'discription.required' => 'Kindly enter discription',
        ]);

        $cate->name= $request->editname;
        $cate->discription= $request->discription;

        $cate->slug = Str::slug($request->editname);

        $image = $request->file('thumbnail');
        if($image){
        $cate->thumbnail = Helper::ImageUpload('category/', $request->file('thumbnail'));
        }

        $cate->update();

        return redirect()->back()->with('success', 'Category has been Updated successfully');
    }

    public function catDestroy($id)
    {
        Category::find($id)->delete();

        return redirect()->back()->with('success', 'Category Delete Successful');
    }
}
