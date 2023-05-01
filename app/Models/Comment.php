<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'parent_id',
        'body',
        'commentable_id',
        'commentable_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function comment_children()
    {
        return Comment::where('parent_id', $this->id)->get();
    }

    public function reacts()
    {
        return React::where('type', 'comment')->where('type_id', $this->id)->where('status', 'activate')->get();
    }

    public function myReact()
    {
        return React::where('type', 'comment')->where('type_id', $this->id)->where('user_id', Auth::user()->id)->first();
    }
}
