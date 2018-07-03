<?php
namespace App\Classes;
use Illuminate\Hashing\BcryptHasher as BcryptHasher;
use App\User ;
class MD5Hasher extends BcryptHasher
{
public function check($value, $hashedValue, array $options = array())
   {
      $user = User::wherePassword(md5($value))->first();
      return $user ? true : false;
    }
}