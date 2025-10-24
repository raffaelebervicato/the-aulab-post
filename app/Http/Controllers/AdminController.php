<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /** Dashboard landing (card) */
    public function dashboard()
    {
        return view('dashboards.admin');
    }

    /** Vista: Utenti & Ruoli (tutti gli utenti) */
    public function usersRoles()
    {
        $users = User::orderBy('name')->get();
        return view('admin.users-roles', compact('users'));
    }

    /** Vista: Richieste ruolo (valori NULL) */
    public function requests()
    {
        $pendingAdmins   = User::whereNull('is_admin')->orderBy('name')->get();
        $pendingRevisors = User::whereNull('is_revisor')->orderBy('name')->get();
        $pendingWriters  = User::whereNull('is_writer')->orderBy('name')->get();

        return view('admin.requests', compact('pendingAdmins','pendingRevisors','pendingWriters'));
    }

    /** Vista: Categorie & Tag (placeholder) */
    public function taxonomies()
    {
        return view('admin.taxonomies');
    }

    /** Concede un ruolo: admin|revisor|writer */
    public function grant(Request $request, User $user, string $role)
    {
        $role = $this->normalizeRole($role);
        if (!$role) {
            return back()->with('error','Ruolo non valido.');
        }

        $this->setRole($user, $role, true);
        return back()->with('success', "Ruolo {$role} concesso a {$user->name}.");
    }

    /** Revoca un ruolo (lo imposta a false) */
    public function revoke(Request $request, User $user, string $role)
    {
        $role = $this->normalizeRole($role);
        if (!$role) {
            return back()->with('error','Ruolo non valido.');
        }

        // Sicurezza: non rimuovere l'ultimo admin rimasto (ed evitare soft-lock)
        if ($role === 'admin' && $user->id === auth()->id() && User::where('is_admin', true)->count() <= 1) {
            return back()->with('error', 'Non puoi rimuovere l’unico admin esistente (te stesso).');
        }

        $this->setRole($user, $role, false);
        return back()->with('success', "Ruolo {$role} revocato a {$user->name}.");
    }

    /** Normalizza la stringa ruolo */
    private function normalizeRole(string $role): ?string
    {
        $role = strtolower($role);
        return in_array($role, ['admin','revisor','writer']) ? $role : null;
    }

    /** Applica il valore al flag corretto */
    private function setRole(User $user, string $role, bool $value): void
    {
        $column = match ($role) {
            'admin'   => 'is_admin',
            'revisor' => 'is_revisor',
            'writer'  => 'is_writer',
        };

        $user->update([$column => $value]);
    }
}
