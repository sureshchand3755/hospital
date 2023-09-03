<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PrescriptionController;
use Illuminate\Support\Facades\Artisan;

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

Auth::routes();

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');

    return "Cache cleared successfully";
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);
    Route::post('fetch-states', [DoctorsController::class, 'fetchState']);
    Route::post('fetch-cities', [DoctorsController::class, 'fetchCity']);
    Route::get('logout', [HomeController::class, 'destroy'])->name('logout');


/*------------------------------------------
Reception Routes List
--------------------------------------------*/
Route::middleware(['auth', 'user-access:0'])->group(function () {
    Route::get('reception/dashboard', [HomeController::class, 'index'])->name('reception.dashboard');
    Route::get('patient/appointments', [AppointmentController::class, 'index'])->name('appointment.index');
    Route::get('appointment/add', [AppointmentController::class, 'create'])->name('appointment.add');
    Route::post('fetch-department', [AppointmentController::class, 'fetchDepartment']);
    Route::post('appointment/store', [AppointmentController::class, 'store']);
    Route::get('patient/appointment/list', [AppointmentController::class, 'getList'])->name('patient.appointment.list');
    Route::get('appointment/edit/{id}', [AppointmentController::class, 'edit'])->name('appointment.edit');
    Route::post('appointment/update', [AppointmentController::class, 'update']);
    Route::post('appointment/delete',  [AppointmentController::class, 'destroy'])->name('appointment.delete');
    Route::post('appointment/changestatus', [AppointmentController::class, 'changeStatus'])->name('appointment.changestatus');
    Route::get('appointment/view/{id}', [AppointmentController::class, 'show'])->name('patient.appointment.view');

    // Route::get('/patient/profile', [DashboardController::class, 'viewProfile'])->name('patient.profile');
    // Route::post('/patient/profile', [ProfileController::class, 'store']);

    // Route::get('patient/appointments', [AppointmentController::class, 'index'])->name('patient.appointments');
    // Route::get('appointment/add', [AppointmentController::class, 'create'])->name('appointment.add');
    // Route::post('appointment/store', [AppointmentController::class, 'store']);
    // Route::get('appointment/list', [AppointmentController::class, 'getList'])->name('appointment.list');

});

/*------------------------------------------
Doctor Routes List
--------------------------------------------*/
Route::middleware(['auth', 'user-access:1'])->group(function () {
    Route::get('doctor/dashboard', [HomeController::class, 'doctorDashbord'])->name('doctor.dashboard');
    Route::get('appointments', [AppointmentController::class, 'index'])->name('appointment.index');
    Route::get('appointment/list', [AppointmentController::class, 'getList'])->name('appointment.list');
    Route::get('doctor/appointment/view/{id}', [AppointmentController::class, 'show'])->name('doctor.appointment.view');
    Route::post('doctor/appointment/changestatus', [AppointmentController::class, 'changeStatus'])->name('doctor.appointment.changestatus');
    Route::post('doctor/prescription/add', [PrescriptionController::class, 'store'])->name('doctor.prescription.add');

});

/*------------------------------------------
--------------------------------------------
Hospital Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:2'])->group(function () {
    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
    Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
    Route::get('/department/add', [DepartmentController::class, 'create'])->name('department.add');
    Route::get('/department/list', [DepartmentController::class, 'getDepartments'])->name('department.list');
    Route::post('/department/store', [DepartmentController::class, 'store']);
    Route::get('department/edit/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
    Route::post('department/update', [DepartmentController::class, 'update'])->name('department.update');
    Route::get('department/view/{id}', [DepartmentController::class, 'show'])->name('department.view');
    Route::get('department/changestatus/{id}/{status}', [DepartmentController::class, 'changeStatus'])->name('department.changestatus');
    Route::post('department/delete',  [DepartmentController::class, 'destroy'])->name('department.delete');

    Route::get('/doctors', [DoctorsController::class, 'index'])->name('doctor.list');
    Route::get('doctor/add', [DoctorsController::class, 'create'])->name('doctor.add');
    Route::post('doctor/store', [DoctorsController::class, 'store']);
    Route::get('doctor/list', [DoctorsController::class, 'getDoctors'])->name('doctor.lists');
    Route::get('doctor/edit/{id}', [DoctorsController::class, 'edit'])->name('doctor.edit');
    Route::post('doctor/update', [DoctorsController::class, 'update'])->name('doctor.update');
    Route::get('doctor/changestatus/{id}/{status}', [DoctorsController::class, 'changeStatus'])->name('doctor.changestatus');
    Route::post('doctor/delete',  [DoctorsController::class, 'destroy'])->name('doctor.delete');
});
/*------------------------------------------
--------------------------------------------
Super Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:3'])->group(function () {
    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
});
