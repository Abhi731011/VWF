<?php
 
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\PackageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\landing\LandingController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\PaymentController;
 
// Route::get('/', function () {
//     return view('landing.main');
// })->name('index');
Route::get('/', [LandingController::class, 'index'])->name('index');
 
 
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
 
Route::get('/landing-events', [LandingController::class, 'events'])->name('eventslanding');
 
// Public event show route
Route::get('/landing-events/{event}', [LandingController::class, 'showEvent'])->name('landing.events.show');
 
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
 
// Payment routes
Route::get('/donate/{projectId?}', [PaymentController::class, 'showDonationForm'])->name('donate');
Route::post('/payment/create', [PaymentController::class, 'createPayment'])->name('payment.create');
Route::post('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
 
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
 
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   
    // Admin Profile Routes
    Route::get('/admin/profile', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/admin/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('admin.profile.update');

 
 
// Admin routes (temporarily without auth for testing)
//Admin
Route::get('/admin', function () {return view('admin.dashboard');})->name('admin.dashboard');
 
// Admin Contact Management Routes
Route::get('/contactslisting', [AdminContactController::class, 'index'])->name('admin.contact.index');
Route::get('/contacts/{contact}', [AdminContactController::class, 'show'])->name('admin.contact.show');
Route::delete('/contacts/{contact}', [AdminContactController::class, 'destroy'])->name('admin.contact.destroy');
 
// Admin Project Management Routes
Route::get('/admin-projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
 
// Admin Event Management Routes
Route::get('/admin-events', [EventController::class, 'index'])->name('events.index');
Route::get('/admin/events/create', [EventController::class, 'create'])->name('events.create');
Route::post('/admin/events', [EventController::class, 'store'])->name('events.store');
Route::get('/admin/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::get('/admin/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
Route::put('/admin/events/{event}', [EventController::class, 'update'])->name('events.update');
Route::delete('/admin/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
 
// Admin Package Management Routes
Route::get('/admin-packages', [PackageController::class, 'index'])->name('packages.index');
Route::get('/packages/create', [PackageController::class, 'create'])->name('packages.create');
Route::post('/packages', [PackageController::class, 'store'])->name('packages.store');
Route::get('/packages/{package}', [PackageController::class, 'show'])->name('packages.show');
Route::get('/packages/{package}/edit', [PackageController::class, 'edit'])->name('packages.edit');
Route::put('/packages/{package}', [PackageController::class, 'update'])->name('packages.update');
Route::delete('/packages/{package}', [PackageController::class, 'destroy'])->name('packages.destroy');
});
require __DIR__.'/auth.php';
 
 