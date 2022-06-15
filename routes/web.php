<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\FunfactController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IconController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SiteInfoController;
use App\Http\Controllers\TestimonailController;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('frontend.index');
// });

//-------------- frontend -----
Route::get('/',[FrontendController::class, 'index'])->name('index');
Route::get('/portfolio_single/{portfolio_id}',[FrontendController::class, 'portfolio_single'])->name('portfolio_single');

//---contact form---
Route::post('/contact',[ContactFormController::class, 'store'])->name('contact.store');

Auth::routes();

Route::group(['middleware'=> ['protectedRoutes']], function(){

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    //users info
    Route::get('/admin/users', [HomeController::class,'users'])->name('users');


    // banner route
    Route::get('/banner/add_banner',[BannerController::class, 'add_banner'])->name('add.banner');
    Route::post('/banner/insert', [BannerController::class, 'banner_insert']);
    Route::get('/banner/view_banner', [BannerController::class, 'view_banner'])->name('view.banner');
    Route::get('/banner/edit_banner/{banner_id}',[BannerController::class, 'edit_banner'])->name('edit.banner');
    Route::post('/banner/update',[BannerController::class, 'update_banner']);
    Route::get('/banner/change_status/{banner_id}',[BannerController::class, 'change_status'])->name('change.status');
    Route::get('/banner/delete/{banner_id}',[BannerController::class, 'delete_banner'])->name('banner.delete');

    // about routes
    Route::get('/about/add_about',[AboutController::class, 'add_about'])->name('add.about');
    Route::post('/about/insert',[AboutController::class, 'insert_about']);
    Route::get('/about/view_about',[AboutController::class, 'view_about'])->name('view.about');
    Route::get('/about/edit_about/{about_id}',[AboutController::class, 'edit_about'])->name('edit.about');
    Route::post('/about/update',[AboutController::class, 'update_about']);
    Route::get('/about/change_status/{about_id}',[AboutController::class, 'change_status'])->name('change.status');
    Route::get('/about/delete_about/{about_id}',[AboutController::class, 'delete_about'])->name('delete.about');

    // education route--
    Route::get('/education/add_education',[EducationController::class, 'add_education'])->name('add.edu');
    Route::post('/education/insert',[EducationController::class, 'insert_edu']);
    Route::get('/education/view_edu',[EducationController::class, 'view_edu'])->name('view.edu');
    Route::get('/education/edit_edu/{education_id}',[EducationController::class, 'edit_edu'])->name('edit.edu');
    Route::post('/education/update',[EducationController::class, 'edu_update']);
    Route::get('/education/change_status/{education_id}',[EducationController::class, 'change_status'])->name('change.status');
    Route::get('/education/delete_edu/{education_id}',[EducationController::class, 'delete_edu'])->name('delete.edu');

    // services routes
    Route::get('/services/add_services',[ServicesController::class, 'add_services'])->name('add.services');
    Route::post('/services/insert',[ServicesController::class, 'insert_services']);
    Route::get('/services/view_services',[ServicesController::class, 'view_services'])->name('view.services');
    Route::get('/services/edit_services/{services_id}',[ServicesController::class, 'edit_services'])->name('edit.services');
    Route::post('services/update',[ServicesController::class, 'update_services']);
    Route::get('/services/delete_services/{services_id}',[ServicesController::class, 'delete_services'])->name('delete.services');

    // Icon routes
    Route::get('/icon/add_icon',[IconController::class, 'add_icon'])->name('add.icon');
    Route::post('/icon/insert',[IconController::class, 'insert_icon']);
    Route::get('/icon/view_icon',[IconController::class, 'view_icon'])->name('view.icon');
    Route::get('/icon/edit_icon/{icon_id}',[IconController::class, 'edit_icon'])->name('edit.icon');
    Route::post('/icon/update',[IconController::class, 'update_icon']);
    Route::get('/icon/delete_icon/{icon_id}',[IconController::class, 'delete_icon'])->name('delete.icon');

    // portfolio and category routes----
    Route::get('/category/add_category',[PortfolioController::class, 'add_category'])->name('add.category');
    Route::post('/category/insert',[PortfolioController::class, 'category_insert']);
    Route::get('/category/view_category',[PortfolioController::class, 'view_category'])->name('view.category');
    Route::get('/category/edit_category/{category_id}',[PortfolioController::class, 'edit_category'])->name('edit.category');
    Route::post('/category/update',[PortfolioController::class, 'update_category']);
    Route::get('/category/delete_category/{category_id}',[PortfolioController::class, 'delete_category'])->name('delete.category');
    //------------------Portfolio-------------------
    Route::get('/portfolio/add_portfolio',[PortfolioController::class, 'add_portfolio'])->name('add.portfolio');
    Route::post('/portfolio/insert',[PortfolioController::class, 'insert_portfolio']);
    Route::get('/portfolio/view_portfolio',[PortfolioController::class, 'view_portfolio'])->name('view.portfolio');
    Route::get('/portfolio/edit_portfolio/{portfolio_id}',[PortfolioController::class, 'edit_portfolio'])->name('edit.portfolio');
    Route::post('/portfolio/update',[PortfolioController::class, 'update_portfolio']);
    Route::get('portfolio/delete_portfolio/{portfolio_id}', [PortfolioController::class, 'delete_portfolio'])->name('delete.portfolio');
    //--- funfact routes----
    Route::get('/funfact/add_funfact',[FunfactController::class, 'add_funfact'])->name('add.funfact');
    Route::post('/funfact/insert',[FunfactController::class, 'insert_funfact']);
    Route::get('/funfact/view_funfact',[FunfactController::class, 'view_funfact'])->name('view.funfact');
    Route::get('/funfact/edit_funfact/{funfact_id}',[FunfactController::class, 'edit_funfact'])->name('edit.funfact');
    Route::post('/funfact/update',[FunfactController::class, 'update_funfact']);
    Route::get('/funfact/delete_funfact/{funfact_id}',[FunfactController::class, 'delete_funfact'])->name('delete.funfact');
    //-------------testimonails routes-------
    Route::get('/testimonail/add_testimonail',[TestimonailController::class, 'add_testimonail'])->name('add.testi');
    Route::post('/testimonail/insert',[TestimonailController::class, 'insert_testimonail']);
    Route::get('/testimonail/view_testimonail',[TestimonailController::class, 'view_testimonail'])->name('view.testi');
    Route::get('/testimonail/edit_testimonail/{testi_id}',[TestimonailController::class, 'edit_testimonail'])->name('edit.testi');
    Route::post('/testimonail/update',[TestimonailController::class, 'update_testimonail']);
    Route::get('/testimonail/delete_testimonail/{testi_id}',[TestimonailController::class, 'delete_testimonail'])->name('delete.testi');
    //-------brand routes---------
    Route::get('/brand/add_brand',[BrandController::class, 'add_brand'])->name('add.brand');
    Route::post('/brand/insert',[BrandController::class, 'insert_brand']);
    Route::get('/brand/view_brand',[BrandController::class, 'view_brand'])->name('view.brand');
    Route::get('/brand/edit_brand/{brand_id}',[BrandController::class, 'edit_brand'])->name('edit.brand');
    Route::post('/brand/update',[BrandController::class, 'update_brand']);
    Route::get('/brand/delete_brand/{brand_id}',[BrandController::class, 'delete_brand'])->name('delete.brand');

    //----address Routes-----
    Route::get('/address_info',[AddressController::class, 'index'])->name('address');
    Route::post('/address/update',[AddressController::class, 'address_update']);

    //site_information routes----
    Route::get('/site_info',[SiteInfoController::class, 'index'])->name('site.index');
    Route::post('/site_info/update',[SiteInfoController::class, 'update']);

});

