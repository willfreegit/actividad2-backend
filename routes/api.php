<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\ApprovalsController;
use App\Http\Controllers\BenefitsController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HolidaysController;
use App\Http\Controllers\JobHistoryController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\RulesController;
use App\Http\Controllers\VacationsController;
use App\Http\Controllers\AuthorizationController;

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

Route::controller(AuthorizationController::class)->prefix('auth')->group(function(){
    Route::post('/postLogin', 'postLoginApi');
    Route::post('/postRegistration', 'postRegistrationApi');
});

Route::controller(AbsenceController::class)->prefix('absences')->group(function(){
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}', 'update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'destroy');
});

Route::controller(ApprovalsController::class)->prefix('approvals')->group(function(){
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}', 'update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'destroy');
});

Route::controller(BenefitsController::class)->prefix('benefits')->group(function(){
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}', 'update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'destroy');
});

Route::controller(DepartmentController::class)->prefix('departments')->group(function(){
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}', 'update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'destroy');
});

Route::controller(EmployeeController::class)->prefix('employees')->group(function(){
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}', 'update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'destroy');
});

Route::controller(HolidaysController::class)->prefix('holidays')->group(function(){
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}', 'update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'destroy');
});

Route::controller(JobHistoryController::class)->prefix('jobHistory')->group(function(){
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}', 'update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'destroy');
});

Route::controller(RequestController::class)->prefix('requests')->group(function(){
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}', 'update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'destroy');
});

Route::controller(RulesController::class)->prefix('rules')->group(function(){
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}', 'update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'destroy');
});

Route::controller(VacationsController::class)->prefix('vacations')->group(function(){
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::post('/{id}', 'update');
    Route::put('/{id}', 'put');
    Route::get('/{id}', 'show');
    Route::delete('/{id}', 'destroy');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
