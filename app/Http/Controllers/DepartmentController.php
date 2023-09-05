<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Toastr;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use App\Models\{Country, State, City, Department};

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('department.list');
    }

    public function getDepartments(Request $request)
    {
        // <a class="dropdown-item view_department" href="#" data-bs-toggle="modal"  data-id="'.$row->id.'" data-bs-target="#view_department"><i class="fa-solid fa-eye m-r-5"></i> View</a>
        if ($request->ajax()) {
            $data = Department::where('deleted_at','N')->latest()->get();
            return Datatables::of($data)
                // ->addIndexColumn()
                ->addColumn('idRows', function($row){
                    $actionBtn = '<div class="form-check check-tables">
                            <input class="form-check-input" type="checkbox" value="something">
                        </div>';
                    return $actionBtn;
                })
                ->addColumn('department_status', function($row){
                    $actionBtn='';
                    if($row->status==0){
                        $statusVal = 1;
                        $changestatusUrl=url('department/changestatus/'.$row->id.'/'.$statusVal);
                        if(Auth::user()->type==3){
                            $changestatusUrl=url('admin/department/changestatus/'.$row->id.'/'.$statusVal);
                        }

                        $actionBtn='<a href="'.$changestatusUrl.'"<button class="custom-badge status-green ">Active</button></a>';
                    }
                    if($row->status==1){
                        $statusVal = 0;
                        $changestatusUrl=url('department/changestatus/'.$row->id.'/'.$statusVal);
                        if(Auth::user()->type==3){
                            $changestatusUrl=url('admin/department/changestatus/'.$row->id.'/'.$statusVal);
                        }
                        $actionBtn='<a href="'.$changestatusUrl.'"<button class="custom-badge status-pink">In Active</button></a>';
                    }
                    return $actionBtn;
                })
                ->addColumn('action', function($row){
                    $editUrl=url('department/edit/'.$row->id);
                    if(Auth::user()->type==3){
                        $editUrl=url('admin/department/edit/'.$row->id);
                    }

                    $actionBtn = '<div class="dropdown dropdown-action">
                    <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="'.$editUrl.'"><i class="fa-solid fa-pen-to-square m-r-5"></i> Edit</a>
                    <a class="dropdown-item delete_department" href="#" data-bs-toggle="modal"  data-id="'.$row->id.'" data-bs-target="#delete_department"><i class="far fa-trash-alt m-r-5"></i> Delete</a>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['idRows','department_status','action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('department.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'department_name' => 'required',
            'department_head' => 'required',
            'department_desc' => 'required',
            'department_date' => 'required',
            'status' => 'required'
        ]);

        $department = new Department();
        $department->department_name = $request->department_name;
        $department->department_head = $request->department_head;
        $department->department_desc = $request->department_desc;
        $date = explode('/', $request->department_date);
        $department->department_date = date("Y-m-d", strtotime($date[0].'-'.$date[1].'-'.$date[2]));
        $department->status = $request->status;
        $department->created_at = new Carbon();
        $department->save();
        // Toastr::success('Department created successfully!');
        $redirect = 'departments.index';
        if(Auth::user()->type==3){
            $redirect = 'admin.departments.index';
        }
        return Redirect::route($redirect)->with('success','Department Added successfully!');

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
