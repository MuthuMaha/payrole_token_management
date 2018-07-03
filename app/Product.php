<?php

namespace App;

use App\Model\Review;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $fillable = [
		'name','detail','stock','price','discount'
	];
    
}
