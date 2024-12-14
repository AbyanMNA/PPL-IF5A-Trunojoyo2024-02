<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index(){
        return view('Pages.contact');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'YourName' => 'required|string',
            'YourEmail' => 'nullable|email',
            'YourMessage' => 'nullable|string',
        ]);
    
        ContactUs::create($validatedData);
    
        return redirect()->back()->with('success', 'Data berhasil dikirim');
    }
}
