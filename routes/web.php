<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\landing\LandingController;
use App\Http\Controllers\admin\ProjectController;

Route::get('/', function () {
    return view('landing.main');
})->name('index');

// Landing page routes
Route::get('/about', function () {
    return view('landing.about.index');
})->name('about');

Route::get('/services', function () {
    return view('landing.services.index');
})->name('services');

// Route::get('/causes', function () {
//     return view('landing.causes.index');
// })->name('causes');
Route::get('/causes', [LandingController::class, 'causes'])->name('causes');

Route::get('/events', function () {
    return view('landing.events.index');
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

// Contact routes
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
  
});


Route::middleware('auth')->group(function () {

//Admin
Route::get('/admin', function () {return view('admin.dashboard');})->name('dashboard');

// Admin Contact Management Routes
        Route::get('/contactslisting', [AdminContactController::class, 'index'])->name('admin.contact.index');
        Route::get('/contacts/{contact}', [AdminContactController::class, 'show'])->name('admin.contact.show');
        Route::delete('/contacts/{contact}', [AdminContactController::class, 'destroy'])->name('admin.contact.destroy');

        // Admin Project Management Routes
   Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');


});

require __DIR__.'/auth.php';
