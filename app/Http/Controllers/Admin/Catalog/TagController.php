<?php

namespace App\Http\Controllers\Admin\Catalog;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
     public function index()
    {
        $tagData = Tag::orderBy('id','desc')->get();
        return view('backend.catalog.tags.list', compact('tagData'));
    }

     public function tagStore(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Kindly enter name',
        ]);

        $cate = new Tag();
        $cate->name = $request->name;
        $cate->status = '1';
        $cate->slug = Str::slug($request->name);

        $cate->save();

        return redirect()->back()->with('success', 'Tag has been added successfully');
    }

    public function tagUpdate(Request $request)
    {

        $cate = Tag::find($request->id);

        $request->validate([
            'editname' => 'required'
        ], [
            'editname.required' => 'Kindly enter name',
        ]);

        $cate->name= $request->editname;
        $cate->slug = Str::slug($request->editname);

        $cate->update();

        return redirect()->back()->with('success', 'Tag has been Updated successfully');
    }

    public function tagDestroy($id)
    {
        Tag::find($id)->delete();

        return redirect()->back()->with('success', 'Tag Delete Successful');
    }
}
