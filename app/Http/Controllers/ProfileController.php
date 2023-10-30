<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\{Country, State, City};
use App\Models\{PatientContactInfo, PatientGeneralInfo, PatientMedicalInfo};
use Carbon\Carbon;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }
    /**
     * Store the user's profile form.
     */
    public function store(Request $request)
    {

        $request->validate([
            'patient_name' => 'required',
            'date_of_birth' => 'required|date_format:d/m/Y|before:today',
            'age' => 'required | numeric',
            'gender'=> 'required|in:male,female',
            'address'=> 'required',
            'state'=> 'required',
            'city'=> 'required'
        ]);

        $this->SaveOrUpdatePatientGeneralInfo($request);
        $this->SaveOrUpdatePatientContactInfo($request);
        $this->SaveOrUpdatePatientMedicalInfo($request);

        return back()->with('success','Profile updated successfully!');
    }

    public function SaveOrUpdatePatientGeneralInfo($request){
        $exitsDetails = PatientGeneralInfo::where('user_id',Auth::user()->id)->get()->first();
        if($exitsDetails==null || $exitsDetails->count()==0){
            $patientGeneralInfo = new PatientGeneralInfo();
            $patientGeneralInfo->created_at = new Carbon();
        }else{
            $patientGeneralInfo = PatientGeneralInfo::find($exitsDetails->id);
            $patientGeneralInfo->updated_at = new Carbon();
        }

        $patientGeneralInfo->user_id = Auth::user()->id;
        $patientGeneralInfo->subtitle = $request->subtitle;
        $patientGeneralInfo->patient_name = $request->patient_name;
        $date = explode('/', $request->date_of_birth);
        $patientGeneralInfo->date_of_birth = date("Y-m-d", strtotime($date[0].'-'.$date[1].'-'.$date[2]));
        $patientGeneralInfo->age = $request->age;
        $patientGeneralInfo->gender = $request->gender;
        $patientGeneralInfo->aadhar_number = $request->aadhar_number;
        $patientGeneralInfo->father_or_husband = $request->father_or_husband;
        $patientGeneralInfo->father_or_husband_name = $request->father_or_husband_name;
        $patientGeneralInfo->mother_or_wife = $request->mother_or_wife;
        $patientGeneralInfo->mother_or_wife_name = $request->mother_or_wife_name;
        $patientGeneralInfo->guardian_name = $request->guardian_name;
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $file_name = 'profile_' . Auth::user()->id . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $file_name);
            $patientGeneralInfo->profile_image = $file_name;

        }
        $patientGeneralInfo->save();

    }
    public function SaveOrUpdatePatientContactInfo($request){
        $exitsDetails = PatientContactInfo::where('user_id',Auth::user()->id)->get()->first();

        if($exitsDetails==null || $exitsDetails->count()==0){
            $patientContactInfo = new PatientContactInfo();
            $patientContactInfo->created_at = new Carbon();
        }else{
            $patientContactInfo = PatientContactInfo::find($exitsDetails->id);
            $patientContactInfo->updated_at = new Carbon();
        }
        $patientContactInfo->user_id = Auth::user()->id;
        $patientContactInfo->address = $request->address;
        $patientContactInfo->city = $request->city;
        $patientContactInfo->state = $request->state;
        $patientContactInfo->postal_code = $request->postal_code;
        $patientContactInfo->phone_number = $request->phone_number;
        $patientContactInfo->education = $request->education;
        $patientContactInfo->ref_by = $request->ref_by;
        $patientContactInfo->occupation = $request->occupation;
        $patientContactInfo->send_alert = $request->send_alert;
        $patientContactInfo->save();

    }
    public function SaveOrUpdatePatientMedicalInfo($request){
        $exitsDetails = PatientMedicalInfo::where('user_id',Auth::user()->id)->get()->first();
        if($exitsDetails==null || $exitsDetails->count()==0){
            $patientMedicalInfo = new PatientMedicalInfo();
            $patientMedicalInfo->created_at = new Carbon();
        }else{
            $patientMedicalInfo = PatientMedicalInfo::find($exitsDetails->id);
            $patientMedicalInfo->updated_at = new Carbon();
        }
        $patientMedicalInfo->user_id = Auth::user()->id;
        $patientMedicalInfo->blood = $request->blood;
        $patientMedicalInfo->diet = $request->diet;
        $patientMedicalInfo->height = $request->height;
        $patientMedicalInfo->weight = $request->weight;
        $patientMedicalInfo->brith_weight = $request->brith_weight;
        $patientMedicalInfo->any_mediciens = $request->any_mediciens;
        $patientMedicalInfo->note = $request->note;
        $patientMedicalInfo->save();

    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function profileUpdate(Request $request){
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->updated_at = new Carbon();
        $user->save();
        return back()->with('success','Profile Updated successfully!');
    }
    public function updatePassword(Request $request){
        #Update the new Password
        User::whereId(Auth()->user()->id)->update([
            'password' => Hash::make($request->password)
        ]);
        return back()->with("success", "Password changed successfully!");
    }
}
