<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class MwApplicant extends Model
{
    protected $table = 'mw_applicants';
//    protected $primaryKey = 'Applicant_Id';
    public $timestamps = true;
    protected $guarded = ['id'];



    protected $casts = [
        'talent' => 'array',
        'country_visited'=>'array'
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->hasOne(MwApplicantAddress::class,'user_id','user_id');
    }

    public function imageVideo()
    {
        return $this->hasOne(MwApplicantImageVideo::class,'user_id','user_id');
    }


}
