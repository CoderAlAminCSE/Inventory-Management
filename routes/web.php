<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\DefaultController;
use App\Http\Controllers\Backend\InvoiceController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\PurchaseController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\UnitController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Auth\Events\Logout;
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
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});

Route::get('/admin/logout/',[AdminController::class, 'Logout'])->name('admin.logout');


//  Manage User related all route
Route::prefix('user')->group(function(){
    Route::get('/view',[UserController::class, 'UserView'])->name('user.view');
    Route::get('/add',[UserController::class, 'AddUser'])->name('users.add');
    Route::post('/store',[UserController::class, 'UserStore'])->name('users.store');
    Route::get('/edit/{id}',[UserController::class,'UserEdit'])->name('users.edit');
    Route::post('/update/{id}',[UserController::class,'UpdateStore'])->name('users.update');
    Route::get('/delete/{id}',[UserController::class,'DeleteUser'])->name('users.delete');
});


// Manage Profile related all route
Route::prefix('profile')->group(function(){
    Route::get('/view',[ProfileController::class,'ProfileView'])->name('profile.view');
    Route::get('/edit',[ProfileController::class,'ProfileEdit'])->name('profile.edit');
    Route::post('/update',[ProfileController::class,'ProfileUpdate'])->name('profile.update');
    Route::get('/password/view',[ProfileController::class,'PasswordView'])->name('password.view');
    Route::post('/password/update',[ProfileController::class,'PasswordUpdate'])->name('password.update');
});


// Manage Supplier related all route
Route::prefix('supplier')->group(function(){
    Route::get('/view',[SupplierController::class,'SupplierView'])->name('supplier.view');
    Route::get('/add',[SupplierController::class,'SupplierAdd'])->name('supplier.add');
    Route::post('/store',[SupplierController::class,'SupplierStore'])->name('supplier.store');
    Route::get('/edit/{id}',[SupplierController::class,'SupplierEdit'])->name('supplier.edit');
    Route::post('/update/{id}',[SupplierController::class,'SupplierUpdate'])->name('update.supplier');
    Route::get('/delete/{id}',[SupplierController::class,'SupplierDelete'])->name('supplier.delete');
});


// Manage Customer related all route
Route::prefix('customer')->group(function(){
    Route::get('/view',[CustomerController::class,'CustomerView'])->name('customer.view');
    Route::get('/add',[CustomerController::class,'CustomerAdd'])->name('customer.add');
    Route::post('/store',[CustomerController::class,'CustomerStore'])->name('customer.store');
    Route::get('/edit/{id}',[CustomerController::class,'CustomerEdit'])->name('customer.edit');
    Route::post('/update/{id}',[CustomerController::class,'CustomerUpdate'])->name('update.customer');
    Route::get('/delete/{id}',[CustomerController::class,'CustomerDelete'])->name('customer.delete');
});


// Manage Unit related all route
Route::prefix('unit')->group(function(){
    Route::get('/view',[UnitController::class,'UnitView'])->name('unit.view');
    Route::get('/add',[UnitController::class,'UnitAdd'])->name('unit.add');
    Route::post('/store',[UnitController::class,'UnitStore'])->name('unit.store');
    Route::get('/edit/{id}',[UnitController::class,'UnitEdit'])->name('unit.edit');
    Route::post('/update/{id}',[UnitController::class,'UnitUpdate'])->name('unit.update');
    Route::get('/delete/{id}',[UnitController::class,'UnitDelete'])->name('unit.delete');
});


// Manage category related all route
Route::prefix('category')->group(function(){
    Route::get('/view',[CategoryController::class,'CategoryView'])->name('category.view');
    Route::get('/add',[CategoryController::class,'CategoryAdd'])->name('category.add');
    Route::post('/store',[CategoryController::class,'CategoryStore'])->name('category.store');
    Route::get('/edit/{id}',[CategoryController::class,'CategoryEdit'])->name('category.edit');
    Route::post('/update/{id}',[CategoryController::class,'CategoryUpdate'])->name('category.update');
    Route::get('/delete/{id}',[CategoryController::class,'CategoryDelete'])->name('category.delete');
});


// Manage Product related all route
Route::prefix('product')->group(function(){
    Route::get('/view',[ProductController::class,'View'])->name('product.view');
    Route::get('/add',[ProductController::class,'Add'])->name('product.add');
    Route::post('/store',[ProductController::class,'Store'])->name('product.store');
    Route::get('/edit/{id}',[ProductController::class,'Edit'])->name('product.edit');
    Route::post('/update/{id}',[ProductController::class,'Update'])->name('product.update');
    Route::get('/delete/{id}',[ProductController::class,'Delete'])->name('product.delete');
});


// Manage Purchase related all route
Route::prefix('purchase')->group(function(){
    Route::get('/view',[PurchaseController::class,'View'])->name('purchase.view');
    Route::get('/add',[PurchaseController::class,'Add'])->name('purchase.add');
    Route::post('/store',[PurchaseController::class,'Store'])->name('purchase.store');
    Route::get('/pending',[PurchaseController::class,'pendingList'])->name('purchase.pending.list');
    Route::get('/approve/{id}',[PurchaseController::class,'Approve'])->name('purchase.approve');
    Route::get('/delete/{id}',[PurchaseController::class,'Delete'])->name('purchase.delete');
});


//Default controller related route
    Route::get('/get-category',[DefaultController::class,'getCategory'])->name('get-category');
    Route::get('/get-product',[DefaultController::class,'getProduct'])->name('get-product');
    Route::get('/get-stoke',[DefaultController::class,'getStoke'])->name('get-product-stoke');

    
// Manage Invoice related all route
Route::prefix('invoice')->group(function(){
    Route::get('/view',[InvoiceController::class,'View'])->name('invoice.view');
    Route::get('/add',[InvoiceController::class,'Add'])->name('invoice.add');
    Route::post('/store',[InvoiceController::class,'Store'])->name('invoice.store');
    Route::get('/pending',[InvoiceController::class,'pendingList'])->name('invoice.pending.list');
    Route::get('/approve/{id}',[InvoiceController::class,'Approve'])->name('invoice.approve');
    Route::get('/delete/{id}',[InvoiceController::class,'Delete'])->name('invoice.delete');
    Route::post('/invoice/approve/{id}',[InvoiceController::class,'ApproveStore'])->name('invoice.approve.store');
    Route::get('/print/list',[InvoiceController::class,'PrintInvoiceList'])->name('invoice.print.list');
    Route::get('/print/{id}',[InvoiceController::class,'PrintInvoice'])->name('invoice.print');
});

