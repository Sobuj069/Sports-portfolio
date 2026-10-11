<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\MediaArticleController;
use App\Http\Controllers\Admin\RaceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SponsorController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/disclaimer-privacy-policy', [HomeController::class, 'privacy'])->name('privacy');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.submit');
Route::get('/download-sponsorguide', [HomeController::class, 'downloadSponsorGuide'])->name('sponsorguide.download');

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', fn () => redirect()->route('admin.login'))->name('login');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | Protected Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth'])->group(function () {
        Route::get('/', [DashboardController::class, 'index']);
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Hero Section
        Route::get('/hero', [HeroController::class, 'edit'])->name('hero.edit');
        Route::post('/hero', [HeroController::class, 'update'])->name('hero.update');

        // Race Calendar
        Route::get('/races', [RaceController::class, 'index'])->name('races.index');
        Route::post('/races', [RaceController::class, 'store'])->name('races.store');
        Route::put('/races/{race}', [RaceController::class, 'update'])->name('races.update');
        Route::delete('/races/{race}', [RaceController::class, 'destroy'])->name('races.destroy');

        // Sponsors
        Route::get('/sponsors', [SponsorController::class, 'index'])->name('sponsors.index');
        Route::post('/sponsors', [SponsorController::class, 'store'])->name('sponsors.store');
        Route::put('/sponsors/{sponsor}', [SponsorController::class, 'update'])->name('sponsors.update');
        Route::delete('/sponsors/{sponsor}', [SponsorController::class, 'destroy'])->name('sponsors.destroy');

        // Media & Press
        Route::get('/media', [MediaArticleController::class, 'index'])->name('media.index');
        Route::post('/media', [MediaArticleController::class, 'store'])->name('media.store');
        Route::put('/media/{article}', [MediaArticleController::class, 'update'])->name('media.update');
        Route::delete('/media/{article}', [MediaArticleController::class, 'destroy'])->name('media.destroy');

        // Gallery
        Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
        Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
        Route::put('/gallery/{gallery}', [GalleryController::class, 'update'])->name('gallery.update');
        Route::delete('/gallery/{gallery}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

        // Quotes & About
        Route::get('/about', [AboutController::class, 'edit'])->name('about.edit');
        Route::post('/about', [AboutController::class, 'update'])->name('about.update');

        // Visitor Inquiries
        Route::get('/contacts', [AdminContactController::class, 'index'])->name('contacts.index');
        Route::delete('/contacts/{contact}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');

        // General Settings
        Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    });
});
