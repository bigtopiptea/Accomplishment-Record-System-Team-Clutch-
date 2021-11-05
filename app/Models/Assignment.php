<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function uploadFiles()
    {
        return $this->hasMany(UploadFile::class, 'assignment_id');
    }

    public function tasks()
    {
        return $this->hasMany(Tasks::class, 'id');
    }
}
