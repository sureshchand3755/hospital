<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd(Carbon::now()->addDays($request->days[0]));
        if(count($request->medicine_id) > 0){
            for ($i=0; $i < count($request->medicine_id); $i++) {
                $prescription = new Prescription();
                $prescription->patient_id = $request->patient_id;
                $prescription->prescription_doctor_id = $request->doctor_id;
                //$prescription->prescriptions = $request->prescription;
                if ($request->hasFile('uploadimage')) {
                    $imageName = time().'.'.$request->uploadimage->extension();
                    $imagePath = public_path('prescriptions');
                    $request->uploadimage->move($imagePath, $imageName);
                    $prescription->upload_path = $imagePath;
                    $prescription->upload_image = $imageName;
                }
                $prescription->medicine_id = $request->medicine_id[$i];
                $prescription->medicine_type_id = $request->medicine_type_id[$i];
                $prescription->days = $request->days[$i];
                $prescription->af_bf = $request->af_bf[$i];
                $prescription->morning = $request->morning[$i];
                $prescription->afternoon = $request->afternoon[$i];
                $prescription->evening = $request->evening[$i];
                $prescription->night = $request->night[$i];
                $prescription->remarks = $request->remarks[$i];
                $prescription->next_consulting_date = Carbon::now()->addDays($request->days[$i]);
                $prescription->created_at = new Carbon();
                $prescription->save();
            }
        }

        return Redirect::route('appointment.index')->with('success','Prescription added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Prescription $prescription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prescription $prescription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prescription $prescription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prescription $prescription)
    {
        //
    }
}
