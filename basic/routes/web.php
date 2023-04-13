<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Demo\Democontrollar;
use App\Http\Controllers\Home\aboutController;
use App\Http\Controllers\Home\BlogCategoryController;
use App\Http\Controllers\Home\HomeSliderController;
use App\http\Controllers\Home\PortfolioController;
use App\Models\About;
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
    return view('frontend.index');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

//All Admin Routes.
Route::controller(AdminController::class)->group(function(){
    Route::get('/admin/logout' , 'destroy')->name('admin.logout');
    Route::get('/admin/profile' , 'profile')->name('admin.profile');
    Route::get('/edit/profile' , 'editProfile')->name('edit.profile');
    Route::post('store/profile' , 'storeProfile')->name('store.profile');
    Route::get('/change/password', 'changePassword')->name('change.password');
    Route::post('/update/password' , 'updatePassword')->name('update.password');
});

//All About Routes
Route::controller(aboutController::class)->group(function(){
    Route::get('/about/page', 'aboutPage')->name('about.page');
    Route::post('/update/about' , 'updateAbout')->name('update.about');
    Route::get('/about' , 'homeAbout')->name('home.about');
    Route::get('/about/multi/image' , 'aboutMultiImage')->name('about.multi.image');
    Route::post('/store/multi/image' , 'storeMultiImage')->name('store.multi.image');
    Route::get('/all/multi/image' , 'getAllMultiImages')->name('all.multi.image');
    Route::get('/edit/multi/image/{id}' , 'editMultiImage')->name('edit.multi.image');
    Route::post('/update/multi/image' , 'updateMulttiImage')->name('update.multi.image');
    Route::get('delete/multi/image/{id}'  , 'deleteMultiImage')->name('delete.multi.image');
});

//All homeSlide routes
Route::controller(HomeSliderController::class)->group(function(){
    Route::get('/home/slide' , 'HomeSlider')->name('home.slide');
    Route::post('/update/slider' , 'updateSlider')->name('update.slider');
});

//All porttfolio controllers
Route::controller(PortfolioController::class)->group(function(){
    Route::get('all/portfolio' , 'allPortfolio')->name('all.portfolio');
    Route::get('add/portfolio' , 'addPortfolio')->name('add.portfolio');
    Route::post('store/portfolio' , 'storePortfolio')->name('store.portfolio');
    Route::get('edit/portfolio/{id}' , 'editPortfolio')->name('edit.portfolio');
    Route::get('delete/portfolio/{id}', 'deletePortfolio')->name('delete.portfolio');
    Route::post('update/portfolio' , 'updatePortfolio')->name('update.portfolio');
    Route::get('portfolio/details/{id}' , 'portfolioDetails' )->name('portfolio.details');

});

//ALl blog  routes
Route::controller(BlogCategoryController::class)->group(function(){
    Route::get('add/blog/category' , 'addCategory')->name('add.category');
    Route::get('all/blog/category', 'allCategory')->name('all.blog.category');
    Route::post('store/blog/category' , 'storeCategory')->name('store.blog.category');
    Route::get('edit/blog/category/{id}', 'editCategory')->name('edit.blog.category');
    Route::post('update.blog.category', 'updatecategory')->name('update.blog.category');
    Route::get('delete/blog/ategory/{id}', 'deleteCategory')->name('delete.blog.category');

});

//All authentication routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
