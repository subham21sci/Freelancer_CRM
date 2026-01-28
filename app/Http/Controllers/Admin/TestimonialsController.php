<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use Validator;
use Auth;
use App\Helpers\Helper;
use App\Models\Testimonial;

class TestimonialsController extends Controller
{
    public function index()
    {
        $testimonialData = Testimonial::orderBy('id','desc')->get();
        return view('backend.testimonial.list', compact('testimonialData'));
    }

    public function testimonialStore(Request $request)
    {
      //  dd($request->all());

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'designation' => 'required',
            'photo' => 'required',

        ], [
            'name.required' => 'Kindly enter name',
        ]);

        $cate = new Testimonial();
        $cate->name = $request->name;
        $cate->description = $request->description;
        $cate->designation = $request->designation;
        $cate->slug = Str::slug($request->name);

        $image = $request->file('photo');
        if ($image) {
            $cate->photo = Helper::ImageUpload('testimonial/', $request->file('photo'));
        }

        $cate->save();

        return redirect()->back()->with('success', 'Testimonial has been added successfully');
    }

    public function testimonialUpdate(Request $request)
    {

        $cate = Testimonial::find($request->id);

        $request->validate([
           'name' => 'required',
            'designation' => 'required',
            'description' => 'required',
        ], [
            'name.required' => 'Kindly enter name',
            'designation.required' => 'Kindly enter designation',
            'description.required' => 'Kindly enter description',
        ]);

        $cate->name = $request->name;
        $cate->description = $request->description;
        $cate->designation = $request->designation;
        $cate->slug = Str::slug($request->name);

        $image = $request->file('photo');
        if ($image) {
            $cate->photo = Helper::ImageUpload('testimonial/', $request->file('photo'));
        }

        $cate->update();

        return redirect()->back()->with('success', 'Testimonial has been Updated successfully');
    }

    public function testimonialDestroy($id)
    {
        Testimonial::find($id)->delete();

        return redirect()->back()->with('success', 'Testimonial Delete Successful');
    }
}
