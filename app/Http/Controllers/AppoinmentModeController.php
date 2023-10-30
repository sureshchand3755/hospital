<?php

namespace App\Http\Controllers;

use App\Models\AppoinmentMode;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Redirect;

class AppoinmentModeController extends Controller
{

    protected $redirect;
    public function __construct()
    {
        $this->redirect = 'appoinment_mode.index';;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('appoinment_mode.list');
    }

    public function getAppoinmentmode(Request $request)
    {
        if ($request->ajax()) {
            $data = AppoinmentMode::where('deleted_at','N')->latest()->get();
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
                        $changestatusUrl=url('appoinment_mode/changestatus/'.$row->id.'/'.$statusVal);
                        $actionBtn='<a href="'.$changestatusUrl.'"<button class="custom-badge status-green ">Active</button></a>';
                    }
                    if($row->status==1){
                        $statusVal = 0;
                        $changestatusUrl=url('appoinment_mode/changestatus/'.$row->id.'/'.$statusVal);
                        $actionBtn='<a href="'.$changestatusUrl.'"<button class="custom-badge status-pink">In Active</button></a>';
                    }
                    return $actionBtn;
                })
                ->addColumn('action', function($row){
                    $editUrl=url('appoinment_mode/edit/'.$row->id);
                    $actionBtn = '<div class="action"><a class="view_appmodes" data-bs-target="#view_appmodes" data-bs-toggle="modal" data-id="'.$row->id.'" data-doctorid="1" href="#"><i class="fa-solid fa-eye m-r-5"></i><a title="Edit"  href="'.$editUrl.'"><i class="fa-solid fa-pen-to-square m-r-5"></i></a><a class="delete_appmodes" href="#" data-bs-toggle="modal" title="Delete"  data-id="'.$row->id.'" data-bs-target="#delete_appmodes"><i class="far fa-trash-alt m-r-5"></i></a></div>';
                    return $actionBtn;
                })
                ->rawColumns(['idRows','status','action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('appoinment_mode.add');
    }

    public function checkAppoinmentmode($id, Request $request){
        $result = AppoinmentMode::where("name", $request->name)->where("id", '!=', $id)->count();
        $valid = true;
        if($result > 0){
            $valid = false;
        }
        echo json_encode($valid);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'desc' => 'required',
            'status' => 'required'
        ]);

        $appoinment_mode = new AppoinmentMode();
        $appoinment_mode->name = $request->name;
        $appoinment_mode->desc = $request->desc;
        $appoinment_mode->status = $request->status;
        $appoinment_mode->created_at = new Carbon();
        $appoinment_mode->save();
        return Redirect::route($this->redirect)->with('success','AppoinmentMode Added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(AppoinmentMode $appoinment_mode, $id)
    {
        $appoinment_mode = AppoinmentMode::where('id', $id)->first();
        return response()->json($appoinment_mode);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = AppoinmentMode::where('id',$id)->get()->first();
        return view('appoinment_mode.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AppoinmentMode $appoinment_mode)
    {
        $appoinment_mode = AppoinmentMode::find($request->id);
        $appoinment_mode->name = $request->name;
        $appoinment_mode->desc = $request->desc;
        $appoinment_mode->status = $request->status;
        $appoinment_mode->updated_at = new Carbon();
        $appoinment_mode->save();

        return Redirect::route($this->redirect)->with('success','AppoinmentMode Updated successfully!');
    }

    public function changeStatus($id, $user_status){
        AppoinmentMode::where("id", $id)->update(['status'=>$user_status]);
        $ustatus='';
        if($user_status==1){
            $ustatus='In Activeted';
        }else{
            $ustatus='Activeted';
        }
        return Redirect::route($this->redirect)->with('success',"AppoinmentMode ".$ustatus);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AppoinmentMode $appoinment_mode, Request $request)
    {
        try {
            AppoinmentMode::where("id", $request->id)->update(['deleted_at'=>'Y']);
            return Redirect::route($this->redirect)->with('success','AppoinmentMode deleted successfully');
        } catch(\Exception $e) {
            return Redirect::route($this->redirect)->with('Error','AppoinmentMode delete fail');
        }
    }
}
