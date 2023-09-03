<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
        $prescription = new Prescription();
        $prescription->patient_id = $request->patient_id;
        $prescription->prescription_doctor_id = $request->doctor_id;
        $prescription->prescriptions = $request->prescription;
        if ($request->hasFile('uploadimage')) {
            $imageName = time().'.'.$request->uploadimage->extension();
            $imagePath = public_path('prescriptions');
            $request->uploadimage->move($imagePath, $imageName);
            $prescription->upload_path = $imagePath;
            $prescription->upload_image = $imageName;
        }
        $prescription->save();
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
