<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $fillable=['user_id','expiry_time','access_token'];

    	public function user () {
		return $this->belongsTo(User::class, 'user_id', 'id');
	}
}
