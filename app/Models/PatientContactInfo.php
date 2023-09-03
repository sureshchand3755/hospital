<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class PatientContactInfo extends Model
{
    use HasFactory;

    protected $table = 'patient_contact_infos';

    protected $primaryKey = 'id';

    public $incrementing = false;

    public $timestamps = false;

    protected $softDelete = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
