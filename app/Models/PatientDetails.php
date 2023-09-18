<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientDetails extends Model
{
    use HasFactory;

    protected $table = 'patient_details';

    protected $primaryKey = 'id';

    public $timestamps = false;

    public function doctordetails()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function patientprescription()
    {
        return $this->hasMany(Prescription::class, 'patient_id');
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }

}
