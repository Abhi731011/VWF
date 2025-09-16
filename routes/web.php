<?php
 
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\GalleryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\landing\LandingController;
use App\Http\Controllers\landing\CausesController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EventRegistrationController;
use App\Http\Controllers\Admin\CertificateRequestController;
use App\Http\Controllers\Admin\CertificateDesignController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\SupportFeedbackController;

 
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
Route::get('/causes', [CausesController::class, 'index'])->name('causes');

// Public causes show route
Route::get('/causes/{project}', [CausesController::class, 'show'])->name('landing.causes.show');
 
Route::get('/landing-events', [LandingController::class, 'events'])->name('eventslanding');
 
// Public event show route
Route::get('/landing-events/{event}', [LandingController::class, 'showEvent'])->name('landing.events.show');

// Public gallery route
Route::get('/gallery-landing', [LandingController::class, 'gallery'])->name('gallerylanding');

// Public certificate view route
Route::get('/certificate/{certificateRequest}', function($certificateRequest) {
    $request = App\Models\CertificateRequest::findOrFail($certificateRequest);
    if ($request->status !== 'approved' || !$request->certificate_path) {
        abort(404);
    }
    return response()->file(public_path($request->certificate_path));
})->name('certificate.view');
 
Route::get('/blog', function () {
    return view('landing.main');
})->name('blog');
 
// This route is now handled by the gallerylanding route above
 
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
Route::post('/projectscreated', [ProjectController::class, 'store'])->name('projects.store');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
Route::put('/projectslanding/{project}', [ProjectController::class, 'update'])->name('projects.update');
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

// Admin Gallery Management Routes
Route::get('/admin-galleries', [GalleryController::class, 'index'])->name('galleries.index');
Route::get('/galleries/create', [GalleryController::class, 'create'])->name('galleries.create');
Route::post('/galleries', [GalleryController::class, 'store'])->name('galleries.store');
Route::get('/galleries/{gallery}', [GalleryController::class, 'show'])->name('galleries.show');
Route::get('/galleries/{gallery}/edit', [GalleryController::class, 'edit'])->name('galleries.edit');
Route::put('/galleries/{gallery}', [GalleryController::class, 'update'])->name('galleries.update');
Route::delete('/galleries/{gallery}', [GalleryController::class, 'destroy'])->name('galleries.destroy');

// Admin Event Registration Management Routes
Route::get('/admin/event-registrations', [EventRegistrationController::class, 'index'])->name('admin.event-registrations.index');
Route::get('/admin/event-registrations/{eventRegistration}', [EventRegistrationController::class, 'show'])->name('admin.event-registrations.show');
Route::post('/admin/event-registrations/{eventRegistration}/approve', [EventRegistrationController::class, 'approve'])->name('admin.event-registrations.approve');
Route::post('/admin/event-registrations/{eventRegistration}/reject', [EventRegistrationController::class, 'reject'])->name('admin.event-registrations.reject');
Route::post('/admin/event-registrations/{eventRegistration}/cancel', [EventRegistrationController::class, 'cancel'])->name('admin.event-registrations.cancel');

// Admin User Management Routes
Route::get('/admin-users', [AdminController::class, 'index'])->name('admins.index');
Route::get('/admins/create', [AdminController::class, 'create'])->name('admins.create');
Route::post('/admins', [AdminController::class, 'store'])->name('admins.store');
Route::get('/admins/{admin}', [AdminController::class, 'show'])->name('admins.show');
Route::get('/admins/{admin}/edit', [AdminController::class, 'edit'])->name('admins.edit');
Route::put('/admins/{admin}', [AdminController::class, 'update'])->name('admins.update');
Route::delete('/admins/{admin}', [AdminController::class, 'destroy'])->name('admins.destroy');
Route::post('/admins/{admin}/reset-password', [AdminController::class, 'resetPassword'])->name('admins.reset-password');

// Admin Support Feedback Management Routes
Route::get('/admin/support-feedback', [SupportFeedbackController::class, 'index'])->name('admin.support-feedback.index');
Route::get('/admin/support-feedback/{supportFeedback}', [SupportFeedbackController::class, 'show'])->name('admin.support-feedback.show');
Route::put('/admin/support-feedback/{supportFeedback}/response', [SupportFeedbackController::class, 'updateResponse'])->name('admin.support-feedback.update-response');
Route::post('/admin/support-feedback/{supportFeedback}/close', [SupportFeedbackController::class, 'close'])->name('admin.support-feedback.close');
Route::put('/admin/support-feedback/{supportFeedback}/status', [SupportFeedbackController::class, 'updateStatus'])->name('admin.support-feedback.update-status');
Route::delete('/admin/support-feedback/{supportFeedback}', [SupportFeedbackController::class, 'destroy'])->name('admin.support-feedback.destroy');
Route::get('/admin/support-feedback-stats', [SupportFeedbackController::class, 'getStats'])->name('admin.support-feedback.stats');
// Admin Certificate Request Management Routes
Route::get('/admin/certificate-requests', [CertificateRequestController::class, 'index'])->name('admin.certificates.index');
Route::get('/admin/certificate-requests/{certificateRequest}', [CertificateRequestController::class, 'show'])->name('admin.certificates.show');
Route::post('/admin/certificate-requests/{certificateRequest}/approve', [CertificateRequestController::class, 'approve'])->name('admin.certificates.approve');
Route::post('/admin/certificate-requests/{certificateRequest}/reject', [CertificateRequestController::class, 'reject'])->name('admin.certificates.reject');

// Admin Certificate Design Management Routes
Route::get('/admin/certificate-designs', [CertificateDesignController::class, 'index'])->name('admin.certificate-designs.index');
Route::get('/admin/certificate-designs/create', [CertificateDesignController::class, 'create'])->name('admin.certificate-designs.create');
Route::post('/admin/certificate-designs', [CertificateDesignController::class, 'store'])->name('admin.certificate-designs.store');
Route::get('/admin/certificate-designs/{certificateDesign}', [CertificateDesignController::class, 'show'])->name('admin.certificate-designs.show');
Route::get('/admin/certificate-designs/{certificateDesign}/edit', [CertificateDesignController::class, 'edit'])->name('admin.certificate-designs.edit');
Route::put('/admin/certificate-designs/{certificateDesign}', [CertificateDesignController::class, 'update'])->name('admin.certificate-designs.update');
Route::delete('/admin/certificate-designs/{certificateDesign}', [CertificateDesignController::class, 'destroy'])->name('admin.certificate-designs.destroy');
Route::post('/admin/certificate-designs/{certificateDesign}/set-default', [CertificateDesignController::class, 'setDefault'])->name('admin.certificate-designs.set-default');

});
require __DIR__.'/auth.php';
 
 