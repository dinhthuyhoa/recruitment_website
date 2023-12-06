<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackagePayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 
        'title_package', 
        'package_content', 
        'package_date',
        'package_status',
        'package_expired_time',
        'value_package',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        // return $this->belongsTo(Package::class);
    }
}
