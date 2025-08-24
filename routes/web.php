<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;

Route::get('/', function () {
    return view('landing.main');
})->name('index');

// Landing page routes
Route::get('/about', function () {
    return view('landing.main');
})->name('about');

Route::get('/services', function () {
    return view('landing.main');
})->name('services');

Route::get('/causes', function () {
    return view('landing.main');
})->name('causes');

Route::get('/events', function () {
    return view('landing.main');
})->name('events');

Route::get('/blog', function () {
    return view('landing.main');
})->name('blog');

Route::get('/gallery', function () {
    return view('landing.main');
})->name('gallery');

Route::get('/volunteer', function () {
    return view('landing.main');
})->name('volunteer');

Route::get('/contact', function () {
    return view('landing.main');
})->name('contact');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//Admin
Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('dashboard');


require __DIR__.'/auth.php';
