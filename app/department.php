<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class department extends Model
{
    protected $fillable = [
    'name','faculty_id'
    ];
}