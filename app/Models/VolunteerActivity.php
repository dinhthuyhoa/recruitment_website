<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerActivity extends Model
{
    use HasFactory;
    protected $table = 'volunteer_activities';

    protected $fillable = [
        'user_id',
        'position',
        'organization_name',
        'location',
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
