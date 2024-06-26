<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventRequestController;
use App\Http\Controllers\RequestTypeController;
use App\Http\Controllers\ResolverController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ReportController;

Route::get('/', [PostController::class,'login'])->name('login');
Route::post('login-user', [PostController::class,'loginUser'])->name('login-user');
Route::get('store/posts', [PostController::class,'store']);
Route::get('logout', [PostController::class,'logout'])->name('logout');

Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
    /* request functionality routs */
    Route::prefix('request')->group(function () {        
        Route::get('create', [EventRequestController::class,'index'])->name('req.create');
        Route::post('store', [EventRequestController::class,'store'])->name('req.store');       
        Route::get('edit/{id}', [EventRequestController::class,'edit'])->name('req.edit');
        Route::post('update/{id}', [EventRequestController::class,'update'])->name('req.update');

        Route::get('allrequest/{name?}', [EventRequestController::class,'allrequest'])->name('req.allrequest');
        Route::get('myactive', [EventRequestController::class,'myactive'])->name('req.myactive');
        Route::get('myclose', [EventRequestController::class,'myclose'])->name('req.myclose');
    });

    /* request-type master functionality routs */
    Route::prefix('request-type')->group(function () {        
        Route::get('/index', [RequestTypeController::class,'index'])->name('reqtype.index');
        Route::get('create', [RequestTypeController::class,'create'])->name('reqtype.create');
        Route::post('store', [RequestTypeController::class,'store'])->name('reqtype.store');
        Route::get('edit/{id}', [RequestTypeController::class,'edit'])->name('reqtype.edit');
        Route::post('update/{id}', [RequestTypeController::class,'update'])->name('reqtype.update');
    });

    /* resolver account functionality routs */
    Route::prefix('resolver')->group(function () {  
        Route::get('index', [ResolverController::class,'index'])->name('res.index');
        Route::get('create', [ResolverController::class,'create'])->name('res.create');
        route::post('store', [ResolverController::class, 'store'])->name('res.store');
        route::get('usersList/{id}', [ResolverController::class, 'userList'])->name('userList');
        Route::get('edit/{id}', [ResolverController::class,'edit'])->name('res.edit');
        Route::post('update/{id}', [ResolverController::class,'update'])->name('res.update');
        Route::get('assignto', [ResolverController::class, 'assignto'])->name('assignto');
    });
    /* report section */
    Route::prefix('reports')->group(function () {
        Route::get('/index', [ReportController::class, 'index'])->name('reports.index');
        Route::post('/store', [ReportController::class, 'store'])->name('reports.store');            
    });

    route::post('comment/{id}', [CommentController::class, 'save'])->name('comment');

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');









