<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\CompanyBlacklistController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\RequirementController;

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
    return view('welcome');
});

Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'dashboard'])->name('admin.index');
    Route::prefix('ads')->group(function () {
        Route::get('/', [AdController::class, 'index'])->name('admin.ads.index');
        Route::get('/create', [AdController::class, 'create'])->name('admin.ads.create');
        Route::post('/store', [AdController::class, 'store'])->name('admin.ads.store');
        Route::get('/show/{ad}', [AdController::class, 'show'])->name('admin.ads.show');
        Route::get('/edit/{ad}', [AdController::class, 'edit'])->name('admin.ads.edit');
        Route::put('/update/{ad}', [AdController::class, 'update'])->name('admin.ads.update');
        Route::delete('/destroy/{ad}', [AdController::class, 'destroy'])->name('admin.ads.destroy');
    });
    Route::prefix('companies')->group(function () {
        Route::get('/', [CompanyController::class, 'index'])->name('admin.companies.index');
        Route::get('/create', [CompanyController::class, 'create'])->name('admin.companies.create');
        Route::post('/store', [CompanyController::class, 'store'])->name('admin.companies.store');
        Route::post('/store-modal', [CompanyController::class, 'store'])->name('admin.companies.store-modal');
        Route::get('/show/{company}', [CompanyController::class, 'show'])->name('admin.companies.show');
        Route::get('/edit/{company}', [CompanyController::class, 'edit'])->name('admin.companies.edit');
        Route::put('/update/{company}', [CompanyController::class, 'update'])->name('admin.companies.update');
        Route::delete('/destroy/{company}', [CompanyController::class, 'destroy'])->name('admin.companies.destroy');
        Route::prefix('blacklist')->group(function () {
            Route::get('/', [CompanyBlacklistController::class, 'index'])->name('admin.companies.blacklist.index');
            Route::get('/create', [CompanyBlacklistController::class, 'create'])->name('admin.companies.blacklist.create');
            Route::post('/store', [CompanyBlacklistController::class, 'store'])->name('admin.companies.blacklist.store');
            Route::get('/show/{company}', [CompanyBlacklistController::class, 'show'])->name('admin.companies.blacklist.show');
            Route::get('/edit/{company}', [CompanyBlacklistController::class, 'edit'])->name('admin.companies.blacklist.edit');
            Route::put('/update/{company}', [CompanyBlacklistController::class, 'update'])->name('admin.companies.blacklist.update');
            Route::delete('/destroy/{company}', [CompanyBlacklistController::class, 'destroy'])->name('admin.companies.blacklist.destroy');
            Route::put('/change-violation-status/{company}', [CompanyBlacklistController::class, 'changeViolationStatus'])->name('admin.companies.blacklist.changeViolationStatus');
        });
    });
    Route::prefix('jobs')->group(function () {
        Route::get('/', [JobController::class, 'index'])->name('admin.jobs.index');
        Route::get('/create', [JobController::class, 'create'])->name('admin.jobs.create');
        Route::post('/store', [JobController::class, 'store'])->name('admin.jobs.store');
        Route::post('/store-modal', [JobController::class, 'storeModal'])->name('admin.jobs.store-modal');
        Route::get('/show/{job}', [JobController::class, 'show'])->name('admin.jobs.show');
        Route::get('/edit/{job}', [JobController::class, 'edit'])->name('admin.jobs.edit');
        Route::put('/update/{job}', [JobController::class, 'update'])->name('admin.jobs.update');
        Route::delete('/destroy/{job}', [JobController::class, 'destroy'])->name('admin.jobs.destroy');
    });
    Route::prefix('requirements')->group(function () {
        Route::get('/', [RequirementController::class, 'index'])->name('admin.requirements.index');
        Route::get('/create', [RequirementController::class, 'create'])->name('admin.requirements.create');
        Route::post('/store', [RequirementController::class, 'store'])->name('admin.requirements.store');
        Route::post('/store-modal', [RequirementController::class, 'storeModal'])->name('admin.requirements.store-modal');
        Route::get('/show/{requirement}', [RequirementController::class, 'show'])->name('admin.requirements.show');
        Route::get('/edit/{requirement}', [RequirementController::class, 'edit'])->name('admin.requirements.edit');
        Route::put('/update/{requirement}', [RequirementController::class, 'update'])->name('admin.requirements.update');
        Route::delete('/destroy/{requirement}', [RequirementController::class, 'destroy'])->name('admin.requirements.destroy');
    });
});
