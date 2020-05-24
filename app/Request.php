<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
     protected $fillable = ['created_at','requestnumber','user_id',
    'department','location','problem_description','priority','completed_by','Remarks','date_completed'
    ];
    

}