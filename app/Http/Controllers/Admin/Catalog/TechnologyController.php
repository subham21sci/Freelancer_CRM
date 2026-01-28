<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\Helper;
use App\Models\Technology;

class TechnologyController extends Controller
{
    public function index()
    {
        $technologylist = Technology::orderBy('id','desc')->get();
        return view('backend.catalog.technology.list', compact('technologylist'));
    }

    public function technologyStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'thumbnail' => 'required',
        ], [
            'name.required' => 'Kindly enter name',
        ]);

        $cate = new Technology();
        $cate->name = $request->name;
        $cate->status = '1';
        $cate->slug = Str::slug($request->name);

        $image = $request->file('thumbnail');
        if ($image) {
            $cate->thumbnail = Helper::ImageUpload('technology/', $request->file('thumbnail'));
        }

        $cate->save();

        return redirect()->back()->with('success', 'technology has been added successfully');
    }

    public function technologyUpdate(Request $request)
    {
        $cate = Technology::find($request->id);

        $request->validate([
            'editname' => 'required',
        ], [
            'editname.required' => 'Kindly enter name',
        ]);

        $cate->name= $request->editname;
        $cate->slug = Str::slug($request->editname);

        $image = $request->file('thumbnail');
        if($image){
        $cate->thumbnail = Helper::ImageUpload('technology/', $request->file('thumbnail'));
        }

        $cate->update();

        return redirect()->back()->with('success', 'technology has been Updated successfully');
    }

    public function technologyDestroy($id)
    {
        Technology::find($id)->delete();

        return redirect()->back()->with('success', 'technology Delete Successful');
    }
}
