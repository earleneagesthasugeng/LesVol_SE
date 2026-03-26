<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class seeker extends Model
{
     protected $fillable = [
        'file_ktp_path',
        'user_id',
    ];
}
