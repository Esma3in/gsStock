<?php

use App\Mail\MyTestEmail;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\customerController;

use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthControllerd;
use App\Http\Controllers\Auth\ForgotPasswordController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/customers', [DashboardController::class, 'customers'])->name('customers.index');
Route::get('/suppliers' , [SupplierController::class ,'index'])->name('suppliers.index');
// Product routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/api/products/{product}', [ProductController::class, 'show'])->name('api.products.show');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/products-by-category', [CategoryController::class, 'productsByCategory'])->name('products.by.category');
Route::get('/products-by-category/{category}', [CategoryController::class, 'getProductsByCategory'])->name('products.productsByCategory');

// Products by Supplier routes
Route::get('/products-by-supplier', [DashboardController::class, 'productsBySupplier'])->name('products.by.supplier');
Route::get('/api/products-by-supplier/{supplier}', [DashboardController::class, 'getProductsBySupplier'])->name('api.products.by.supplier');

// Products by Store routes
Route::get('/products-by-store', [DashboardController::class, 'productsByStore'])->name('products.by.store');
Route::get('/api/products-by-store/{store}', [DashboardController::class, 'getProductsByStore'])->name('api.products.by.store');

// Order routes
Route::get('/orders', [DashboardController::class, 'orders'])->name('orders.index');

// Customer routes
Route::get('/customers', [customerController::class, 'index'])->name('customers.index');
Route::get('/customers/create', [customerController::class, 'create'])->name('customers.create');
Route::post('/customers', [customerController::class, 'store'])->name('customers.store');
Route::get('/customers/{customer}/edit', [customerController::class, 'edit'])->name('customers.edit');
Route::put('/customers/{customer}', [customerController::class, 'update'])->name('customers.update');
Route::get('/customers/{customer}/delete', [CustomerController::class, 'delete'])->name('customers.delete');
Route::delete('/customers/{customer}', [customerController::class, 'destroy'])->name('customers.destroy');

// Customer search API route
Route::get('/api/customers/search', [customerController::class, 'search'])->name('customers.search');
// Customer search API route
Route::get('/api/customers/search/{term}', [CustomerController::class, 'searchTerm'])->name('customers.search.term');

// Customer orders API route
Route::get('/api/customers/{customer}/orders', [OrderController::class, 'getCustomerOrders'])->name("customer.order");

// Order details route
Route::get('/api/orders/{order}/details', [OrderController::class, 'getOrderDetails'])->name('orders._details');




Route::get('/testmail', function() {
    $name = "ismo developpers";

    // The email sending is done using the to method on the Mail facade
    Mail::to('kanbouh.zuhair@gmail.com')->send(new MyTestEmail($name));
    return 'mail envoyé avec success';
});

// saveCookie
Route::post('/saveCookie' , [DashboardController::class , 'saveCookie'])->name('saveCookie');
Route::post('/saveSession' , [DashboardController::class , 'saveSession'])->name('saveSession');
Route::post("/saveAvatar", [DashboardController::class, 'saveAvatar'])->name("saveAvatar");

//Authentification
Route::get('login', [AuthControllerd::class, 'index'])->name('login');

Route::post('post-login', [AuthControllerd::class, 'postLogin'])->name('login.post'); 

Route::get('registration', [AuthControllerd::class, 'registration'])->name('register');

Route::post('post-registration', [AuthControllerd::class, 'postRegistration'])->name('register.post'); 

Route::get('dashboard', [AuthControllerd::class, 'dashboard']); 

Route::get('logout', [AuthControllerd::class, 'logout'])->name('logout');

// reset and forgot password 

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');

Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 

Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');

Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
// translation
Route::get('/changeLocale/{locale}', function (string $locale) {
    if (in_array($locale, ['en', 'es', 'fr', 'ar'])) {
        session()->put('locale', $locale);
     }
    return redirect()->back();
});
// exportation
Route::get('products-export', [ProductController::class, 'export'])->name('products.export');
// importation
Route::post('products-import', [ProductController::class, 'import'])->name('products.import');
