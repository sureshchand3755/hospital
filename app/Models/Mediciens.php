<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mediciens extends Model
{
    use HasFactory;

    public $table = 'mediciens';

    protected $primaryKey = 'id';

    public $timestamps = false;

    public function prescription()
    {
        return $this->hasOne(Prescription::class, 'medicine_id');
    }
}
