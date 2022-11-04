<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $table = 'account';

    protected $primaryKey = 'id';
	protected $fillable = ['eventid','moduleid','username','password','qrcode','status'];

    public static function getUserDetailsByUserNamePass($username,$pass){
        

        $creds=Account::where('username',$username)->where('password',$pass)->first();

        return $creds;
    }

    public static function checkUserValidity($id){
        
        $today = date('Y-m-d');

        $creds=Account::join('events', function($join) {
            $join->on('events.id', '=', 'account.eventid');
          })
          ->where('account.id',$id)
          ->where('events.startdate','<=',$today)
          ->where('events.enddate','>=',$today)
          ->first();

        return $creds;
    }
    
    public static function getUserDetailsById($id){

        $creds=Account::where('id',$id)->first();

        return $creds;
    }
}
