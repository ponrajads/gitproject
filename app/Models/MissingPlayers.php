<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class MissingPlayers extends Model
{
    use HasFactory;
    protected $table = 'missingplayers';

    protected $primaryKey = 'id';
	protected $fillable = ['eventid','serviceid','uniqueid','bibno','fname','lname','dob','gender',
    'state','email','mobile','photo','qrcode','status','createdby','created_at','updatedby','updated_at'];

    public static function getPlayerInfo($uniqueid,$eventid){

        $creds=MissingPlayers::where('uniqueid',$uniqueid)->where('eventid',$eventid)
		->select('missingplayers.*',  DB::Raw('IFNULL(`lname` , "" ) as lname' )  )
		->first();

        return $creds;
    }

    public static function getPlayerAllInformation($tableid){

        $creds=MissingPlayers::where('id',$tableid)
		->select('missingplayers.*',  DB::Raw('IFNULL(`lname` , "" ) as lname' )  )
		->first();
         
        return $creds;
    }
}
