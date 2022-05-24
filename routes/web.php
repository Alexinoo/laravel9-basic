<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\HomeSliderController;
use App\Http\Controllers\Frontend\PortfolioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('Frontend.dashboard');
});

Route::get('/dashboard', function () {
    return view('Admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';


Route::controller(AdminController::class)->group(function(){

    // Logout
    Route::get('admin/logout' , 'destroy')->name('admin.logout');

    // Manage Profile
    Route::get('admin/profile' , 'profile')->name('admin.profile');
    Route::get('admin/edit-profile/{id}' , 'EditProfile')->name('admin_profile.edit');
    Route::post('admin/store-profile' , 'store')->name('admin_profile.store');

    // Change Password
    Route::get('admin/change-password', 'ChangePassword')->name('change.password');
    Route::post('admin/update-password', 'UpdatePassword')->name('update.password');
});


// Home Slider
Route::controller(HomeSliderController::class)->group( function(){

    Route::get('home-slide', 'index')->name('home.slide');
    Route::post('update-slider/{id}', 'update')->name('update.slider');

} );


// About Page Setup
Route::controller(AboutController::class)->group( function(){

    Route::get('about-us', 'about')->name('Frontend.about');
    Route::get('about', 'index')->name('about.page');
    Route::post('update-about/{id}', 'update')->name('update.about');

    // Multi images multi-image
    Route::get('multi-image', 'UploadImages')->name('multi-image');
    Route::post('store-images', 'StoreImages')->name('upload.images');
    Route::get('gallery', 'Gallery')->name('gallery');
    Route::get('edit/{id}', 'Edit')->name('edit.gallery');
    Route::post('update/{id}', 'UpdateImage')->name('update.gallery');
    Route::get('delete/{id}', 'Delete')->name('delete.gallery');

} );


// Portfolio Section - routes
Route::controller(PortfolioController::class)->group(function () {

    Route::get('view-portfolios', 'index')->name('portfolio.index');
    Route::get('add-portfolio', 'create')->name('add.portfolio');
    Route::post('store-portfolio', 'store')->name('store.portfolio');
    Route::get('edit-portfolio/{id}', 'Edit')->name('edit.portfolio');
    Route::post('update-portfolio/{id}', 'update')->name('update.portfolio');
    Route::get('delete-portfolio/{id}', 'delete')->name('delete.portfolio');

    // Show Portifolio details portfolio.details
    Route::get('show-portfolio-details/{id}', 'show')->name('portfolio.details');
});