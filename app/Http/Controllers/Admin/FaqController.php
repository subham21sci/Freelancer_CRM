<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use Validator;
use Auth;
use App\Helpers\Helper;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        $faqData = Faq::orderBy('id','desc')->get();
        return view('backend.faq.list', compact('faqData'));
    }

    public function faqStore(Request $request)
    {
      //  dd($request->all());

        $request->validate([
            'question' => 'required',
            'answer' => 'required',

        ], [
            'question.required' => 'Kindly enter Question',
        ]);

        $cate = new Faq();
        $cate->question = $request->question;
        $cate->answer = $request->answer;
        $cate->slug = Str::slug($request->question);
        $cate->save();

        return redirect()->back()->with('success', 'Faq has been added successfully');
    }

    public function faqUpdate(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',

        ], [
            'question.required' => 'Kindly enter Question',
        ]);

        $cate = Faq::find($request->faqid);
        $cate->question = $request->question;
        $cate->answer = $request->answer;
        $cate->slug = Str::slug($request->question);
        $cate->update();

        return redirect()->back()->with('success', 'Faq has been Updated successfully');
    }

    public function faqDestroy($id)
    {
        Faq::find($id)->delete();

        return redirect()->back()->with('success', 'Faq Delete Successful');
    }
}
