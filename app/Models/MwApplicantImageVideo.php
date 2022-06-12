<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MwApplicantImageVideo extends Model
{
    protected $fillable = ['user_id','close_up_photo','mid_shot_photo','full_length_photo','video'];
}
