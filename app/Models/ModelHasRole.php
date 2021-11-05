<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelHasRole extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }
}
