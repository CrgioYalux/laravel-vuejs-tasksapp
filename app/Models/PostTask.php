<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTask extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function post() {
        return $this->belongsTo(Post::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function task_statuses() {
        return $this->hasMany(TaskStatus::class);
    }
}
