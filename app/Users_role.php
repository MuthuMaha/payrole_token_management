<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users_role extends Model
{
    protected $fillable=[ 'payrole_id','role_id','user_id'];

    public function users() { 
        return $this->belongsToMany('App\User');
     } 
}
