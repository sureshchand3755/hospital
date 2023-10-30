<?php

namespace App\Http\Controllers;

use App\Models\Illness;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Redirect;


class IllnessController extends Controller
{

    protected $redirect;
    public function __construct()
    {
        $this->redirect = 'illness.index';;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('illness.list');
    }

    public function getIllness(Request $request)
    {
        if ($request->ajax()) {
            $data = Illness::where('deleted_at','N')->latest()->get();
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
                        $changestatusUrl=url('illness/changestatus/'.$row->id.'/'.$statusVal);
                        $actionBtn='<a href="'.$changestatusUrl.'"<button class="custom-badge status-green ">Active</button></a>';
                    }
                    if($row->status==1){
                        $statusVal = 0;
                        $changestatusUrl=url('illness/changestatus/'.$row->id.'/'.$statusVal);
                        $actionBtn='<a href="'.$changestatusUrl.'"<button class="custom-badge status-pink">In Active</button></a>';
                    }
                    return $actionBtn;
                })
                ->addColumn('action', function($row){
                    $editUrl=url('illness/edit/'.$row->id);
                    $actionBtn = '<div class="action"><a class="view_illness" data-bs-target="#view_illness"  data-bs-toggle="modal" data-id="'.$row->id.'" data-doctorid="1" href="#"><i class="fa-solid fa-eye m-r-5"></i><a title="Edit"  href="'.$editUrl.'"><i class="fa-solid fa-pen-to-square m-r-5"></i></a><a class="delete_illness" href="#" data-bs-toggle="modal" title="Delete"  data-id="'.$row->id.'" data-bs-target="#delete_illness"><i class="far fa-trash-alt m-r-5"></i></a></div>';
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
        return view('illness.add');
    }

    public function checkIllness($id, Request $request){
        $result = Illness::where("name", $request->name)->where("id", '!=', $id)->count();
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

        $illness = new Illness();
        $illness->name = $request->name;
        $illness->desc = $request->desc;
        $illness->status = $request->status;
        $illness->created_at = new Carbon();
        $illness->save();
        return Redirect::route($this->redirect)->with('success','Illness Added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Illness $illness, $id)
    {
        $illness = Illness::where('id', $id)->first();
        return response()->json($illness);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Illness::where('id',$id)->get()->first();
        return view('illness.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Illness $illness)
    {
        $illness = Illness::find($request->id);
        $illness->name = $request->name;
        $illness->desc = $request->desc;
        $illness->status = $request->status;
        $illness->updated_at = new Carbon();
        $illness->save();

        return Redirect::route($this->redirect)->with('success','Illness Updated successfully!');
    }

    public function changeStatus($id, $user_status){
        Illness::where("id", $id)->update(['status'=>$user_status]);
        $ustatus='';
        if($user_status==1){
            $ustatus='In Activeted';
        }else{
            $ustatus='Activeted';
        }
        return Redirect::route($this->redirect)->with('success',"Illness ".$ustatus);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Illness $illness, Request $request)
    {
        try {
            Illness::where("id", $request->id)->update(['deleted_at'=>'Y']);
            return Redirect::route($this->redirect)->with('success','Illness deleted successfully');
        } catch(\Exception $e) {
            return Redirect::route($this->redirect)->with('Error','Illness delete fail');
        }
    }
}
