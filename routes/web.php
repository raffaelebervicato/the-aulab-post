<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\CategoryController; //categorie controller
use App\Http\Controllers\Admin\TagController; //tag controller

use App\Http\Controllers\Writer\ArticleController as WriterArticleController; //articolo controller
use App\Http\Controllers\Revisor\ReviewController; //revisore articolo controller

use App\Http\Controllers\CareersController; // aggiunto per "Lavora con noi"

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
    Route::get('/', [AdminController::class,'dashboard'])->name('dashboard');

    // Sezioni viste
    Route::get('/utenti-ruoli', [AdminController::class,'usersRoles'])->name('users.roles');
    Route::get('/richieste-ruolo', [AdminController::class,'requests'])->name('requests');
    Route::get('/categorie-tag', [AdminController::class,'taxonomies'])->name('taxonomies');

    // Azioni ruoli
    Route::post('/users/{user}/grant/{role}',  [AdminController::class,'grant'])->name('roles.grant');
    Route::post('/users/{user}/revoke/{role}', [AdminController::class,'revoke'])->name('roles.revoke');

    // Gestione Categorie
    Route::resource('categories', CategoryController::class)->names('categories')
      ->parameters(['categories' => 'category']);

    // Gestione Tag
    Route::resource('tags', TagController::class)->names('tags')
    ->parameters(['tags' => 'tag']);

});

Route::middleware(['auth','revisor'])->prefix('revisor')->name('revisor.')->group(function () {
    Route::view('/', 'dashboards.revisor')->name('dashboard');

    //risorsa revisore
    Route::get('queue', [ReviewController::class,'index'])->name('queue');
    Route::post('articles/{article}/accept', [ReviewController::class,'accept'])->name('accept');
    Route::post('articles/{article}/reject', [ReviewController::class,'reject'])->name('reject');

});

Route::middleware(['auth','writer'])->prefix('writer')->name('writer.')->group(function () {
    Route::view('/', 'dashboards.writer')->name('dashboard');

    //risorsa writer
    Route::resource('articles', WriterArticleController::class)->except('show');
});
