<?php

namespace App\Models;

use App\Enums\PostCategory;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_title',
        'post_content',
        'post_date',
        'post_date_update',
        'post_view',
        'post_status',
        'post_type',
    ];

    public function getMeta($key)
    {
        return PostMeta::where('post_id', $this->id)->where('key', $key)->first() ? PostMeta::where('post_id', $this->id)->where('key', $key)->first()->value : '';
    }

    public function getInforRecruitment()
    {
        $this->recruitment_address = $this->getMeta('address');
        $this->recruitment_job_nature = $this->getMeta('job-nature');
        $this->recruitment_vacancy = $this->getMeta('vacancy');
        $this->recruitment_salary = $this->getMeta('salary');
        $this->recruitment_email = $this->getMeta('email');
        $this->recruitment_phone = $this->getMeta('phone');
        $this->recruitment_position = $this->getMeta('position');
        $this->recruitment_experience = $this->getMeta('experience');
        $this->recruitment_deadline = $this->getMeta('deadline');
        $this->post_date = date('d/m/Y', strtotime($this->post_date));
        $this->post_date_update = date('d/m/Y', strtotime($this->post_date_update));
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    public function reacts()
    {
        return React::where('type', 'post')->where('type_id', $this->id)->where('status', 'activate')->get();
    }

    public function myReact()
    {
        return React::where('type', 'post')->where('type_id', $this->id)->where('user_id', Auth::user()->id)->first();
    }

}
