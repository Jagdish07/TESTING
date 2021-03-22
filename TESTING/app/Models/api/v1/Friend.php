<?php

namespace App\Models\api\v1;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    
    protected $fillable = ['user_id','name','image','age','status'];
    
}

