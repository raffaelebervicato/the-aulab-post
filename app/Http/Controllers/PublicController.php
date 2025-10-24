<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home() {
        return view('pages.home');
    }

    public function articoli() {
        return view('pages.articoli-index');
    }

    public function show($slug) {
        return view('pages.articoli-show', compact('slug'));
    }

    public function login() {
        return view('auth.login');
    }

    public function register() {
        return view('auth.register');
    }
}
