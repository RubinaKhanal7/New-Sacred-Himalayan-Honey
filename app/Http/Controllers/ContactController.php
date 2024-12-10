<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(5);
        return view('backend.contact.index', [
            'contacts' => $contacts,
            'page_title' => 'Contact Us'
        ]);
    }

    public function store(Request $request)
    {
        Log::info('Contact form submitted', $request->all());

        $validator = \Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone_no' => 'required|string',
            'message' => 'required|string',
            'g-recaptcha-response' => [
                'required',
                function ($attribute, $value, $fail) {
                    $g_response = Http::asForm()->post("https://www.google.com/recaptcha/api/siteverify", [
                        'secret' => config('services.recaptcha.secret_key'),
                        'response' => $value,
                        'remoteip' => request()->ip()
                    ]);

                    if (!$g_response->json('success')) {
                        $fail('The reCAPTCHA verification failed. Please try again.');
                    }
                },
            ],
        ]);

        if ($validator->fails()) {
            Log::error('Validation errors: ', $validator->errors()->toArray());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Log::info('Validation passed');

        $contact = new Contact;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone_no = $request->phone_no;
        $contact->message = $request->message;
        $contact->save();

        Log::info('Contact saved successfully', $contact->toArray());

        return redirect()->back()->with('success', 'Your message has been submitted successfully!');
    }
}