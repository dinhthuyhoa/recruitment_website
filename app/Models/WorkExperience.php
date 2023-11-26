<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    use HasFactory;
    protected $table = 'work_experiences';

    protected $fillable = [
        'user_id',
        'work_position',
        'company',
        'work_address',
        'start_date',
        'end_date',
        'achievements',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
