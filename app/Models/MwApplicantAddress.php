<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MwApplicantAddress extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','division_id','district_id','upazilla_id','address'];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function upazilla()
    {
        return $this->belongsTo(Upazilla::class);
    }
}
