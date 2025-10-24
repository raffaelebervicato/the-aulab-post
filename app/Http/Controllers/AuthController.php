<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Pagine
    public function showLogin()    { return view('auth.login'); }
    public function showRegister() { return view('auth.register'); }

    // Azioni
    public function login(Request $r)
    {
        $cred = $r->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($cred, $r->boolean('remember'))) {
            $r->session()->regenerate();
            $u = Auth::user();

            // Priorità: admin > revisor > writer
            if ($u->is_admin)   return redirect()->route('admin.dashboard')->with('success','Bentornato, Admin!');
            if ($u->is_revisor) return redirect()->route('revisor.dashboard')->with('success','Bentornato, Revisor!');
            if ($u->is_writer)  return redirect()->route('writer.dashboard')->with('success','Bentornato, Writer!');

            // Nessun ruolo assegnato
            return redirect()->route('careers.form')->with('success','Accesso effettuato. Richiedi ora un ruolo da "Lavora con noi".');
        }

        return back()->with('error','Credenziali non valide.')->withInput();
    }

    public function logout(Request $r)
    {
        Auth::logout();
        $r->session()->invalidate();
        $r->session()->regenerateToken();
        return redirect()->route('home')->with('success','Logout eseguito.');
    }

    public function register(Request $r)
    {
        $data = $r->validate([
            'name'                  => 'required|string|max:100',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);

        // Redirect come da documentazione: vai a "Lavora con noi"
        return redirect()
            ->route('careers.form')
            ->with('success','Registrazione completata! Richiedi ora il tuo ruolo da "Lavora con noi".');
    }
}
