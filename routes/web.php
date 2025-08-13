<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use Illuminate\Auth\Events\Verified;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

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

// Route::get('/send-email', function () {
//     Mail::raw('Ini adalah email tes dari Laravel menggunakan Gmail.', function ($message) {
//         $message->to('recipient@example.com')
//                 ->subject('Tes Email');
//     });

//     return 'Email berhasil dikirim';
// }); disini untuk mengetes verifikasi email menggunakan gmail dan ini independent tidak membutuhkan view, model, dll.

Route::get('/', function () {
    return view('welcome');
});

Route::get('/email/verify/{id}/{hash}', function ($id, $hash) {
    $user = User::findOrFail($id);

    
    if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
        abort(403, 'Invalid verification link.');
    }

    
    if ($user->hasVerifiedEmail()) {
        return redirect()->route('login')->with('success', 'Email sudah diverifikasi sebelumnya.');
    }

    
    $user->markEmailAsVerified();
    event(new Verified($user));

    return redirect()->route('login')->with('success', 'Email berhasil diverifikasi, silakan login.');
})->middleware(['signed'])->name('verification.verify');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/google/redirect', [LoginController::class, 'redirect'])->name('google.redirect');
Route::get('/google/callback', [LoginController::class, 'callback'])->name('google.callback');


Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register-proses', [LoginController::class, 'register_proses'])->name('register-proses');

Route::get('/user', [UserController::class, 'index'])->name('user');
Route::get('/create/user', [UserController::class, 'create'])->name('user.create');
Route::post('/store/user', [UserController::class, 'store'])->name('user.store');
Route::get('/edit/user/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/update/user/{id}z', [UserController::class, 'update'])->name('user.update'); 
Route::delete('/delete/user/{id}', [UserController::class, 'delete'])->name('user.delete');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
