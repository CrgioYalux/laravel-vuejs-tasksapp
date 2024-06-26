<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function task() {
        return $this->belongsTo(PostTask::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }
}
