<?php

use App\Http\Controllers\AdvanceSalaryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportingController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\HolidaysController;
use App\Http\Controllers\LeaveApplicationController;
use App\Http\Controllers\LeaveTypeController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'locale'])->group(function () {

    Route::controller(DashboardController::class)->group(function(){
        Route::get('/dashboard','data')->name('dashboard');
    });


    Route::name('designation.')->prefix('designation')->controller(DesignationController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::post('/delete/{id}', 'destroy')->name('destroy');
        Route::get('data','getDesignationData')->name('getDesignationData');
        Route::get('getData','getData')->name('getData');
    });

    Route::name('department.')->prefix('department')->controller(DepartmentController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::post('/delete/{id}', 'destroy')->name('destroy');
        Route::get('data','getDepartmentData')->name('getDepartmentData');
        Route::get('getData','getData')->name('getData');
        Route::post('change/status/{departmentId}','changeStatus')->name('changeStatus');
    });

    Route::name('holiday.')->prefix('holiday')->controller(HolidaysController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::post('/delete/{id}', 'destroy')->name('destroy');
        Route::get('data','getHolidaysData')->name('getHolidaysData');
    });

    Route::name('advancesalary.')->prefix('advance/salary')->controller(AdvanceSalaryController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::post('/delete/{id}', 'destroy')->name('destroy');
        Route::get('data','getAdvanceSalaryData')->name('getAdvanceSalaryData');
    });

    Route::name('leavetype.')->prefix('leave/type')->controller(LeaveTypeController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::post('/delete/{id}', 'destroy')->name('destroy');
        Route::get('data','getLeaveTypeData')->name('getLeaveTypeData');
        Route::get('getData','getData')->name('getData');
    });

    Route::name('leaveapplication.')->prefix('leave/application')->controller(LeaveApplicationController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/{leaveApplicationId}/show', 'show')->name('show');
        Route::get('/{leaveApplicationId}/edit', 'edit')->name('edit');
        Route::post('/{leaveApplicationId}/update', 'update')->name('update');
        Route::post('/{leaveApplicationId}/delete', 'destroy')->name('destroy');
        Route::get('data','getLeaveData')->name('getLeaveData');
        Route::get('fetchRemainingLeaves', 'fetchRemainingLeaves')->name('fetchRemainingLeaves');
        Route::post('{leaveApplicationId}/decide','decide')->name('decide');
    });

    Route::name('employees.')->prefix('employees')->controller(UserController::class)->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('{userId}/edit/', 'edit')->name('edit');
        Route::get('{userId}/show/', 'show')->name('show');
        Route::post('{userId}/update/', 'update')->name('update');
        Route::post('{userId}/delete/', 'destroy')->name('destroy');
        Route::get('data','getUserData')->name('getUserData');
        Route::post('change/status/{parameterId}','changeStatus')->name('changeStatus');
        Route::post('update/{userId}/address','updateUserAddress')->name('updateAddress');
        Route::post('update/{userId}/education','updateEducation')->name('education');
        Route::get('{userId}/fetchEducation','fetchEducation')->name('fetchEducation');
        Route::post('{educationId}/educationDelete','educationDelete')->name('education.destroy');
        Route::post('update/{userId}/experience','updateExperience')->name('experience');
        Route::get('{userId}/fetchExperience','fetchExperience')->name('fetchExperience');
        Route::post('{experienceId}/experienceDelete','experienceDelete')->name('experience.destroy');
        Route::post('update/{userId}/bankAccount','bankAccount')->name('bankAccount');
        Route::get('{userId}/fetchDocuments','fetchDocuments')->name('fetchDocuments');
        Route::post('{experienceId}/documentDelete','documentDelete')->name('document.destroy');
        Route::post('update/{userId}/document','updateDocument')->name('document');
        Route::get('getData','getData')->name('getData');
        Route::get('branches/getData','getBranchesData')->name('branches.getData');

    });

    Route::name('permissions.')->prefix('permissions')->controller(UserTypeController::class)->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('data','getUserTypeData')->name('getUserTypeData');
        Route::get('/permisions/{id}/edit','edit')->name('edit');
        Route::post('/permisions/{id}/update','update')->name('update');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('theme/change/{theme}',[ThemeController::class,'changeTheme'])->name('theme.change');
    Route::get('/change-language', [ThemeController::class, 'switchLanguage'])->name('change_language')->middleware('locale');
});

require __DIR__.'/auth.php';
