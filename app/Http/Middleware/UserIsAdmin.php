<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserIsAdmin {
    public function handle(Request $request, Closure $next) {
        if (!auth()->check() || !auth()->user()->is_admin) {
            return redirect()->route('home')->with('error','Non autorizzato (admin).');
        }
        return $next($request);
    }
}
