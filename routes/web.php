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
    Route::get('patient/appointments', [AppointmentController::class, 'index'])->name('patient.appointment.index');
    Route::get('appointment/add', [AppointmentController::class, 'create'])->name('appointment.add');
    Route::post('fetch-department', [AppointmentController::class, 'fetchDepartment']);
    Route::post('appointment/store', [AppointmentController::class, 'store']);
    Route::get('patient/appointment/list', [AppointmentController::class, 'getList'])->name('patient.appointment.list');
    Route::get('appointment/edit/{id}', [AppointmentController::class, 'edit'])->name('appointment.edit');
    Route::get('appointment/clone/{id}', [AppointmentController::class, 'clone'])->name('appointment.clone');
    Route::post('appointment/cloneStore', [AppointmentController::class, 'cloneStore']);
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
    Route::get('doctor/appointment/edit/{id}', [AppointmentController::class, 'edit'])->name('doctor.appointment.edit');
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
    Route::get('hospital/dashboard', [HomeController::class, 'hospitalHome'])->name('hospital.dashboard');

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

    Route::get('admin/dashboard', [HomeController::class, 'adminHome'])->name('admin.dashboard');
    Route::get('admin/patient/appointments', [AppointmentController::class, 'index'])->name('admin.patient.appointment.index');
    Route::get('admin/appointment/add', [AppointmentController::class, 'create'])->name('admin.appointment.add');
    Route::post('fetch-department', [AppointmentController::class, 'fetchDepartment']);
    Route::post('admin/appointment/store', [AppointmentController::class, 'store']);
    Route::get('admin/patient/appointment/list', [AppointmentController::class, 'getList'])->name('admin.patient.appointment.list');
    Route::get('admin/appointment/edit/{id}', [AppointmentController::class, 'edit'])->name('admin.appointment.edit');
    Route::get('admin/appointment/clone/{id}', [AppointmentController::class, 'clone'])->name('admin.appointment.clone');
    Route::post('admin/appointment/cloneStore', [AppointmentController::class, 'cloneStore']);
    Route::post('admin/appointment/update', [AppointmentController::class, 'update']);
    Route::post('admin/appointment/delete',  [AppointmentController::class, 'destroy'])->name('admin.appointment.delete');
    Route::post('admin/appointment/changestatus', [AppointmentController::class, 'changeStatus'])->name('admin.appointment.changestatus');
    Route::get('admin/appointment/view/{id}', [AppointmentController::class, 'show'])->name('admin.patient.appointment.view');

    Route::get('admin/doctors', [DoctorsController::class, 'index'])->name('admin.doctor.list');
    Route::get('admin.doctor/add', [DoctorsController::class, 'create'])->name('admin.doctor.add');
    Route::post('admindoctor/store', [DoctorsController::class, 'store']);
    Route::get('admin/doctor/list', [DoctorsController::class, 'getDoctors'])->name('admin.doctor.lists');
    Route::get('admin/doctor/edit/{id}', [DoctorsController::class, 'edit'])->name('admin.doctor.edit');
    Route::post('admin/doctor/update', [DoctorsController::class, 'update'])->name('admin.doctor.update');
    Route::get('admin/doctor/changestatus/{id}/{status}', [DoctorsController::class, 'changeStatus'])->name('admin.doctor.changestatus');
    Route::post('admin/doctor/delete',  [DoctorsController::class, 'destroy'])->name('admin.doctor.delete');

    Route::get('admin/departments', [DepartmentController::class, 'index'])->name('admin.departments.index');
    Route::get('admin/department/add', [DepartmentController::class, 'create'])->name('admin.department.add');
    Route::get('admin/department/list', [DepartmentController::class, 'getDepartments'])->name('admin.department.list');
    Route::post('admin/department/store', [DepartmentController::class, 'store']);
    Route::get('admin/department/edit/{id}', [DepartmentController::class, 'edit'])->name('admin.department.edit');
    Route::post('admin/department/update', [DepartmentController::class, 'update'])->name('admin.department.update');
    Route::get('admin/department/view/{id}', [DepartmentController::class, 'show'])->name('admin.department.view');
    Route::get('admin/department/changestatus/{id}/{status}', [DepartmentController::class, 'changeStatus'])->name('admin.department.changestatus');
    Route::post('admin/department/delete',  [DepartmentController::class, 'destroy'])->name('admin.department.delete');
});
