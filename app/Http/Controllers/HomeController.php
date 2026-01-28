<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\TestEmail;
use App\Models\Enquiry;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    public function index(){
        return view('welcome');
    }
    public function testemail()
    {
        $data = ['message' => 'This is a test!'];

        Mail::to('subham21sci@gmail.com')->send(new TestEmail($data));
    }

    public function ContectUs(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:10',
            'service' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => 'required', // Ensure the reCAPTCHA response is provided
        ], [
            'first_name.required' => 'Kindly enter your first name.',
            'last_name.required' => 'Kindly enter your last name.',
            'email.required' => 'Kindly enter a valid email address.',
            'phone.required' => 'Kindly enter your phone number.',
            'service.required' => 'Please select a service.',
            'message.required' => 'Please enter a message.',
        ]);

         // Verify reCAPTCHA response using Google API
$recaptchaResponse = $request->input('g-recaptcha-response');
$secretKey = env('NOCAPTCHA_SECRET');

// Send request to Google's reCAPTCHA verification endpoint
$verifyResponse = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
    'secret' => $secretKey,
    'response' => $recaptchaResponse,
]);

// Get the response from Google
$responseData = $verifyResponse->json();

// Check if the reCAPTCHA validation passed
if (!$responseData['success']) {
    // If reCAPTCHA failed, redirect back with an error message
    return redirect()->back()->withErrors(['g-recaptcha-response' => 'reCAPTCHA verification failed.']);
}

// Collect form data
$data = $request->only([
    'first_name',
    'last_name',
    'email',
    'phone',
    'service',
    'message'
]);

// Save data to the database
Enquiry::create($data);
        // Send an email using the TestEmail Mailable
        // $data = [
        //     'first_name' => $request->first_name,
        //     'last_name' => $request->last_name,
        //     'email' => $request->email,
        //     'phone' => $request->phone,
        //     'service' => $request->service,
        // ];
        // dd($data);
        Mail::to('subham7323kumar@gmail.com')->send(new TestEmail($data));

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Thank you for reaching out! We have received your message and will get back to you shortly.')->withFragment('skills-section');
    }
}
