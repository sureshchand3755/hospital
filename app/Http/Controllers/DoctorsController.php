<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, Country, State, City, Department, DoctorInfo};
use Carbon\Carbon;
use Hash;
use DataTables;
use DateTime;
use URL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;

class DoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('doctor.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $defaultSelection = [''=>'Please Select'];
        $department = $defaultSelection + Department::where('status',0)->where('deleted_at','N')->pluck("department_name", "id")->toArray();
        $country = $defaultSelection + Country::pluck("name", "id")->toArray();
        $states = [];
        $city = [];
        return view('doctor.add', compact('department','country','states', 'city'));
    }

    public function fetchState(Request $request)
    {
        $data['states'] = State::where("country_id",$request->country_id)->get(["name", "id"]);
        return response()->json($data);
    }
    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("state_id",$request->state_id)->get(["name", "id"]);
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $userData = new User();
        $userData->created_at = new Carbon();
        $userData->name = $request->username;
        $userData->email = $request->email;
        $userData->password = Hash::make($request->password);
        $userData->mobile = $request->mobile_number;
        $userData->type = 1;
        $userData->save();
        $lastInsertID = $userData->id;
        $doctorInfo = new DoctorInfo();
        $doctorInfo->user_id = $lastInsertID;
        $doctorInfo->first_name = $request->first_name;
        $doctorInfo->last_name = $request->last_name;
        $date = explode('/', $request->dob);
        $doctorInfo->date_of_birth = date("Y-m-d", strtotime($date[0].'-'.$date[1].'-'.$date[2]));
        $doctorInfo->gender = $request->gender;
        $doctorInfo->education = $request->education;
        $doctorInfo->designation = $request->designation;
        $doctorInfo->department_id = $request->department_id;
        $doctorInfo->address = $request->address;
        $doctorInfo->country_id = $request->country_id;
        $doctorInfo->city_id = $request->city_id;
        $doctorInfo->state_id = $request->state_id;
        $doctorInfo->postal_code = $request->postal_code;
        $doctorInfo->biography = $request->biography;
        $doctorInfo->status = $request->status;
        if ($request->hasFile('profile_image')) {
            $imageName = time().'.'.$request->profile_image->extension();
            $request->profile_image->move(public_path('images'), $imageName);
            $userData->profile_image = $imageName;
        }
        $doctorInfo->created_at = new Carbon();
        $doctorInfo->save();
        return Redirect::route('doctor.list')->with('success','Profile created successfully!');
    }

    public function getDoctors(Request $request)
    {
        // <a class="dropdown-item" href="'.url('doctor/edit/'.$row->id).'"><i class="fa-solid fa-eye m-r-5"></i> View</a>
        if ($request->ajax()) {
            $data = User::with(['doctorinfo','doctorinfo.department','doctorinfo.country','doctorinfo.state','doctorinfo.city'])
            ->where('type',1)
            // ->whereHas('doctorinfo', function ($q) use ($request) {
            //     $q->where('status',0);
            // })
            ->latest()->get();
            return Datatables::of($data)
                ->addColumn('idRows', function($row){
                    $actionBtn = '<div class="form-check check-tables">
                            <input class="form-check-input" type="checkbox" value="something">
                        </div>';
                    return $actionBtn;
                })
                ->addColumn('department', function($row){
                    return isset($row->doctorinfo->department)?$row->doctorinfo->department->department_name:'';
                })
                ->addColumn('specialization', function($row){
                    return isset($row->doctorinfo)?$row->doctorinfo->designation:'';
                })
                ->addColumn('degree', function($row){
                    return isset($row->doctorinfo)?$row->doctorinfo->education:'';
                })
                ->addColumn('mobile', function($row){
                    return $row->mobile;
                })
                ->addColumn('email', function($row){
                    return $row->email;
                })
                ->addColumn('status', function($row){
                    // $ids = isset($row->doctorinfo)?$row->doctorinfo->id:'';
                    $actionBtn='';
                    if($row->status==0){
                        $statusVal = 1;
                        $actionBtn='<a href="'.url('doctor/changestatus/'.$row->id.'/'.$statusVal).'"<button class="custom-badge status-green ">Active</button></a>';
                    }
                    if($row->status==1){
                        $statusVal = 0;
                        $actionBtn='<a href="'.url('doctor/changestatus/'.$row->id.'/'.$statusVal).'"<button class="custom-badge status-pink">In Active</button></a>';
                    }
                    return $actionBtn;
                })
                ->addColumn('action', function($row){
                    $actionBtn = '<div class="dropdown dropdown-action">
                    <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="'.url('doctor/edit/'.$row->id).'"><i class="fa-solid fa-pen-to-square m-r-5"></i> Edit</a>
                    <a class="dropdown-item delete_doctor" href="#"   data-id="'.$row->id.'"  data-bs-toggle="modal" data-bs-target="#delete_doctor"><i class="far fa-trash-alt m-r-5"></i> Delete</a>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['idRows','name','department','specialization','degree','mobile', 'email', 'status',  'action'])
                ->make(true);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DoctorInfo $doctorInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $defaultSelection = [''=>'Please Select'];
        $department = $defaultSelection + Department::where('status',0)->where('deleted_at','N')->pluck("department_name", "id")->toArray();
        $country = $defaultSelection + Country::pluck("name", "id")->toArray();
        $data = User::with(['doctorinfo'])
        ->where('id',$id)->get()->first();
        return view('doctor.edit', compact('data', 'department','country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $userData = User::find($request->id);
        $userData->name = $request->username;
        $userData->email = $request->email;
        $userData->password = Hash::make($request->password);
        $userData->mobile = $request->mobile_number;
        $userData->updated_at = new Carbon();
        $userData->getDirty();
        $userData->save();
        $userData->getChanges();
        $doctorInfos = DoctorInfo::where('user_id',$request->id)->get()->first();
        if($doctorInfos==null){
            $doctorInfo = new DoctorInfo();
            $doctorInfo->user_id = $request->id;
            $doctorInfo->created_at = new Carbon();

        }else{
            $doctorInfo = DoctorInfo::find($doctorInfos->id);
            $doctorInfo->updated_at = new Carbon();
        }

        $doctorInfo->first_name = $request->first_name;
        $doctorInfo->last_name = $request->last_name;
        $date = explode('/', $request->dob);
        $doctorInfo->date_of_birth = date("Y-m-d", strtotime($date[0].'-'.$date[1].'-'.$date[2]));
        $doctorInfo->gender = $request->gender;
        $doctorInfo->education = $request->education;
        $doctorInfo->designation = $request->designation;
        $doctorInfo->department_id = $request->department_id;
        $doctorInfo->address = $request->address;
        $doctorInfo->country_id = $request->country_id;
        $doctorInfo->city_id = $request->city_id;
        $doctorInfo->state_id = $request->state_id;
        $doctorInfo->postal_code = $request->postal_code;
        $doctorInfo->biography = $request->biography;
        $doctorInfo->status = ($request->status)?$request->status:0;
        if ($request->hasFile('profile_image')) {
            $imageName = 'profileimage'.$request->id.'.'.$request->profile_image->extension();
            $request->profile_image->move(public_path('images'), $imageName);
            $doctorInfo->profile_image = $imageName;
        }
        $doctorInfo->getDirty();
        $doctorInfo->save();
        $doctorInfo->getChanges();
        return Redirect::route('doctor.list')->with('success','Profile Updated successfully!');

    }
    public function changeStatus($id, $user_status){
        User::where("id", $id)->update(['status'=>$user_status]);
        $ustatus='';
        if($user_status==1){
            $ustatus='In Activeted';
        }else{
            $ustatus='Activeted';
        }
        return Redirect::route('doctor.list')->with('success',"User ".$ustatus);
        // Toastr::success("User ".$ustatus ,'Success');
        // return redirect('user/list');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            User::where("id", $request->id)->update(['deleted_at'=>'Y']);
            return Redirect::route('doctor.list')->with('success','Doctor deleted successfully');

        } catch(\Exception $e) {

            return Redirect::route('doctor.list')->with('Error','Doctor delete fail');
            return redirect()->back();
        }
    }
}
