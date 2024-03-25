<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function comments() {
        return $this->hasMany(PostComment::class);
    }

    public function post_task() {
        return $this->hasOne(Task::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
