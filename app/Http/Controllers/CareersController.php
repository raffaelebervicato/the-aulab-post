<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CareerRequestMail;
use Illuminate\Support\Facades\Log;

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
        if ($data['role'] === 'writer'  && $u->is_writer   !== true) $u->is_writer  = null;
        if ($data['role'] === 'revisor' && $u->is_revisor  !== true) $u->is_revisor = null;
        if ($data['role'] === 'admin'   && $u->is_admin    !== true) $u->is_admin   = null;
        $u->save();

        // PROTEZIONE: invio mail in try/catch per non bloccare l'utente
        try {
            Mail::to(config('mail.admin_address','admin@example.com'))
                ->send(new CareerRequestMail($u, $data['role'], $data['message'] ?? ''));
        } catch (\Throwable $e) {
            // Log dell'errore (utile per debug)
            Log::error('Errore invio mail richiesta ruolo: '.$e->getMessage());

            // Torna comunque con successo (utente non vede l'errore mail)
            return back()->with('success', 'Richiesta inviata. (Nota: la notifica email non è stata recapitata per un problema di configurazione SMTP.)');
        }

        return back()->with('success','Richiesta inviata. Riceverai conferma dall’amministratore.');
    }
}
