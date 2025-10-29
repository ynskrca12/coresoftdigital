<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    /**
     * İletişim formu gönderimi
     */
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'company' => 'nullable|max:255',
            'phone' => 'nullable|max:20',
            'subject' => 'required|max:255',
            'message' => 'required',
            'budget' => 'nullable',
        ]);

        // Mail gönderme işlemi burada yapılabilir
        // Mail::to('info@coresoftdigital.com')->send(new ContactMail($validated));

        return redirect()->route('contact')->with('success', 'Mesajınız başarıyla gönderildi!');
    }
}
