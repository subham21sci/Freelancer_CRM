<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contData = Contact::where('id','1')->first();
        return view('backend.contact', compact('contData'));
    }

    public function store(Request $request){

        $contData = Contact::where('id','1')->first();
        $contData->mobile = $request->mobile;
        $contData->mobile_second = $request->mobile_second;
        $contData->email = $request->email;
        $contData->address = $request->address;
        $contData->open_time = $request->open_time;
        $contData->update();

        return redirect()->back()->with('success', 'Contact has been Updated successfully');

    }
}
