<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Models\About;
use App\Models\Brand;
use App\Models\Contact;
use App\Models\Multipic;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    $brands = Brand::get();
    $abouts = About::get();
    $sliders = Slider::get();
    $services = Service::get();
    $multipics = Multipic::all();
    $contacts = Contact::all();
    $teams = Team::all();
    return view('home',compact('sliders','brands','abouts','services','multipics','contacts','teams'));
});

// Route::get('/', [AboutController::class, 'home'])->name('home');

Route::get('/about', [AboutController::class, 'about'])->name('abt');
Route::get('/contact', [ContactController::class, 'contact'])->name('con');

Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('add.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'EditCat'])->name('edit.category');
Route::post('/category/update/{id}', [CategoryController::class, 'UpdateCat'])->name('update.category');
Route::get('/category/delete/{id}', [CategoryController::class, 'DelCat'])->name('delete.category');
Route::get('/category/restore/{id}', [CategoryController::class, 'ResCat'])->name('restore.category');
Route::get('/category/remove/{id}', [CategoryController::class, 'RemoveCat'])->name('remove.category');

Route::get('/brand/all', [CategoryController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/add', [CategoryController::class, 'AddBrand'])->name('add.brand');
Route::get('/brand/edit/{id}', [CategoryController::class, 'EditBrand'])->name('edit.brand');
Route::post('/brand/update/{id}', [CategoryController::class, 'UpdateBrand'])->name('update.brand');
Route::get('/brand/delete/{id}', [CategoryController::class, 'DelBrand'])->name('delete.brand');

Route::get('/image/all', [CategoryController::class, 'AllImage'])->name('all.image');
Route::post('/images/add', [CategoryController::class, 'AddImages'])->name('add.images');

Route::get('/slider/all', [CategoryController::class, 'AllSlider'])->name('all.slider');
Route::get('/slider/add', [CategoryController::class, 'AddSlider'])->name('add.slider');
Route::post('/slider/store', [CategoryController::class, 'StoreSlider'])->name('store.slider');
Route::get('/slider/edit/{id}', [CategoryController::class, 'EditSlider'])->name('edit.slider');
Route::post('/slider/update/{id}', [CategoryController::class, 'UpdateSlider'])->name('update.slider');
Route::get('/slider/delete/{id}', [CategoryController::class, 'DelSlider'])->name('delete.slider');

Route::get('/about/all', [CategoryController::class, 'AllAbout'])->name('all.about');
Route::get('/about/add', [CategoryController::class, 'AddAbout'])->name('add.about');
Route::post('/about/store', [CategoryController::class, 'StoreAbout'])->name('store.about');
Route::get('/about/edit/{id}', [CategoryController::class, 'EditAbout'])->name('edit.about');
Route::post('/about/update/{id}', [CategoryController::class, 'UpdateAbout'])->name('update.about');
Route::get('/about/delete/{id}', [CategoryController::class, 'DeleteAbout'])->name('delete.about');

Route::get('/services/all', [CategoryController::class, 'AllServices'])->name('all.services');
Route::get('/services/add', [CategoryController::class, 'AddService'])->name('add.service');
Route::post('/services/store', [CategoryController::class, 'StoreService'])->name('store.service');
Route::get('/services/edit/{id}', [CategoryController::class, 'EditService'])->name('edit.service');
Route::post('/services/update/{id}', [CategoryController::class, 'UpdateService'])->name('update.service');

Route::get('/team/admin', [CategoryController::class, 'TeamAdmin'])->name('all.team');
Route::get('/team/add', [CategoryController::class, 'AddTeam'])->name('add.team');
Route::post('/team/stored', [CategoryController::class, 'StoredTeam'])->name('stored.team');
Route::get('/team/edit/{id}', [CategoryController::class, 'TeamEdit'])->name('edit.team');
Route::post('/team/update/{id}', [CategoryController::class, 'UpdateTeam'])->name('update.team');
Route::get('/team/delete/{id}', [CategoryController::class, 'DeleteTeam'])->name('delete.team');

Route::get('/portfolio', [CategoryController::class, 'PortFolio'])->name('portfolio');
Route::get('/about/page', [CategoryController::class, 'AboutPage'])->name('about.page');
Route::get('/services', [CategoryController::class, 'Services'])->name('services');
Route::get('/team', [CategoryController::class, 'Team'])->name('team.page');

Route::get('/admin/contact', [CategoryController::class, 'AdminContact'])->name('admin.contact');
Route::get('/create/contact', [CategoryController::class, 'AdminCreateContact'])->name('create.contact');
Route::post('/store/contact', [CategoryController::class, 'StoreContact'])->name('store.contact');
Route::get('/edit/contacts/{id}', [CategoryController::class, 'EditContact'])->name('edit.contacts');
Route::post('/update/contact/{id}', [CategoryController::class, 'UpdateContact'])->name('update.contact');
Route::get('/delete/contacts/{id}', [CategoryController::class, 'DeleteContacts'])->name('delete.contacts');

Route::get('/home/contact', [CategoryController::class, 'HomeContact'])->name('home.contact');
Route::post('/contact/form', [CategoryController::class, 'ContactForm'])->name('contact.form');
Route::get('/admin/message', [CategoryController::class, 'AdminMessage'])->name('admin.message');
Route::get('/message/view/{id}', [CategoryController::class, 'MessageView'])->name('admin.view_message');
Route::get('/message/delete/{id}', [CategoryController::class, 'DeleteMsg'])->name('message.delete');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $users = User::all();
    return view('index',compact('users'));
})->name('dashboard');

Route::get('user/logout', [CategoryController::class, 'logout'])->name('user.logout');

Route::get('/change/password', [CategoryController::class, 'ChangePass'])->name('change.password');
Route::post('/update/password', [CategoryController::class, 'UpdatePassword'])->name('update.password');

Route::get('/user/profile', [CategoryController::class, 'UpdateProfile'])->name('update.profile');
Route::post('/update/user/profile', [CategoryController::class, 'UpdateUserProfile'])->name('update.user_profile');




