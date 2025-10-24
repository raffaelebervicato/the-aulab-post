<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CareerRequestMail;

class CareersController extends Controller
{
    public function form()
    {
        return view('pages.careers');
    }

    public function submit(Request $r)
    {
        $data = $r->validate([
            'role'    => 'required|in:writer,revisor,admin',
            'message' => 'nullable|string|max:1000',
        ]);

        $u = auth()->user();

        // Mettiamo a NULL il ruolo richiesto = "in richiesta"
        if ($data['role']==='writer'  && $u->is_writer   !== true) $u->is_writer  = null;
        if ($data['role']==='revisor' && $u->is_revisor  !== true) $u->is_revisor = null;
        if ($data['role']==='admin'   && $u->is_admin    !== true) $u->is_admin   = null;
        $u->save();

        // Notifica all'admin (Mailtrap in .env)
        Mail::to(config('mail.admin_address','admin@example.com'))
            ->send(new CareerRequestMail($u, $data['role'], $data['message'] ?? ''));

        return back()->with('success','Richiesta inviata. Riceverai conferma dall’amministratore.');
    }
}
