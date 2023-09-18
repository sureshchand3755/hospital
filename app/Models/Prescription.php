<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $table = 'prescriptions';

    protected $primaryKey = 'id';

    public $timestamps = false;

    public function patient()
    {
        return $this->belongsToMany(PatientDetails::class);
    }
    public function medicien()
    {
        return $this->belongsTo(Mediciens::class, 'medicine_id');
    }


}
