<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class task extends Model
{
    use SoftDeletes;
    protected $fillable = [
        "title",
        "description",
        "priority",
        "due_date",
        "dependency",
        "status",
        "subtasks",
        ];
    protected $table = "task";
}
