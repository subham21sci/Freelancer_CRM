<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard(){
        return view('backend.dashboard');
    }

    public function changePassword()
    {
        return view('backend.change-password');
    }

    public function changePasswordupdate(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        if (! Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Old password is incorrect.'])->withInput();
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password updated successfully!');
    }

    public function profile()
    {
        $adminData = Auth()->user();
        return view('backend.profile',compact('adminData'));
    }


    public function profileStore(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            // 'email'=>'required|email|max:255',
            'phone' => 'required|digits:10',
            'address' => 'required|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string|max:10',
            'bio' => 'nullable|string|max:1000',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $user = User::find(Auth()->user()->id);
        $user->name = $request->name;
        // $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->zip_code = $request->zip_code;
        $user->date_of_birth = $request->date_of_birth;
        $user->gender = $request->gender;
        $user->bio = $request->bio;

        $image = $request->file('profile_image');
        if ($image) {
            $user->profile_photo_path = Helper::ImageUpload('admin/', $request->file('profile_image'));
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
