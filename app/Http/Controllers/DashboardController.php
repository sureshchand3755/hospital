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
        $user = User::where('id',Auth::user()->id)->first();
        return view('patient.profile', compact('user'));
    }

}
