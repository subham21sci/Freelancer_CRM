<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use Validator;
use Session;

class BlogController extends Controller
{
    public function index()
    {
        $blogData = Blog::with('categoryinfo')->orderBy('id', 'desc')->get();

        return view('backend.blog.list', compact('blogData'));
    }

    public function blogCreate()
    {
        $catData = Category::get();
        return view('backend.blog.addblog',compact('catData'));
    }

    public function blogStore(Request $request)
    {


        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'status' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'thumbnail_photo' => 'required',
            'photo' => 'required',

        ], [
            'title.required' => 'Kindly enter name',
            'short_description.required' => 'Kindly enter short_description',
            'description.required' => 'Kindly enter description',
            'thumbnail_photo.required' => 'Kindly upload thumbnail_photo',
            'photo.required' => 'Kindly upload photo',
            'category_id.required' => 'Kindly Select category',
            'status.required' => 'Kindly Select status',
        ]);

        $cate = new Blog();
        $cate->title = $request->title;
        $cate->category_id = $request->category_id;
        $cate->short_description = $request->short_description;
        $cate->description = $request->description;

        $cate->meta_tags = $request->meta_tags;
        $cate->meta_description = $request->meta_description;

        $cate->status = $request->status;
        $cate->slug = Str::slug($request->title);

        $photo = $request->file('photo');
        if ($photo) {
            $cate->photo = Helper::ImageUpload('blog/', $request->file('photo'));
        }
        $thumbnail_photo = $request->file('thumbnail_photo');
        if ($thumbnail_photo) {
            $cate->thumbnail_photo = Helper::ImageUpload('blog/', $request->file('thumbnail_photo'));
        }

        $cate->save();

        return redirect()->back()->with('success', 'Blog has been added successfully');
    }

    public function blogEdit($id)
    {
        $blog = Blog::find($id);

        $catData = Category::get();
        return view('backend.blog.editblog', compact('blog','catData'));
    }

    public function blogUpdate(Request $request,$id)
    {


        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'status' => 'required',
            'short_description' => 'required',
            'description' => 'required',

        ], [
            'title.required' => 'Kindly enter name',
            'short_description.required' => 'Kindly enter short_description',
            'description.required' => 'Kindly enter description',

            'category_id.required' => 'Kindly Select category',
            'status.required' => 'Kindly Select status',
        ]);

        $cate = Blog::find($id);
        $cate->title = $request->title;
        $cate->category_id = $request->category_id;
        $cate->short_description = $request->short_description;
        $cate->description = $request->description;

        $cate->meta_tags = $request->meta_tags;
        $cate->meta_description = $request->meta_description;

        $cate->status = $request->status;
        $cate->slug = Str::slug($request->title);

        $photo = $request->file('photo');
        if ($photo) {
            $cate->photo = Helper::ImageUpload('blog/', $request->file('photo'));
        }
        $thumbnail_photo = $request->file('thumbnail_photo');
        if ($thumbnail_photo) {
            $cate->thumbnail_photo = Helper::ImageUpload('blog/', $request->file('thumbnail_photo'));
        }

        $cate->update();

        return redirect()->back()->with('success', 'Blog has been updated successfully');
    }


    public function blogDestroy($id)
    {
        Blog::find($id)->delete();

        return redirect()->back()->with('success', 'blog Delete Successful');
    }
}
