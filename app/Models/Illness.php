<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Illness extends Model
{
    use HasFactory;

    public $table = 'illness';

    protected $primaryKey = 'id';

    public $timestamps = false;
}
