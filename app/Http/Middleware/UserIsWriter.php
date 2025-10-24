<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserIsWriter {
    public function handle(Request $request, Closure $next) {
        if (!auth()->check() || !auth()->user()->is_writer) {
            return redirect()->route('home')->with('error','Non autorizzato (writer).');
        }
        return $next($request);
    }
}
