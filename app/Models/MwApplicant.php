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
    protected $appends = ['full_name'];




    protected $casts = [
        'talent' => 'array',
        'country_visited'=>'array'
    ];

    public function getFullNameAttribute()
    {
        return "${this['first_name']} ${this['last_name']}";
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
