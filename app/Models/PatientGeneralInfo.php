<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class PatientGeneralInfo extends Model
{
    use HasFactory;

    protected $table = 'patient_general_infos';

    protected $primaryKey = 'id';

    public $incrementing = false;

    public $timestamps = false;

    protected $softDelete = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
