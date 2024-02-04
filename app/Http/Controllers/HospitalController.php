<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Toastr;
use Carbon\Carbon;
use Auth;
use Hash;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
class HospitalController extends Controller
{
    public function index(){
        return view('hospital.list');
    }
    public function create()
    {
        return view('hospital.add');
    }

    public function getList(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('deleted_at','N')->where('type',2)->latest()->get();
            return Datatables::of($data)
                ->addColumn('idRows', function($row){
                    $actionBtn = '<div class="form-check check-tables">
                            <input class="form-check-input" type="checkbox" value="something">
                        </div>';
                    return $actionBtn;
                })
                ->addColumn('status', function($row){
                    $actionBtn='';
                    if($row->status==0){
                        $statusVal = 1;
                        $changestatusUrl=url('hospital/changestatus/'.$row->id.'/'.$statusVal);
                        // if(Auth::user()->type==3){
                        //     $changestatusUrl=url('admin/hospital/changestatus/'.$row->id.'/'.$statusVal);
                        // }

                        $actionBtn='<a href="'.$changestatusUrl.'"<button class="custom-badge status-green ">Active</button></a>';
                    }
                    if($row->status==1){
                        $statusVal = 0;
                        $changestatusUrl=url('hospital/changestatus/'.$row->id.'/'.$statusVal);
                        // if(Auth::user()->type==3){
                        //     $changestatusUrl=url('admin/hospital/changestatus/'.$row->id.'/'.$statusVal);
                        // }
                        $actionBtn='<a href="'.$changestatusUrl.'"<button class="custom-badge status-pink">In Active</button></a>';
                    }
                    return $actionBtn;
                })
                ->addColumn('action', function($row){
                    $editUrl=url('hospital/edit/'.$row->id);
                    // if(Auth::user()->type==3){
                    //     $editUrl=url('admin/hospital/edit/'.$row->id);
                    // }

                    $actionBtn = '<div class="action"><a class="view_hospital" data-bs-target="#view_hospital"  data-bs-toggle="modal" data-id="'.$row->id.'" data-doctorid="1" href="#"><i class="fa-solid fa-eye m-r-5"></i>
                    <a href="'.$editUrl.'"><i class="fa-solid fa-pen-to-square m-r-5"></i></a>
                    <a class="delete_hospital" href="#" data-bs-toggle="modal"  data-id="'.$row->id.'" data-bs-target="#delete_hospital"><i class="far fa-trash-alt m-r-5"></i></a>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['idRows','status','action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {

        $userData = new User();
        $userData->created_at = new Carbon();
        $userData->name = $request->username;
        $userData->email = $request->email;
        $userData->password = Hash::make($request->password);
        $userData->type = 2;
        if ($request->hasFile('profile_image')) {
            $imageName = 'profileimage_.'.time().'.'.$request->profile_image->extension();
            $request->logo->move(public_path('images/logo'), $imageName);
            $userData->logo = $imageName;
        }
        $userData->save();

        $redirect = 'hospital.list';
        // if(Auth::user()->type==3){
        //     $redirect = 'admin.hospital.list';
        // }

        return Redirect::route($redirect)->with('success','Hospital created successfully!');
    }

    public function edit($id)
    {
        $data = User::where('id',$id)->first();
        return view('hospital.edit', compact('data'));
    }
    public function show($id)
    {
        $data = User::where('id',$id)->first();
        return response()->json($data);
    }
    public function update(Request $request)
    {
        $userData = User::find($request->id);
        $userData->name = $request->name;
        $userData->email = $request->email;
        if($request->password !='' || $request->password !=null){
            $userData->password = Hash::make($request->password);
        }
        if ($request->hasFile('profile_image')) {
            $imageName = 'profileimage'.time().'.'.$request->profile_image->extension();
            $request->logo->move(public_path('images/logo'), $imageName);
            $userData->logo = $imageName;
        }
        $userData->status = $request->status;
        $userData->updated_at = new Carbon();
        $userData->save();
        $redirect = 'hospital.list';
        // if(Auth::user()->type==3){
        //     $redirect = 'admin.hospital.list';
        // }
        return Redirect::route($redirect)->with('success','Hospital Updated successfully!');

    }

    public function changeStatus($id, $user_status){
        User::where("id", $id)->update(['status'=>$user_status]);
        $ustatus='';
        if($user_status==1){
            $ustatus='In Activeted';
        }else{
            $ustatus='Activeted';
        }
        $redirect = 'hospital.list';
        // if(Auth::user()->type==3){
        //     $redirect = 'admin.hospital.list';
        // }
        return Redirect::route($redirect)->with('success',"Hospital is ".$ustatus);
    }

    public function destroy(Request $request)
    {
        $redirect = 'hospital.list';
        // if(Auth::user()->type==3){
        //     $redirect = 'admin.hospital.list';
        // }
        try {
            User::where("id", $request->id)->update(['deleted_at'=>'Y']);
            return Redirect::route($redirect)->with('success','Hospital deleted successfully');

        } catch(\Exception $e) {

            return Redirect::route($redirect)->with('Error','Hospital delete fail');
            return redirect()->back();
        }
    }
}
