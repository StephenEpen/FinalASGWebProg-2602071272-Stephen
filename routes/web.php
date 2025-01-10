<?php

use App\Http\Controllers\AvatarController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TopUpController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [NavigationController::class, 'homePage'])->name('homePage');

Route::get('/set-locale/{locale}', [LocaleController::class, 'setLocale'])->name('locale.set');

Route::middleware('guest')->group(function () {

    Route::get('/login', [NavigationController::class, 'loginPage'])->name('loginPage');
    Route::post('/login', [LoginController::class, 'login'])->name('login');

    Route::get('/register', [NavigationController::class, 'registerPage'])->name('registerPage');
    Route::post('/register', [RegisterController::class, 'handleRegister'])->name('register');

    Route::get('/payment', [NavigationController::class, 'paymentPage'])->name('paymentPage');
    Route::post('/payment', [PaymentController::class, 'processPayment'])->name('payment.process');

    Route::get('/register/complete', [RegisterController::class, 'completeRegistration'])->name('register.complete');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [HomeController::class, 'logout'])->name('logout');

    Route::post('/friends/request/{id}', [FriendController::class, 'sendRequest'])->name('friends.request');
    Route::post('/friends/accept/{id}', [FriendController::class, 'acceptRequest'])->name('friends.accept');
    Route::post('/friends/reject/{id}', [FriendController::class, 'rejectRequest'])->name('friends.reject');
    Route::delete('/friends/unfriend/{id}', [FriendController::class, 'unfriend'])->name('friends.unfriend');
    Route::get('/profile', [FriendController::class, 'listFriends'])->name('friends.list');

    Route::get('/buyavatar', [NavigationController::class, 'buyAvatarPage'])->name('buyAvatarPage');
    Route::post('/buyavatar/{id}', [AvatarController::class, 'buyAvatar'])->name('buyAvatar');

    Route::get('/topup', [NavigationController::class, 'topUpPage'])->name('topUpPage');
    Route::post('/topup', [TopUpController::class, 'topUp'])->name('topup');
});
