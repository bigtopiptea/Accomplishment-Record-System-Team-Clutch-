<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UploadFile extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function tasks()
    {
        return $this->belongsTo(Tasks::class, 'id');
    }

    public function assignments()
    {
        return $this->belongsTo(Assignment::class, 'id');
    }

}
