<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CareersController; // 👈 aggiunto per "Lavora con noi"

// --- Pagine pubbliche ---
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/articoli', [PublicController::class, 'articoli'])->name('articoli.index');
Route::get('/articolo/{slug}', [PublicController::class, 'show'])->name('articoli.show');

// --- Auth: pagine ---
Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

// --- Auth: azioni ---
Route::post('/login',    [AuthController::class, 'login'])->name('login.perform');
Route::post('/logout',   [AuthController::class, 'logout'])->name('logout');
Route::post('/register', [AuthController::class, 'register'])->name('register.perform');

// --- Lavora con noi (solo utenti autenticati) ---
Route::middleware('auth')->group(function () {
    Route::get('/lavora-con-noi',  [CareersController::class, 'form'])->name('careers.form');
    Route::post('/lavora-con-noi', [CareersController::class, 'submit'])->name('careers.submit');
});

// --- Dashboard per ruolo (protette da middleware ruoli) ---
Route::middleware(['auth','admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::view('/', 'dashboards.admin')->name('dashboard');
});

Route::middleware(['auth','revisor'])->prefix('revisor')->name('revisor.')->group(function () {
    Route::view('/', 'dashboards.revisor')->name('dashboard');
});

Route::middleware(['auth','writer'])->prefix('writer')->name('writer.')->group(function () {
    Route::view('/', 'dashboards.writer')->name('dashboard');
});
