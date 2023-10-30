<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSpcl extends Model
{
    use HasFactory;
    protected $table = 'user_spcl';
    protected $fillable = [
        'user_id','spcl_code', 'spcl_desc'
    ];
}
