<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminBlogPostController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\SitemapParkingController;
use App\Http\Controllers\SitemapLocationController;
use Illuminate\Support\Facades\Route;

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Find Parking Page
Route::get('/find-parking', [ParkingController::class, 'index'])->name('parking.index');
Route::get('/parking/{id}', [ParkingController::class, 'show'])->name('parking.show');

// Booking Flow
Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking/calculate', [BookingController::class, 'calculate'])->name('booking.calculate');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking-confirmation', [BookingController::class, 'confirm'])->name('booking.confirm');

// Static Pages
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('legal.privacy');
Route::get('/terms-of-service', [PageController::class, 'terms'])->name('legal.terms');
Route::get('/refund-policy', [PageController::class, 'refund'])->name('legal.refund');

// Contact Page
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');

// Blog Pages
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/category/{categorySlug}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Auth Routes
Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// ─── Admin Dashboard ─────────────────────────────────────
Route::prefix('admin')->middleware(['admin'])->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('posts', AdminBlogPostController::class);
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('roles', \App\Http\Controllers\Admin\AdminRoleController::class);
    Route::resource('permissions', \App\Http\Controllers\Admin\AdminPermissionController::class);
    Route::resource('users', \App\Http\Controllers\Admin\AdminUserController::class);
});

// ─── Sitemap Dynamic Pages (no 404 for sitemap URLs) ──────────────────────
// Pattern: /parking-in/{code}/{city}/{slug}.html
// e.g. /parking-in/DEL0171/New-Delhi/moti-nagar-metro-station-gate-no-3-and-4-parking.html
Route::get('/parking-in/{code}/{city}/{slug}', [SitemapParkingController::class, 'show'])
    ->where('slug', '.*\.html$')
    ->name('sitemap.parking.show');

// Pattern: /parking-near-me/{locationSlug}.html
// e.g. /parking-near-me/aali-village-ali-new-delhi-delhi-india.html
Route::get('/parking-near-me/{locationSlug}', [SitemapLocationController::class, 'show'])
    ->where('locationSlug', '.*\.html$')
    ->name('sitemap.location.show');
