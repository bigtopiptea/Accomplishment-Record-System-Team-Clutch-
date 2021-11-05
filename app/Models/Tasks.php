<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tasks extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'task_id');
    }

    public function uploadFiles()
    {
        return $this->hasMany(UploadFile::class, 'task_id');
    }
}
