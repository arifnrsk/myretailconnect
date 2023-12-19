<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\TransactionHistoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ListProductController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\AddProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerSignUpController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Admin route
Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login');
Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.showLogin');
Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

Route::get('/', [HomeController::class, 'index'])->name('homepage');

Route::get('/add-product', [AddProductController::class, 'index'])->name('products.index');

Route::post('/add-product', [AddProductController::class, 'store'])->name('products.store');

Route::get('/list-product', [ListProductController::class, 'index'])->name('list.products.show');

Route::get('/product-detail/{id}', [ProductDetailController::class, 'show'])->name('product.detail');

Route::get('/edit-product/{id}', [ProductDetailController::class, 'showEdit'])->name('edit.product');

Route::put('/edit-product/{id}', [ProductDetailController::class, 'update'])->name('products.update');

Route::delete('/product/{id}', [ProductDetailController::class, 'delete'])->name('product.delete');

Route::post('/delete-image/{id}', [ProductDetailController::class, 'deleteImage'])->name('delete.image');

Route::get('/scheduled-products', [ScheduleController::class, 'index'])->name('scheduled.products.show');

Route::get('/product-reviews', [ReviewController::class, 'index'])->name('reviews.index');

Route::get('/delivery', [DeliveryController::class, 'index'])->name('deliveries.index');

Route::delete('/delivery/{id}', [DeliveryController::class, 'delete'])->name('delivery.delete');

Route::get('/transaction-history', [TransactionHistoryController::class, 'index'])->name('transaction.history.index');

Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
Route::post('/profile/update', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');
Route::post('/profile/update-picture', [AdminController::class, 'updateProfilePicture'])->name('admin.updateProfilePicture');

Route::get('/profile-delivery', [DeliveryController::class, 'delivery_types'])->name('deliveries.delivery_types');
Route::post('/update-retail-address', [DeliveryController::class, 'updateRetailAddress']);
Route::post('/delivery-types', [DeliveryController::class, 'store'])->name('delivery_types.store');
Route::delete('/delivery-types/{id}', [DeliveryController::class, 'deleteDeliveryType'])->name('delivery_types.delete');
Route::post('/delivery/{id}/update-courier', [DeliveryController::class, 'updateCourier'])->name('deliveries.update-courier');
Route::post('/delivery/{id}/update-status', [DeliveryController::class, 'updateStatus'])->name('deliveries.update-status');

Route::get('/profile-payment', [PaymentController::class, 'index'])->name('payments');
Route::post('/profile-payment/add', [PaymentController::class, 'addPaymentInfo'])->name('payments.add');
Route::delete('/payment-banks/{id}', [PaymentController::class, 'deleteBank'])->name('payment_banks.delete');

Route::get('/profile-courier', [CourierController::class, 'index'])->name('couriers.show');
Route::post('/profile-courier', [CourierController::class, 'store'])->name('couriers.store');
Route::delete('/profile-courier/{id}', [CourierController::class, 'deleteCourier'])->name('couriers.delete');

Route::get('/invoices/{id}', [InvoiceController::class, 'show'])->name('invoices.show');

// Customer Route
Route::get('/customer/login', [CustomerLoginController::class, 'showLoginForm'])->name('customer.showLogin');
Route::post('/customer/login', [CustomerLoginController::class, 'login'])->name('customer.login');
Route::post('/customer/logout', [CustomerLoginController::class, 'logout'])->name('customer.logout');

Route::get('/customer/signup', [CustomerSignUpController::class, 'showSignupForm'])->name('customer.showSignUp');
Route::post('/customer/signup', [CustomerSignUpController::class, 'signup'])->name('customer.signup');

Route::get('customer/home', [ListProductController::class, 'indexCustomer'])->name('customer.home.show');
Route::get('customer/product-detail/{id}', [ProductDetailController::class, 'customerShow'])->name('customer.product.detail');
Route::get('customer/cart', [CartController::class, 'showCart'])->name('customer.cart');
Route::post('customer/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::delete('customer/cart/{id}', [CartController::class, 'deleteFromCart'])->name('cart.delete');
Route::post('customer/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('customer/transaction-history', [TransactionHistoryController::class, 'customer_transaction_history'])->name('customer.transaction.history.show');
Route::get('customer/invoices/{id}', [InvoiceController::class, 'customerInvoiceShow'])->name('customer.invoices.show');
Route::get('customer/profile', [CustomerController::class, 'profile'])->name('customer.profile');
Route::post('customer/profile/update-picture', [CustomerController::class, 'updateProfilePicture'])->name('customer.updateProfilePicture');
Route::post('customer/profile/update', [CustomerController::class, 'updateProfile'])->name('customer.updateProfile');

Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/submit-review', [ReviewController::class, 'store'])->name('submit-review');