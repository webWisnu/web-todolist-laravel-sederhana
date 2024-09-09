<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MailSend;
use Illuminate\Support\Facades\Mail;

class KirimEmailController extends Controller
{
    public function index()
    {
        return view('formemail');
    }

    public function kirim(Request $request)
    {
        $details = [
            'nama' => $request->nama,
            'website' => $request->website,
            'Deskripsi' => $request->Deskripsi
        ];

        Mail::to($request->email)->send(new MailSend($details));

       notify()->success('Pesan Email Anda Terkirim ⚡️');
         return redirect()->route('kirim.mail');
    }
}
