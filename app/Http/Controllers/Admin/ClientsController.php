<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Helpers\Helper;

class ClientsController extends Controller
{
    public function index(Request $request)
{
    $clientData = Client::orderBy('id', 'desc')
        ->filterByDate($request->date)
        ->filterByStatus($request->status)
        ->get();

    return view('backend.clients.list', compact('clientData'));
}
    public function addClient()
    {
        return view('backend.clients.add');
    }

    public function clientStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'alternative_mobile' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'description' => 'nullable|string',
            'status' => 'required',
            'jdate' => 'required'
        ], [
            'name.required' => 'Kindly enter name',
            'status.required' => 'Kindly Select status',
            'jdate.required' => 'Kindly Select Date',
        ]);

        $cate = new Client();
        $cate->name = $request->name;
        $cate->mobile = $request->mobile;
        $cate->email = $request->email;
        $cate->description = $request->description;
        $cate->status = $request->status;
        $cate->jdate = $request->jdate;
        $cate->alternative_mobile = $request->alternative_mobile;

        $cate->save();

        return redirect()->route('admin.clients.clientsList')->with('success', 'Client has been added successfully');
    }

    public function clientEdit($id)
    {
        $clientData = Client::find($id);

        return view('backend.clients.edit',compact('clientData'));
    }

    public function clientUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'alternative_mobile' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'description' => 'nullable|string',
            'status' => 'required',
            'jdate' => 'required'
        ], [
            'name.required' => 'Kindly enter name',
            'status.required' => 'Kindly Select status',
            'jdate.required' => 'Kindly Select Date',
        ]);

        $cate = Client::find($id);
        $cate->name = $request->name;
        $cate->mobile = $request->mobile;
        $cate->email = $request->email;
        $cate->description = $request->description;
        $cate->status = $request->status;
        $cate->jdate = $request->jdate;
        $cate->alternative_mobile = $request->alternative_mobile;

        $cate->update();

        return redirect()->route('admin.clients.clientsList')->with('success', 'Client Update Successful');
    }

    public function clientDestroy($id)
    {
        Client::find($id)->delete();

        return redirect()->back()->with('success', 'Client Delete Successful');
    }
}
