<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\LoginController as AdminLoginController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/hakkimizda', [AboutController::class, 'index'])->name('about');
Route::get('/projelerimiz', [ProjectController::class, 'index'])->name('projects');
Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/iletisim', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');


Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});


Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Projects Management
    Route::resource('projects', AdminProjectController::class);
    Route::post('projects/{project}/toggle-status', [AdminProjectController::class, 'toggleStatus'])
        ->name('projects.toggle-status');
    Route::post('projects/bulk-delete', [AdminProjectController::class, 'bulkDelete'])
        ->name('projects.bulk-delete');

    // Blog Management
    Route::resource('blog', AdminBlogController::class);
    Route::post('blog/{blog}/toggle-status', [AdminBlogController::class, 'toggleStatus'])
        ->name('blog.toggle-status');
    Route::post('blog/{blog}/publish', [AdminBlogController::class, 'publish'])
        ->name('blog.publish');
    Route::post('blog/bulk-delete', [AdminBlogController::class, 'bulkDelete'])
        ->name('blog.bulk-delete');

    // Customers Management
    Route::resource('customers', CustomerController::class);
    Route::post('customers/{customer}/toggle-status', [CustomerController::class, 'toggleStatus'])
        ->name('customers.toggle-status');
    Route::get('customers/{customer}/projects', [CustomerController::class, 'projects'])
        ->name('customers.projects');


    // Analytics & Reports
    Route::prefix('analytics')->name('analytics.')->group(function () {
        Route::get('/', [DashboardController::class, 'analytics'])->name('index');
        Route::get('/export', [DashboardController::class, 'exportAnalytics'])->name('export');
    });

    // Activity Log
    Route::get('/activity-log', [DashboardController::class, 'activityLog'])->name('activity-log');

    // Quick Actions
    // Route::post('/quick-add-project', [AdminProjectController::class, 'quickAdd'])->name('quick-add-project');
    // Route::post('/quick-add-blog', [BlogController::class, 'quickAdd'])->name('quick-add-blog');

});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// Login
Route::get('/login', [AdminLoginController::class, 'showLoginForm'])
    ->name('login')
    ->middleware('guest');

Route::post('/login', [AdminLoginController::class, 'login'])
    ->name('login.post')
    ->middleware('guest');

// Logout
Route::post('/logout', [AdminLoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// Demo login (for development - remove in production!)
Route::get('/demo-login', [AdminLoginController::class, 'demoLogin'])
    ->name('demo.login');
