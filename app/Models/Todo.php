<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    /** @var array */
    public $fillable = ['title', 'is_done'];
}
