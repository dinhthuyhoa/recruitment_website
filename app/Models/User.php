<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'avatar',
        'address',
        'phone',
        'gender',
        'birthday',
        'email',
        'status',
        'password',
        'facebook_id',
        'google_id',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function is_post_favorite($post_id)
    {
        if (
            PostFavorite::where('post_id', $post_id)->where('user_id', $this->id)->exists()
            && PostFavorite::where('post_id', $post_id)->where('user_id', $this->id)->first()->status == 1
        ) {
            return true;
        } else {
            return false;
        }
    }
}