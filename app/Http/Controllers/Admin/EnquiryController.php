<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function index()
    {

        $enquiryList = Enquiry::orderBy('id', 'desc')->get();
        return view('backend.enquiry.list', compact('enquiryList'));
    }


    public function enquiryDestroy($id)
    {
        Enquiry::find($id)->delete();

        return redirect()->back()->with('success', 'Enquiry Delete Successful');
    }

}
