<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $table = 'states';

    protected $primaryKey = 'id';

    public $timestamps = false;

    public function doctorinfo()
    {
        return $this->hasOne(DoctorInfo::class);
    }
    public function patientdetails()
    {
        return $this->hasOne(PatientDetails::class);
    }
}
