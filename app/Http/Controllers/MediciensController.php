<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Toastr;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use App\Models\Mediciens;

class MediciensController extends Controller
{
    public function index()
    {
        return view('mediciens.list');
    }

    public function getList(Request $request)
    {
        // <a class="dropdown-item view_department" href="#" data-bs-toggle="modal"  data-id="'.$row->id.'" data-bs-target="#view_department"><i class="fa-solid fa-eye m-r-5"></i> View</a>
        if ($request->ajax()) {
            $data = Mediciens::where('deleted_at','N')->latest()->get();
            return Datatables::of($data)
                // ->addIndexColumn()
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
                        $changestatusUrl=url('medicien/changestatus/'.$row->id.'/'.$statusVal);
                        $actionBtn='<a href="'.$changestatusUrl.'"<button class="custom-badge status-green ">Active</button></a>';
                    }
                    if($row->status==1){
                        $statusVal = 0;
                        $changestatusUrl=url('medicien/changestatus/'.$row->id.'/'.$statusVal);
                        $actionBtn='<a href="'.$changestatusUrl.'"<button class="custom-badge status-pink">In Active</button></a>';
                    }
                    return $actionBtn;
                })
                ->addColumn('action', function($row){
                    $editUrl=url('medicien/edit/'.$row->id);
                    $actionBtn = '<div class="dropdown dropdown-action">
                    <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="'.$editUrl.'"><i class="fa-solid fa-pen-to-square m-r-5"></i> Edit</a>
                    <a class="dropdown-item delete_department" href="#" data-bs-toggle="modal"  data-id="'.$row->id.'" data-bs-target="#delete_department"><i class="far fa-trash-alt m-r-5"></i> Delete</a>
                    </div>';
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
        return view('mediciens.add');
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

        $medicien = new Mediciens();
        $medicien->name = $request->name;
        $medicien->desc = $request->desc;
        $medicien->status = $request->status;
        $medicien->created_at = new Carbon();
        $medicien->save();
        // Toastr::success('Department created successfully!');
        $redirect = 'mediciens.index';
        return Redirect::route($redirect)->with('success','Medicien Added successfully!');

    }
    public function checkMedicien($id, Request $request){
        $result = Mediciens::where("name", $request->name)->where("id", '!=', $id)->count();
        $valid = true;
        if($result > 0){
            $valid = false;
        }
        echo json_encode($valid);
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department, $id)
    {
        $department = Department::where('id', $id)->first();
        return response()->json($department);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Department::where('id',$id)->get()->first();
        // dd($data)
        return view('department.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $department = Department::find($request->id);
        $department->department_name = $request->department_name;
        $department->department_head = $request->department_head;
        $department->department_desc = $request->department_desc;
        $date = explode('/', $request->department_date);
        $department->department_date = date("Y-m-d", strtotime($date[0].'-'.$date[1].'-'.$date[2]));
        $department->status = $request->status;
        $department->updated_at = new Carbon();
        $department->getDirty();
        $department->save();
        $department->getChanges();

        $redirect = 'departments.index';
        if(Auth::user()->type==3){
            $redirect = 'admin.departments.index';
        }
        return Redirect::route($redirect)->with('success','Department Updated successfully!');
    }

    public function changeStatus($id, $user_status){
        Department::where("id", $id)->update(['status'=>$user_status]);
        $ustatus='';
        if($user_status==1){
            $ustatus='In Activeted';
        }else{
            $ustatus='Activeted';
        }

        $redirect = 'departments.index';
        if(Auth::user()->type==3){
            $redirect = 'admin.departments.index';
        }
        return Redirect::route($redirect)->with('success',"Department ".$ustatus);
        // Toastr::success("User ".$ustatus ,'Success');
        // return redirect('user/list');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department, Request $request,)
    {
        $redirect = 'departments.index';
        if(Auth::user()->type==3){
            $redirect = 'admin.departments.index';
        }
        try {
            Department::where("id", $request->id)->update(['deleted_at'=>'Y']);
            // Toastr::success('User deleted successfully :)','Success');
            return Redirect::route($redirect)->with('success','Department deleted successfully');

        } catch(\Exception $e) {

            return Redirect::route($redirect)->with('Error','Department delete fail');
        }
    }
}
