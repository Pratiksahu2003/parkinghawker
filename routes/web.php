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
Route::get('/about.html', [PageController::class, 'about']);

Route::get('/rent-your-space', [PageController::class, 'rentYourSpace'])->name('rent-your-space');
Route::get('/rent-your-space.html', [PageController::class, 'rentYourSpace']);

Route::get('/press', [PageController::class, 'press'])->name('press');
Route::get('/press.html', [PageController::class, 'press']);

Route::get('/career', [PageController::class, 'career'])->name('career');
Route::get('/career.html', [PageController::class, 'career']);

Route::get('/review', [PageController::class, 'review'])->name('review');
Route::get('/review.html', [PageController::class, 'review']);

Route::get('/cities', [PageController::class, 'cities'])->name('cities');
Route::get('/cities.html', [PageController::class, 'cities']);

Route::get('/valet-parking', [PageController::class, 'valetParking'])->name('valet-parking');
Route::get('/valet-parking.html', [PageController::class, 'valetParking']);

Route::get('/monthly-parking', [PageController::class, 'monthlyParking'])->name('monthly-parking');
Route::get('/monthly-parking.html', [PageController::class, 'monthlyParking']);

Route::get('/list-of-parkings', [PageController::class, 'listOfParkings'])->name('list-of-parkings');
Route::get('/list-of-parkings.html', [PageController::class, 'listOfParkings']);

Route::get('/event-parking-spaces', [PageController::class, 'eventParking'])->name('event-parking-spaces');
Route::get('/event-parking-spaces.html', [PageController::class, 'eventParking']);

Route::get('/paid-parking-spaces', [PageController::class, 'paidParking'])->name('paid-parking-spaces');
Route::get('/paid-parking-spaces.html', [PageController::class, 'paidParking']);

Route::get('/free-parking-spaces', [PageController::class, 'freeParking'])->name('free-parking-spaces');
Route::get('/free-parking-spaces.html', [PageController::class, 'freeParking']);

Route::get('/faq', [PageController::class, 'faq'])->name('faq');

Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('legal.privacy');
Route::get('/privacy-policy.html', [PageController::class, 'privacy']);

Route::get('/terms-of-service', [PageController::class, 'terms'])->name('legal.terms');

Route::get('/refund-policy', [PageController::class, 'refund'])->name('legal.refund');
Route::get('/cancellations-and-refunds.html', [PageController::class, 'refund']);

// Contact Page
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/contact-us.html', [PageController::class, 'contact']);
Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');

// Blog Pages
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog.html', [BlogController::class, 'index']);
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

// Pattern: /book-parking-space-in/{city}.html
// e.g. /book-parking-space-in/agra.html
Route::get('/book-parking-space-in/{city}', [SitemapLocationController::class, 'showCity'])
    ->where('city', '.*\.html$')
    ->name('sitemap.city.show');
