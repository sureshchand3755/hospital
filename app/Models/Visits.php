<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visits extends Model
{
    use HasFactory;

    public $table = 'visits';

    protected $primaryKey = 'id';

    public $timestamps = false;
}
