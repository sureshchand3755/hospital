<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    public $table = 'appointments';

    protected $primaryKey = 'id';

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
