<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\{Country, State, City};
use App\Models\{PatientContactInfo, PatientGeneralInfo, PatientMedicalInfo};

class DashboardController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('patient.dashboard');
    }
    public function viewProfile()
    {
        $data['states'] = State::get(["name", "id"]);
        $data['PatientGeneralInfo'] = PatientGeneralInfo::where('user_id',Auth::user()->id)->get()->first();
        $data['PatientContactInfo'] = PatientContactInfo::where('user_id',Auth::user()->id)->get()->first();
        $data['PatientMedicalInfo'] = PatientMedicalInfo::where('user_id',Auth::user()->id)->get()->first();
        return view('patient.profile',$data);
    }

}
