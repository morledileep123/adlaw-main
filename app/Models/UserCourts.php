<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourts extends Model
{
    use HasFactory;
    protected $table = "user_courts";
    protected $fillable = [
        'user_id','court_code', 'court_name'
    ];
}
