<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    protected $table = "usertable";
    protected $fillable = [
        "email",
        "password",
    ];
    
}
