<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public $table = 'departments';

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
