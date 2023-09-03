<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';

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
