<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BlogController;
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

// Contact Page
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');

// Blog Pages
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
