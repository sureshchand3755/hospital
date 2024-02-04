<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Toastr;
use Carbon\Carbon;
use Auth;
use Hash;
use URL;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
class ReceptionController extends Controller
{
    public function index(){
        return view('reception.list');
    }
    public function create()
    {
        return view('reception.add');
    }

    public function getList(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('deleted_at','N')->where('type',0)->latest()->get();
            return Datatables::of($data)
                ->addColumn('idRows', function($row){
                    $pimage = URL::to('public/images/logo/'.$row->logo);
                    if($row->logo=='' || $row->logo==null){
                        $pimage = URL::to('public/assets/img/profile-user.jpg');
                    }
                    $actionBtn = '<div class="form-check check-tables">
                            <input class="form-check-input" type="checkbox" value="something">
                            <img src="'.$pimage.'" alt="" width="50" height="46">
                        </div>';
                    return $actionBtn;
                })
                ->addColumn('status', function($row){
                    $actionBtn='';
                    if($row->status==0){
                        $statusVal = 1;
                        $changestatusUrl=url('reception/changestatus/'.$row->id.'/'.$statusVal);
                        // if(Auth::user()->type==3){
                        //     $changestatusUrl=url('admin/reception/changestatus/'.$row->id.'/'.$statusVal);
                        // }

                        $actionBtn='<a href="'.$changestatusUrl.'"<button class="custom-badge status-green ">Active</button></a>';
                    }
                    if($row->status==1){
                        $statusVal = 0;
                        $changestatusUrl=url('reception/changestatus/'.$row->id.'/'.$statusVal);
                        // if(Auth::user()->type==3){
                        //     $changestatusUrl=url('admin/reception/changestatus/'.$row->id.'/'.$statusVal);
                        // }
                        $actionBtn='<a href="'.$changestatusUrl.'"<button class="custom-badge status-pink">In Active</button></a>';
                    }
                    return $actionBtn;
                })
                ->addColumn('action', function($row){
                    $editUrl=url('reception/edit/'.$row->id);
                    // if(Auth::user()->type==3){
                    //     $editUrl=url('admin/reception/edit/'.$row->id);
                    // }

                    $actionBtn = '<div class="action"><a class="view_reception" data-bs-target="#view_reception"  data-bs-toggle="modal" data-id="'.$row->id.'" data-doctorid="1" href="#"><i class="fa-solid fa-eye m-r-5"></i>
                    <a href="'.$editUrl.'"><i class="fa-solid fa-pen-to-square m-r-5"></i></a>
                    <a class="delete_reception" href="#" data-bs-toggle="modal"  data-id="'.$row->id.'" data-bs-target="#delete_reception"><i class="far fa-trash-alt m-r-5"></i></a>
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
        $userData->name = $request->name;
        $userData->email = $request->email;
        $userData->mobile = $request->mobile;
        $userData->password = Hash::make($request->password);
        $userData->type = 0;
        if ($request->hasFile('profile_image')) {
            $imageName = 'profileimage_'.time().'.'.$request->profile_image->extension();
            $request->profile_image->move(public_path('images/logo'), $imageName);
            $userData->logo = $imageName;
        }
        $userData->created_at = new Carbon();
        $userData->save();

        $redirect = 'reception.list';
        // if(Auth::user()->type==3){
        //     $redirect = 'admin.reception.list';
        // }

        return Redirect::route($redirect)->with('success','Reception created successfully!');
    }

    public function edit($id)
    {
        $data = User::where('id',$id)->first();
        return view('reception.edit', compact('data'));
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
        $redirect = 'reception.list';
        // if(Auth::user()->type==3){
        //     $redirect = 'admin.reception.list';
        // }
        return Redirect::route($redirect)->with('success','Reception Updated successfully!');

    }

    public function changeStatus($id, $user_status){
        User::where("id", $id)->update(['status'=>$user_status]);
        $ustatus='';
        if($user_status==1){
            $ustatus='In Activeted';
        }else{
            $ustatus='Activeted';
        }
        $redirect = 'reception.list';
        // if(Auth::user()->type==3){
        //     $redirect = 'admin.reception.list';
        // }
        return Redirect::route($redirect)->with('success',"Reception is ".$ustatus);
    }

    public function destroy(Request $request)
    {
        $redirect = 'reception.list';
        // if(Auth::user()->type==3){
        //     $redirect = 'admin.reception.list';
        // }
        try {
            User::where("id", $request->id)->update(['deleted_at'=>'Y']);
            return Redirect::route($redirect)->with('success','Reception deleted successfully');

        } catch(\Exception $e) {

            return Redirect::route($redirect)->with('Error','Reception delete fail');
            return redirect()->back();
        }
    }
}
