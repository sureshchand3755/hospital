<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppoinmentMode extends Model
{
    use HasFactory;

    public $table = 'appoinment_mode';

    protected $primaryKey = 'id';

    public $timestamps = false;
}
