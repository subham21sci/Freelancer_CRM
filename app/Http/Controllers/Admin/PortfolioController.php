<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Portfolio;
use App\Helpers\Helper;

class PortfolioController extends Controller
{
    public function index()
    {
        $galleryData = Portfolio::with('categoryinfo')->orderBy('id','desc')->get();
        $catData = Category::orderBy('id', 'desc')->get();

       return view('backend.portfolio.list',compact('galleryData','catData'));
    }


    public function gallStore(Request $request)
    {


        $request->validate([
            'name' => 'required',
            'photo' => 'required',
            'category_id' => 'required',
            'url'=>'required'
        ], [
            'name.required' => 'Kindly enter name',
            'category_id.required' => 'Kindly Select Category',
        ]);

        $cate = new Portfolio();
        $cate->name = $request->name;
        $cate->category_id = $request->category_id;
        $cate->url = $request->url;

        $image = $request->file('photo');
        if ($image) {
            $cate->photo = Helper::ImageUpload('portfolio/', $request->file('photo'));
        }

        $cate->save();

        return redirect()->back()->with('success', 'Portfolio has been added successfully');
    }
    public function galDestroy($id)
    {
        Portfolio::find($id)->delete();

        return redirect()->back()->with('success', 'Gallery Delete Successful');
    }
}
