<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\homepageController;
use App\Http\Controllers\HttpController;
use App\Http\Controllers\urlpageController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User;

Route::get('/date',function(){
   /*  $date= Carbon::now(); */
   $date= new Carbon('Last Day of December 2023');
    $man_date = $date->diffForHumans();
    return $man_date;
});
//verify email
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


//reset password
Route::get('/forget-password',function(){
    return view('auth.forget-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['message' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token,'email'=>request()->email]);
})->middleware('guest')->name('password.reset');
//reset password submission handle
Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

//for http client
Route::get('/http',[HttpController::class, 'index']);
Route::get('/post',[HttpController::class, 'post_request']);
//authentication route
Route::get('/register', [authController::class, 'register_page'])->name('auth.register');
// Route for handling registration form submission
Route::post('/register', [authController::class, 'register']);
//Login route
Route::get('/login', [authController::class, 'login_page'])->name('login');
// Route for handling login form submission
Route::post('/login', [authController::class, 'login']);

Route::get('/',[homepageController::class,'index'])->name('home');

Route::middleware(['auth'])->group(function () {
Route::post('/logout', [authController::class, 'logout'])->name('logout');

//for profile
Route::get('profile', [authController::class, 'profile'])->name('profile');
Route::post('profile', [authController::class, 'update_profile']);
//list the urls  protecting route using
Route::get('/urls',[urlpageController::class,'index'])->name('urls');

//create a new url
Route::get('/urls/create',[urlpageController::class,'create'])->name('urls.create');

//store a new url
Route::post('/urls/create',[urlpageController::class,'store']);

//edit the existing url
Route::get('/urls/edit/{id}',[urlpageController::class,'edit'])->name('urls.edit');

//update  the existing url
Route::post('/urls/edit/{id}',[urlpageController::class,'update']);


//delete  the existing url
Route::post('/urls/delete/{id}',[urlpageController::class,'destroy'])->name('urls.destroy');

//view individual urls
Route::get('/urls/{id}',[ urlpageController::class, 'view'])->name('urls.view');

//route for short url
Route::get('/{short_url}',[urlpageController::class,'redirect']);
});



/* //to upload file
Route::get('file-upload',[homepageController::class,'upload_page'])->name('file.upload');
Route::post('file-upload',[homepageController::class,'upload']); */
