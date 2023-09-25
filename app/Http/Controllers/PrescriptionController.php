<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Models\Mediciens;
use App\Models\Prescription;

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
        $prescriptionCount = count(array_values(array_filter($request->medicine_id)));
        if($prescriptionCount > 0){
            for ($i=0; $i < $prescriptionCount; $i++) {
                $medicineId = $this->addMedicine($request->medicine_id[$i]);
                $prescription = new Prescription();
                $prescription->patient_id = $request->patient_id;
                $prescription->prescription_doctor_id = $request->doctor_id;
                if ($request->hasFile('uploadimage')) {
                    $imageName = time().'.'.$request->uploadimage->extension();
                    $imagePath = public_path('prescriptions');
                    $request->uploadimage->move($imagePath, $imageName);
                    $prescription->upload_path = $imagePath;
                    $prescription->upload_image = $imageName;
                }
                $prescription->medicine_id = $medicineId;
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

    public function storePrescription($request, $patient_id)
    {
        $prescriptionCount = count(array_values(array_filter($request->medicine_id)));
        if($prescriptionCount > 0){
            $exitsprescriptionCount = Prescription::where('patient_id', $patient_id)->where('prescription_doctor_id', $request->doctor_id)->count();
            if($exitsprescriptionCount > 0){
                $exitsdelete = Prescription::where('patient_id', $patient_id)->where('prescription_doctor_id', $request->doctor_id)->delete();
                if($exitsdelete){
                    for ($i=0; $i < $prescriptionCount; $i++) {
                        $medicineId = $this->addMedicine($request->medicine_id[$i]);
                        $prescription = new Prescription();
                        $prescription->patient_id = $patient_id;
                        $prescription->prescription_doctor_id = $request->doctor_id;
                        if ($request->hasFile('uploadimage')) {
                            $imageName = time().'.'.$request->uploadimage->extension();
                            $imagePath = public_path('prescriptions');
                            $request->uploadimage->move($imagePath, $imageName);
                            $prescription->upload_path = $imagePath;
                            $prescription->upload_image = $imageName;
                        }
                        $prescription->medicine_id = $medicineId;
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
            }else{
                for ($i=0; $i < $prescriptionCount; $i++) {
                    $medicineId = $this->addMedicine($request->medicine_id[$i]);
                    $prescription = new Prescription();
                    $prescription->patient_id = $patient_id;
                    $prescription->prescription_doctor_id = $request->doctor_id;
                    if ($request->hasFile('uploadimage')) {
                        $imageName = time().'.'.$request->uploadimage->extension();
                        $imagePath = public_path('prescriptions');
                        $request->uploadimage->move($imagePath, $imageName);
                        $prescription->upload_path = $imagePath;
                        $prescription->upload_image = $imageName;
                    }
                    $prescription->medicine_id = $medicineId;
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

        }
    }


    public function addMedicine($name){
        $checkMedicine = Mediciens::select("id")->where("name","LIKE","%{$name}%")->get()->first();
        $medicine_id='';
        if(count($checkMedicine->toArray())==0){
            $medicien = new Mediciens();
            $medicien->name = $name;
            $medicien->desc = $name;
            $medicien->status = 0;
            $medicien->created_at = new Carbon();
            $medicien->save();
            $medicine_id=$medicien->id;
        }else{
            $medicine_id=$checkMedicine->id;
        }

        return $medicine_id;
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
