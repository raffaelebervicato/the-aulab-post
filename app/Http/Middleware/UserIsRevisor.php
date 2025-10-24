<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserIsRevisor {
    public function handle(Request $request, Closure $next) {
        if (!auth()->check() || !auth()->user()->is_revisor) {
            return redirect()->route('home')->with('error','Non autorizzato (revisor).');
        }
        return $next($request);
    }
}
