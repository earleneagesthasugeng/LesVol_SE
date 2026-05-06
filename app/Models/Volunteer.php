<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $fillable = [
        'is_banned',
        'file_att_path',
        'user_id',
        'activity_id'
    ];
}
