<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Blade\Permisson\PermissonController;
use App\Http\Controllers\Blade\User\UserProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('home');
});


Route::middleware('guest')->group(function (){

    Route::get('login',[LoginController::class,'login'])->name('login');
    Route::post('login',[LoginController::class,'login_store'])->name('login_store');
    Route::get('reset',[LoginController::class,'reset'])->name('reset');
    Route::get('register',[RegisterController::class,'create'])->name('register');
    Route::post('register',[RegisterController::class,'store'])->name('store');
    Route::get('reset',[LoginController::class,'reset'])->name('reset');
});

Route::group(['middleware' => 'auth'],function (){
    Route::get('/home',[HomeController::class,'index'])->name('home');

    //user profile
    //users
    Route::get('/profile',[UserProfileController::class,'index'])->name('profile');
    Route::post('/profile',[UserProfileController::class,'store'])->name('profile_store');
    Route::post('logout', [RegisterController::class, 'destroy'])->name('logout');

    // Permissions
    Route::get('/permission',[PermissonController::class,'index'])->name('permissionIndex');
    Route::get('/permission/add',[PermissonController::class,'add'])->name('permissionAdd');
    Route::post('/permission/create',[PermissonController::class,'create'])->name('permissionCreate');
    Route::get('/permission/{id}/edit',[PermissonController::class,'edit'])->name('permissionEdit');
    Route::post('/permission/update/{id}',[PermissonController::class,'update'])->name('permissionUpdate');
    Route::delete('/permission/delete/{id}',[PermissonController::class,'destroy'])->name('permissionDestroy');
});

