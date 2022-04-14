<?php

namespace App\Http\Controllers;
use App\Mail\ContactRequest;
use Validator;
use Mail;

class ContactController extends Controller
{
    /**
     * Contact page view
     */
    public function index()
    {
        return view('frontend.contact.index');
    }

    /**
     * Send contact details to email
     */
    public function send()
    {
        $data = request()->all();
        $validator = Validator::make($data, [ 
            'email' => ['required', 'email'], 
            'fullname' => ['required', 'string'],
            'designation' => ['required', 'string'],
            'phone' => ['required'], 
            'message' => ['required', 'max:300'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()
            ]);
        }

        if (!empty($data['email'])) {
            Mail::to(env('CONTACT_EMAIL'))->send(new ContactRequest($data));
            return response()->json([
                'status' => 1,
                'info' => 'Operation successful',
                'redirect' => route('contact', ['success' => 'true']),
            ]);
        }

        return response()->json([
            'status' => 0,
            'info' => 'Operation failed',
        ]);
    }
}
