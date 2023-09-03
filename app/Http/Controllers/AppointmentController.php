<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use App\Models\State;
use App\Models\City;
use App\Models\Department;
use App\Models\PatientDetails;
use App\Models\DoctorInfo;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use Illuminate\Http\Request;
use DataTables;
use DateTime;
use URL;
use Carbon\Carbon;
use Form;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

       return view('appointments.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $defaultSelection = [''=>'Please Select'];
        $doctor = $defaultSelection + User::where('type',1)->where('status',0)->where('deleted_at','N')->pluck("name", "id")->toArray();
        $states = $defaultSelection + State::pluck("name", "id")->toArray();
        $department = $defaultSelection + Department::where('status',0)->where('deleted_at','N')->pluck("department_name", "id")->toArray();
        return view('appointments.add', compact('doctor', 'states', 'department'));
    }

    public function fetchDepartment(Request $request)
    {
        $info = DoctorInfo::where("user_id",$request->doctor_id)->get()->first();
        $data['department'] = Department::where("id",$info->department_id)->get(["department_name", "id"]);
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $str = 'Appolo Hospital';
        $prefix = substr($str,0,3);
        $appointment_no = IdGenerator::generate(['table' => 'patient_details','field'=>'appointment_no', 'length' => 7, 'prefix' =>strtoupper($prefix)]);
        $appointment = new PatientDetails();
        $appointment->appointment_no = $appointment_no;
        $appointment->subtitle = $request->subtitle;
        $appointment->email = $request->email;
        $appointment->phone_number = $request->phone_number;
        $appointment->patient_name = $request->patient_name;
        $date = explode('/', $request->date_of_birth);
        $appointment->date_of_birth = date("Y-m-d", strtotime($date[0].'-'.$date[1].'-'.$date[2]));
        $appointment->age = $request->age;
        $appointment->gender = $request->gender;
        $appointment->aadhar_number = $request->aadhar_number;
        $appointment->father_or_husband = $request->father_or_husband;
        $appointment->father_or_husband_name = $request->father_or_husband_name;
        $appointment->mother_or_wife = $request->mother_or_wife;
        $appointment->mother_or_wife_name = $request->mother_or_wife_name;
        $appointment->guardian_name = $request->guardian_name;
        $appointment->address = $request->address;
        $appointment->state_id = $request->state_id;
        $appointment->city_id = $request->city_id;
        $appointment->postal_code = $request->postal_code;
        $appointment->phone_number = $request->phone_number;
        $appointment->education = $request->education;
        $appointment->ref_by = $request->ref_by;
        $appointment->occupation = $request->occupation;
        $appointment->send_alert = $request->send_alert;
        $appointment->blood = $request->blood;
        $appointment->diet = $request->diet;
        $appointment->height = $request->height;
        $appointment->weight = $request->weight;
        $appointment->brith_weight = $request->brith_weight;
        $appointment->any_mediciens = $request->any_mediciens;
        $appointment->note = $request->note;
        $appointment->doctor_id = $request->doctor_id;
        $appointment->department_id = $request->department_id;
        $appointment->save();
        return Redirect::route('appointment.index')->with('success','Appointment booked successfully!');

        // $str = 'Appolo Hospital';
        // $prefix = substr($str,0,3);
        // $appointment_no = IdGenerator::generate(['table' => 'appointments','field'=>'appointment_no', 'length' => 7, 'prefix' =>strtoupper($prefix)]);
        // $appointment = new Appointment();
        // $appointment->appointment_no = $appointment_no;
        // $date = explode('/', $request->appointment_date);
        // $appointment->appointment_date = date("Y-m-d", strtotime($date[0].'-'.$date[1].'-'.$date[2]));
        // $appointment->hospital_id = $request->hospital_id;
        // $appointment->doctor_id = $request->doctor_id;
        // $appointment->treatment_id = $request->treatment_id;
        // $appointment->note = $request->note;
        // $appointment->created_at = new Carbon();
        // $appointment->save();
        // return Redirect::route('patient.appointments')->with('success','Appoinment booked successfully!');
    }

    public function getList(){
        // $status = [
        //     ''=>'--Select--',
        //     'P'=>'<span class="badge bg-primary-light">Pending</span>',
        //     'C'=>'<span class="badge bg-success-light">Completed</span>',
        // ];
        $status = [
            ''=>'--Select--',
            'P'=>'Pending',
            'R'=>'Reschedule',
            'A'=>'Approved',
            'C'=>'Completed',
        ];
        $doctorstatus = [
            ''=>'--Select--',
            'R'=>'Reschedule',
            'A'=>'Approved',
        ];
        $data = PatientDetails::with(['doctordetails','department'])->where('deleted_at','N');
        if(Auth::user()->type==1){
            $data = $data->where('doctor_id',Auth::user()->id);
        }
        $data = $data->latest()->get();

        $dt = Datatables::of($data)
                ->addColumn('idRows', function($row){
                    $actionBtn = '<div class="form-check check-tables">
                            <input class="form-check-input" type="checkbox" value="something">
                        </div>';
                    return $actionBtn;
                })
                ->addColumn('appointment_no', function($row){
                    return $row->appointment_no;
                })
                ->addColumn('patient_name', function($row){
                    return $row->patient_name;
                })
                ->addColumn('date_of_birth', function($row){
                    return date("d-m-Y", strtotime($row->date_of_birth));
                })
                ->addColumn('age', function($row){
                    return $row->age;
                })
                ->addColumn('patient_gender', function($row){
                    return $row->gender;
                })
                ->addColumn('patient_mobile', function($row){
                    return $row->phone_number;
                });
                if(Auth::user()->type==0){
                    $dt =  $dt->addColumn('doctor', function($row){
                        return $row->doctordetails->name;
                    })
                    ->addColumn('department', function($row){
                        return $row->department->department_name;
                    });
                }else{
                    $dt =  $dt->addColumn('address', function($row){
                        return $row->address;
                    });
                }
                $dt =  $dt->addColumn('status', function($row) use($status, $doctorstatus){

                    $actionBtn=Form::select('status', $status, $row->status, ['class' => 'form-control select','id' => 'status', 'data-id'=>$row->id]);
                    if(Auth::user()->type==1){
                        $actionBtn=Form::select('status', $doctorstatus, $row->status, ['class' => 'form-control select','id' => 'status', 'data-id'=>$row->id]);
                    }

                    // if($row->status=='P'){
                    //     $actionBtn='<span class="badge bg-primary-light">Pending</span>';
                    // }
                    // $actionBtn='';
                    // if($row->status==0){
                    //     $statusVal = 1;
                    //     $actionBtn='<a href="'.url('doctor/changestatus/'.$row->id.'/'.$statusVal).'"<button class="custom-badge status-green ">Active</button></a>';
                    // }
                    // if($row->status==1){
                    //     $statusVal = 0;
                    //     $actionBtn='<a href="'.url('doctor/changestatus/'.$row->id.'/'.$statusVal).'"<button class="custom-badge status-pink">In Active</button></a>';
                    // }
                    return $actionBtn;
                });

                if(Auth::user()->type==0){
                    $dt =  $dt->addColumn('action', function($row){
                        $actionBtn = '<div class="dropdown dropdown-action">
                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item view_appointment" data-id="'.$row->id.'" data-bs-toggle="modal" data-bs-target="#view_appointment" href="#"><i class="fa-solid fa-eye m-r-5"></i> View</a>
                        <a class="dropdown-item" href="'.url('appointment/edit/'.$row->id).'"><i class="fa-solid fa-pen-to-square m-r-5"></i> Edit</a>
                        <a class="dropdown-item delete_appointment" href="#" data-id="'.$row->id.'"  data-bs-toggle="modal" data-bs-target="#delete_appointment"><i class="far fa-trash-alt m-r-5"></i> Delete</a>
                        </div>';
                        return $actionBtn;
                    })
                    ->rawColumns(['idRows','appointment_no','patient_name','date_of_birth','age', 'patient_gender',  'patient_mobile',  'doctor',  'department', 'status', 'action']);
                }else{
                    $dt =  $dt->addColumn('action', function($row){
                        $actionBtn = '<div class="dropdown dropdown-action">
                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                        <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item view_appointment" data-bs-target="#view_appointment"  data-bs-toggle="modal" data-id="'.$row->id.'" data-doctorid="1" href="#"><i class="fa-solid fa-eye m-r-5"></i> View</a>';
                        if($row->status=='A'){
                            $actionBtn .='<a class="dropdown-item prescription" data-bs-target="#prescription" href="#" data-bs-toggle="modal" data-id="'.$row->id.'" data-doctorid="'.$row->doctor_id.'" ><i class="fas fa-book-medical m-r-5"></i> Add Medicine</a>';
                        }
                        $actionBtn .='</div>';
                        return $actionBtn;
                    })
                    ->rawColumns(['idRows','appointment_no','patient_name','date_of_birth','age', 'patient_gender',  'patient_mobile', 'address', 'status', 'action']);
                }
        return $dt->make(true);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = PatientDetails::with(['doctordetails','department','state','city', 'patientprescription'])->where('id', $id)->first();
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $defaultSelection = [''=>'Please Select'];
        $doctor = $defaultSelection + User::where('type',1)->where('status',0)->where('deleted_at','N')->pluck("name", "id")->toArray();
        $states = $defaultSelection + State::pluck("name", "id")->toArray();
        $department = $defaultSelection + Department::where('status',0)->where('deleted_at','N')->pluck("department_name", "id")->toArray();
        $data = PatientDetails::where('id',$id)->get()->first();
        return view('appointments.edit', compact('data', 'doctor', 'department','states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $appointment = PatientDetails::find($request->id);
        $appointment->subtitle = $request->subtitle;
        $appointment->email = $request->email;
        $appointment->phone_number = $request->phone_number;
        $appointment->patient_name = $request->patient_name;
        $date = explode('/', $request->date_of_birth);
        $appointment->date_of_birth = date("Y-m-d", strtotime($date[0].'-'.$date[1].'-'.$date[2]));
        $appointment->age = $request->age;
        $appointment->gender = $request->gender;
        $appointment->aadhar_number = $request->aadhar_number;
        $appointment->father_or_husband = $request->father_or_husband;
        $appointment->father_or_husband_name = $request->father_or_husband_name;
        $appointment->mother_or_wife = $request->mother_or_wife;
        $appointment->mother_or_wife_name = $request->mother_or_wife_name;
        $appointment->guardian_name = $request->guardian_name;
        $appointment->address = $request->address;
        $appointment->state_id = $request->state_id;
        $appointment->city_id = $request->city_id;
        $appointment->postal_code = $request->postal_code;
        $appointment->phone_number = $request->phone_number;
        $appointment->education = $request->education;
        $appointment->ref_by = $request->ref_by;
        $appointment->occupation = $request->occupation;
        $appointment->send_alert = $request->send_alert;
        $appointment->blood = $request->blood;
        $appointment->diet = $request->diet;
        $appointment->height = $request->height;
        $appointment->weight = $request->weight;
        $appointment->brith_weight = $request->brith_weight;
        $appointment->any_mediciens = $request->any_mediciens;
        $appointment->note = $request->note;
        $appointment->doctor_id = $request->doctor_id;
        $appointment->department_id = $request->department_id;
        $appointment->save();
        return Redirect::route('appointment.index')->with('success','Appointment updated successfully!');
    }

    public function changeStatus(Request $request){
        $statusUpdate = PatientDetails::where("id", $request->id)->update(['status'=>$request->status]);
        if($statusUpdate){
            return 1;
        }else{
            return 0;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            PatientDetails::where("id", $request->id)->update(['deleted_at'=>'Y']);
            return Redirect::route('appointment.index')->with('success','Appointment deleted successfully');

        } catch(\Exception $e) {

            return Redirect::route('appointment.index')->with('Error','Appointment delete fail');
            return redirect()->back();
        }
    }
}
