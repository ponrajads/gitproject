<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Players extends Model
{
    use HasFactory;
    protected $table = 'players';

    protected $primaryKey = 'id';
	protected $fillable = ['eventid','serviceid','uniqueid','bibno','fname','lname','dob','gender',
    'state','email','mobile','photo','qrcode','status','createdby','created_at','updatedby','updated_at'];

    public static function getPlayerInfo($uniqueid,$eventid){

        $creds=Players::where('uniqueid',$uniqueid)->where('eventid',$eventid)
		->select('players.*',  DB::Raw('IFNULL(`lname` , "" ) as lname' )  )
		->first();

        return $creds;
    }

    public static function getPlayerAllInformation($tableid){

        $creds=Players::where('id',$tableid)
		->select('players.*',  DB::Raw('IFNULL(`lname` , "" ) as lname' )  )
		->first();
         
        return $creds;
    }
}
