<?php

namespace App\Http\Controllers;

use App\Models\Symptoms;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Redirect;

class SymptomsController extends Controller
{
    protected $redirect;
    public function __construct()
    {
        $this->redirect = 'symptoms.index';;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('symptoms.list');
    }

    public function getSymptoms(Request $request)
    {
        if ($request->ajax()) {
            $data = Symptoms::where('deleted_at','N')->latest()->get();
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
                        $changestatusUrl=url('symptoms/changestatus/'.$row->id.'/'.$statusVal);
                        $actionBtn='<a href="'.$changestatusUrl.'"<button class="custom-badge status-green ">Active</button></a>';
                    }
                    if($row->status==1){
                        $statusVal = 0;
                        $changestatusUrl=url('symptoms/changestatus/'.$row->id.'/'.$statusVal);
                        $actionBtn='<a href="'.$changestatusUrl.'"<button class="custom-badge status-pink">In Active</button></a>';
                    }
                    return $actionBtn;
                })
                ->addColumn('action', function($row){
                    $editUrl=url('symptoms/edit/'.$row->id);
                    $actionBtn = '<div class="action"><a class="view_symptoms" data-bs-target="#view_symptoms"  data-bs-toggle="modal" data-id="'.$row->id.'" data-doctorid="1" href="#"><i class="fa-solid fa-eye m-r-5"></i><a title="Edit"  href="'.$editUrl.'"><i class="fa-solid fa-pen-to-square m-r-5"></i></a><a class="delete_department" href="#" data-bs-toggle="modal" title="Delete"  data-id="'.$row->id.'" data-bs-target="#delete_department"><i class="far fa-trash-alt m-r-5"></i></a></div>';
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
        return view('symptoms.add');
    }

    public function checkSymptoms($id, Request $request){
        $result = Symptoms::where("name", $request->name)->where("id", '!=', $id)->count();
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

        $symptoms = new Symptoms();
        $symptoms->name = $request->name;
        $symptoms->desc = $request->desc;
        $symptoms->status = $request->status;
        $symptoms->created_at = new Carbon();
        $symptoms->save();
        return Redirect::route($this->redirect)->with('success','Symptoms Added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Symptoms $symptoms, $id)
    {
        $symptoms = Symptoms::where('id', $id)->first();
        return response()->json($symptoms);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Symptoms::where('id',$id)->get()->first();
        return view('symptoms.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Symptoms $symptoms)
    {
        $symptoms = Symptoms::find($request->id);
        $symptoms->name = $request->name;
        $symptoms->desc = $request->desc;
        $symptoms->status = $request->status;
        $symptoms->updated_at = new Carbon();
        $symptoms->save();

        return Redirect::route($this->redirect)->with('success','Symptoms Updated successfully!');
    }

    public function changeStatus($id, $user_status){
        Symptoms::where("id", $id)->update(['status'=>$user_status]);
        $ustatus='';
        if($user_status==1){
            $ustatus='In Activeted';
        }else{
            $ustatus='Activeted';
        }
        return Redirect::route($this->redirect)->with('success',"Symptoms ".$ustatus);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Symptoms $symptoms, Request $request)
    {
        try {
            Symptoms::where("id", $request->id)->update(['deleted_at'=>'Y']);
            return Redirect::route($this->redirect)->with('success','Symptoms deleted successfully');
        } catch(\Exception $e) {
            return Redirect::route($this->redirect)->with('Error','Symptoms delete fail');
        }
    }
}
