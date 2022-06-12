<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MwApplicantAddress extends Model
{
    protected $fillable = ['user_id','division_id','district_id','upazilla_id','address'];
}
