<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactFormController extends Controller
{
    //----contact store
    public function store(){
        $contact_form_data = request()->all();
        Mail::to('sohelranasohel098@gmail.com')->send(new ContactFormMail($contact_form_data));
        return redirect()->route('index','/#contact')->with('success','Your message has been submitted successfully');
    }
}
