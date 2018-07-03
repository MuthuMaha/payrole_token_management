<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RememberToken extends Model
{
    
protected $fillable=['user_id','token'];



    public function user() {
        return $this->belongsToOne('App\User');
    }
}
