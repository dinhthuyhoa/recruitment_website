<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationUser extends Model
{
    // use HasFactory;
    protected $table = 'education'; 

    protected $fillable = [
        'user_id',
        'school_name',
        'school_location',
        'start_date',
        'end_date',
        'gpa',
        'achievements',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function education()
{
    return $this->hasOne(EducationUser::class);
}

}
