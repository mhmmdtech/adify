<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\CompanyBlacklistController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\RequirementController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::prefix('ads')->group(function () {
        Route::post('/store', [AdController::class, 'store'])->name('api.admin.ads.store');
        Route::put('/update/{ad}', [AdController::class, 'update'])->name('api.admin.ads.update');
    });
    Route::prefix('companies')->group(function () {
        Route::post('/store', [CompanyController::class, 'store'])->name('api.admin.companies.store');
        Route::post('/store-modal', [CompanyController::class, 'storeModal'])->name('api.admin.companies.store-modal');
        Route::put('/update/{company}', [CompanyController::class, 'update'])->name('api.admin.companies.update');
        Route::prefix('blacklist')->group(function () {
            Route::post('/store', [CompanyBlacklistController::class, 'store'])->name('api.admin.companies.blacklist.store');
            Route::put('/update/{company}', [CompanyBlacklistController::class, 'update'])->name('api.admin.companies.blacklist.update');
        });
    });
    Route::prefix('jobs')->group(function () {
        Route::post('/store', [JobController::class, 'store'])->name('api.admin.jobs.store');
        Route::post('/store-modal', [JobController::class, 'storeModal'])->name('api.admin.jobs.store-modal');
        Route::put('/update/{job}', [JobController::class, 'update'])->name('api.admin.jobs.update');
    });
    Route::prefix('requirements')->group(function () {
        Route::post('/store', [RequirementController::class, 'store'])->name('api.admin.requirements.store');
        Route::post('/store-modal', [RequirementController::class, 'storeModal'])->name('api.admin.requirements.store-modal');
        Route::put('/update/{requirement}', [RequirementController::class, 'update'])->name('api.admin.requirements.update');
    });
});
Route::match(['get', 'post'], '/get-companies', [CompanyController::class, 'getCompanies'])->name('get-companies');
Route::match(['get', 'post'], '/company-by-id', [CompanyController::class, 'companyById'])->name('company-by-id');
Route::match(['get', 'post'], '/get-jobs', [JobController::class, 'getjobs'])->name('get-jobs');
Route::match(['get', 'post'], '/job-by-id', [JobController::class, 'jobById'])->name('job-by-id');
Route::match(['get', 'post'], '/get-requirements', [RequirementController::class, 'getRequirements'])->name('get-requirements');
