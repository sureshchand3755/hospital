<?php

namespace App\Http\Controllers;

use App\Models\Visits;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Redirect;

class VisitController extends Controller
{
    protected $redirect;
    public function __construct()
    {
        $this->redirect = 'visit.index';;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('visit.list');
    }

    public function getVisits(Request $request)
    {
        if ($request->ajax()) {
            $data = Visits::where('deleted_at','N')->latest()->get();
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
                        $changestatusUrl=url('visit/changestatus/'.$row->id.'/'.$statusVal);
                        $actionBtn='<a href="'.$changestatusUrl.'"<button class="custom-badge status-green ">Active</button></a>';
                    }
                    if($row->status==1){
                        $statusVal = 0;
                        $changestatusUrl=url('visit/changestatus/'.$row->id.'/'.$statusVal);
                        $actionBtn='<a href="'.$changestatusUrl.'"<button class="custom-badge status-pink">In Active</button></a>';
                    }
                    return $actionBtn;
                })
                ->addColumn('action', function($row){
                    $editUrl=url('visit/edit/'.$row->id);
                    $actionBtn = '<div class="action"><a class="view_visit" data-bs-target="#view_visit"  data-bs-toggle="modal" data-id="'.$row->id.'" data-doctorid="1" href="#"><i class="fa-solid fa-eye m-r-5"></i><a title="Edit"  href="'.$editUrl.'"><i class="fa-solid fa-pen-to-square m-r-5"></i></a><a class="delete_visit" href="#" data-bs-toggle="modal" title="Delete"  data-id="'.$row->id.'" data-bs-target="#delete_visit"><i class="far fa-trash-alt m-r-5"></i></a></div>';
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
        return view('visit.add');
    }

    public function checkVisit($id, Request $request){
        $result = Visits::where("name", $request->name)->where("id", '!=', $id)->count();
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

        $visit = new Visits();
        $visit->name = $request->name;
        $visit->desc = $request->desc;
        $visit->status = $request->status;
        $visit->created_at = new Carbon();
        $visit->save();
        return Redirect::route($this->redirect)->with('success','Visit Added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Visits $visit, $id)
    {
        $visit = Visits::where('id', $id)->first();
        return response()->json($visit);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Visits::where('id',$id)->get()->first();
        return view('visit.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Visits $visit)
    {
        $visit = Visits::find($request->id);
        $visit->name = $request->name;
        $visit->desc = $request->desc;
        $visit->status = $request->status;
        $visit->updated_at = new Carbon();
        $visit->save();

        return Redirect::route($this->redirect)->with('success','Visit Updated successfully!');
    }

    public function changeStatus($id, $user_status){
        Visits::where("id", $id)->update(['status'=>$user_status]);
        $ustatus='';
        if($user_status==1){
            $ustatus='In Activeted';
        }else{
            $ustatus='Activeted';
        }
        return Redirect::route($this->redirect)->with('success',"Visit ".$ustatus);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visits $visit, Request $request)
    {
        try {
            Visits::where("id", $request->id)->update(['deleted_at'=>'Y']);
            return Redirect::route($this->redirect)->with('success','Visit deleted successfully');
        } catch(\Exception $e) {
            return Redirect::route($this->redirect)->with('Error','Visit delete fail');
        }
    }
}
