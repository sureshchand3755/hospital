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
use App\Http\Controllers\MediciensController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\ReceptionController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\AppoinmentModeController;
use App\Http\Controllers\SymptomsController;
use App\Http\Controllers\IllnessController;
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
Route::post('fetch-department', [AppointmentController::class, 'fetchDepartment']);
Route::get('/profile', [DashboardController::class, 'viewProfile'])->name('profile');
Route::post('/profile/update', [ProfileController::class, 'profileUpdate'])->name('profile.update');
Route::post('/change_password', [ProfileController::class, 'updatePassword'])->name('change_password');

/*------------------------------------------
Global Routes List
--------------------------------------------*/
Route::get('/visits', [VisitController::class, 'index'])->name('visit.index');
Route::get('/visit/add', [VisitController::class, 'create'])->name('visit.add');
Route::get('/visit/list', [VisitController::class, 'getVisits'])->name('visit.list');
Route::post('/visit/store', [VisitController::class, 'store']);
Route::get('visit/edit/{id}', [VisitController::class, 'edit'])->name('visit.edit');
Route::post('visit/update', [VisitController::class, 'update'])->name('visit.update');
Route::get('visit/view/{id}', [VisitController::class, 'show'])->name('visit.view');
Route::get('visit/changestatus/{id}/{status}', [VisitController::class, 'changeStatus'])->name('visit.changestatus');
Route::post('visit/delete',  [VisitController::class, 'destroy'])->name('visit.delete');
Route::get('visit/check/{id}', [VisitController::class, 'checkVisit'])->name('visit.check');

Route::get('/appoinment_modes', [AppoinmentModeController::class, 'index'])->name('appoinment_mode.index');
Route::get('/appoinment_mode/add', [AppoinmentModeController::class, 'create'])->name('appoinment_mode.add');
Route::get('/appoinment_mode/list', [AppoinmentModeController::class, 'getAppoinmentmode'])->name('appoinment_mode.list');
Route::post('/appoinment_mode/store', [AppoinmentModeController::class, 'store']);
Route::get('appoinment_mode/edit/{id}', [AppoinmentModeController::class, 'edit'])->name('appoinment_mode.edit');
Route::post('appoinment_mode/update', [AppoinmentModeController::class, 'update'])->name('appoinment_mode.update');
Route::get('appoinment_mode/view/{id}', [AppoinmentModeController::class, 'show'])->name('appoinment_mode.view');
Route::get('appoinment_mode/changestatus/{id}/{status}', [AppoinmentModeController::class, 'changeStatus'])->name('appoinment_mode.changestatus');
Route::post('appoinment_mode/delete',  [AppoinmentModeController::class, 'destroy'])->name('appoinment_mode.delete');
Route::get('appoinment_mode/check/{id}', [AppoinmentModeController::class, 'checkAppoinmentmode'])->name('appoinment_mode.check');

Route::get('/symptoms', [SymptomsController::class, 'index'])->name('symptoms.index');
Route::get('/symptoms/add', [SymptomsController::class, 'create'])->name('symptoms.add');
Route::get('/symptoms/list', [SymptomsController::class, 'getSymptoms'])->name('symptoms.list');
Route::post('/symptoms/store', [SymptomsController::class, 'store']);
Route::get('symptoms/edit/{id}', [SymptomsController::class, 'edit'])->name('symptoms.edit');
Route::post('symptoms/update', [SymptomsController::class, 'update'])->name('symptoms.update');
Route::get('symptoms/view/{id}', [SymptomsController::class, 'show'])->name('symptoms.view');
Route::get('symptoms/changestatus/{id}/{status}', [SymptomsController::class, 'changeStatus'])->name('symptoms.changestatus');
Route::post('symptoms/delete',  [SymptomsController::class, 'destroy'])->name('symptoms.delete');
Route::get('symptoms/check/{id}', [SymptomsController::class, 'checkSymptoms'])->name('symptoms.check');


Route::get('/illness', [IllnessController::class, 'index'])->name('illness.index');
Route::get('/illness/add', [IllnessController::class, 'create'])->name('illness.add');
Route::get('/illness/list', [IllnessController::class, 'getIllness'])->name('illness.list');
Route::post('/illness/store', [IllnessController::class, 'store']);
Route::get('illness/edit/{id}', [IllnessController::class, 'edit'])->name('illness.edit');
Route::post('illness/update', [IllnessController::class, 'update'])->name('illness.update');
Route::get('illness/view/{id}', [IllnessController::class, 'show'])->name('illness.view');
Route::get('illness/changestatus/{id}/{status}', [IllnessController::class, 'changeStatus'])->name('illness.changestatus');
Route::post('illness/delete',  [IllnessController::class, 'destroy'])->name('illness.delete');
Route::get('illness/check/{id}', [IllnessController::class, 'checkIllness'])->name('illness.check');


/*------------------------------------------
Reception Routes List
--------------------------------------------*/
Route::middleware(['auth', 'user-access:0'])->group(function () {
    Route::get('reception/dashboard', [HomeController::class, 'index'])->name('reception.dashboard');
    Route::get('patient/appointments', [AppointmentController::class, 'index'])->name('patient.appointment.index');
    Route::get('appointment/add', [AppointmentController::class, 'create'])->name('appointment.add');
    // Route::post('fetch-department', [AppointmentController::class, 'fetchDepartment']);
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
    Route::post('doctor/appointment/update', [AppointmentController::class, 'update']);
    Route::get('doctor/appointment/view/{id}', [AppointmentController::class, 'show'])->name('doctor.appointment.view');
    Route::post('doctor/appointment/changestatus', [AppointmentController::class, 'changeStatus'])->name('doctor.appointment.changestatus');
    Route::post('doctor/prescription/add', [PrescriptionController::class, 'store'])->name('doctor.prescription.add');
    Route::get('appointment/mediciensearch', [AppointmentController::class, 'medicienSearch'])->name('appointment.mediciensearch');


    Route::get('mediciens', [MediciensController::class, 'index'])->name('mediciens.index');
    Route::get('medicien/add', [MediciensController::class, 'create'])->name('medicien.add');
    Route::get('medicien/list', [MediciensController::class, 'getList'])->name('medicien.list');
    Route::post('medicien/store', [MediciensController::class, 'store']);
    Route::get('medicien/check/{id}', [MediciensController::class, 'checkMedicien'])->name('medicien.check');
    // Route::get('department/edit/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
    // Route::post('department/update', [DepartmentController::class, 'update'])->name('department.update');
    // Route::get('department/view/{id}', [DepartmentController::class, 'show'])->name('department.view');
    // Route::get('department/changestatus/{id}/{status}', [DepartmentController::class, 'changeStatus'])->name('department.changestatus');
    // Route::post('department/delete',  [DepartmentController::class, 'destroy'])->name('department.delete');

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

    Route::get('receptions', [ReceptionController::class, 'index'])->name('reception.list');
    Route::get('reception/add', [ReceptionController::class, 'create'])->name('reception.add');
    Route::post('reception/store', [ReceptionController::class, 'store']);
    Route::get('reception/list', [ReceptionController::class, 'getList'])->name('reception.lists');
    Route::get('reception/view/{id}', [ReceptionController::class, 'show'])->name('reception.view');
    Route::get('reception/edit/{id}', [ReceptionController::class, 'edit'])->name('reception.edit');
    Route::post('reception/update', [ReceptionController::class, 'update'])->name('reception.update');
    Route::get('reception/changestatus/{id}/{status}', [ReceptionController::class, 'changeStatus'])->name('reception.changestatus');
    Route::post('reception/delete',  [ReceptionController::class, 'destroy'])->name('reception.delete');
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
    // Route::post('fetch-department', [AppointmentController::class, 'fetchDepartment']);
    Route::post('admin/appointment/store', [AppointmentController::class, 'store']);
    Route::get('admin/patient/appointment/list', [AppointmentController::class, 'getList'])->name('admin.patient.appointment.list');
    Route::get('admin/appointment/edit/{id}', [AppointmentController::class, 'edit'])->name('admin.appointment.edit');
    Route::get('admin/appointment/clone/{id}', [AppointmentController::class, 'clone'])->name('admin.appointment.clone');
    Route::post('admin/appointment/cloneStore', [AppointmentController::class, 'cloneStore']);
    Route::post('admin/appointment/update', [AppointmentController::class, 'update']);
    Route::post('admin/appointment/delete',  [AppointmentController::class, 'destroy'])->name('admin.appointment.delete');
    Route::post('admin/appointment/changestatus', [AppointmentController::class, 'changeStatus'])->name('admin.appointment.changestatus');
    Route::get('admin/appointment/view/{id}', [AppointmentController::class, 'show'])->name('admin.patient.appointment.view');
    Route::get('generate_report/{id}', [AppointmentController::class, 'generateReport']);


    Route::get('admin/hospitals', [HospitalController::class, 'index'])->name('admin.hospital.list');
    Route::get('admin/hospital/add', [HospitalController::class, 'create'])->name('admin.hospital.add');
    Route::post('admin/hospital/store', [HospitalController::class, 'store']);
    Route::get('admin/hospital/list', [HospitalController::class, 'getList'])->name('admin.hospital.lists');
    Route::get('admin/hospital/view/{id}', [HospitalController::class, 'show'])->name('admin.hospital.view');
    Route::get('admin/hospital/edit/{id}', [HospitalController::class, 'edit'])->name('admin.hospital.edit');
    Route::post('admin/hospital/update', [HospitalController::class, 'update'])->name('admin.hospital.update');
    Route::get('admin/hospital/changestatus/{id}/{status}', [HospitalController::class, 'changeStatus'])->name('admin.hospital.changestatus');
    Route::post('admin/hospital/delete',  [HospitalController::class, 'destroy'])->name('admin.hospital.delete');

    Route::get('admin/receptions', [ReceptionController::class, 'index'])->name('admin.reception.list');
    Route::get('admin/reception/add', [ReceptionController::class, 'create'])->name('admin.reception.add');
    Route::post('admin/reception/store', [ReceptionController::class, 'store']);
    Route::get('admin/reception/list', [ReceptionController::class, 'getList'])->name('admin.reception.lists');
    Route::get('admin/reception/view/{id}', [ReceptionController::class, 'show'])->name('admin.reception.view');
    Route::get('admin/reception/edit/{id}', [ReceptionController::class, 'edit'])->name('admin.reception.edit');
    Route::post('admin/reception/update', [ReceptionController::class, 'update'])->name('admin.reception.update');
    Route::get('admin/reception/changestatus/{id}/{status}', [ReceptionController::class, 'changeStatus'])->name('admin.reception.changestatus');
    Route::post('admin/reception/delete',  [ReceptionController::class, 'destroy'])->name('admin.reception.delete');

    Route::get('admin/doctors', [DoctorsController::class, 'index'])->name('admin.doctor.list');
    Route::get('admin/doctor/add', [DoctorsController::class, 'create'])->name('admin.doctor.add');
    Route::post('admin/doctor/store', [DoctorsController::class, 'store']);
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
    Route::get('admin/department/check-department/{id}', [DepartmentController::class, 'checkDepartment'])->name('admin.department.check-department');
});
