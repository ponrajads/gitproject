<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Medical extends Model
{
    use HasFactory;
    protected $table = 'medical';

    protected $primaryKey = 'id';
	protected $fillable = ['playersid','eventid','serviceid','status','reason','createdby','created_at','updatedby','updated_at'];

    public static function getAlreadyRegisteredOrNot($playerid) {

        $status=Medical::where('playersid',$playerid)->first();

        return $status;
    }

    public static function getApprovedPlayers($eventid) {

        $approvallist=Medical::join('players', function($join) {
            $join->on('players.id', '=', 'medical.playersid');
          })
          ->where('players.eventid',$eventid)
          ->where('medical.eventid',$eventid)
		  ->select('medical.*','players.*',  DB::Raw('IFNULL(`lname` , "" ) as lname' )  )
          ->where('medical.status',1)
          ->get();

        return $approvallist;
    }

    public static function getRejectedPlayers($eventid) {

        $approvallist=Medical::join('players', function($join) {
            $join->on('players.id', '=', 'medical.playersid');
          })
          ->where('players.eventid',$eventid)
          ->where('medical.eventid',$eventid)
		  ->select('medical.*','players.*',  DB::Raw('IFNULL(`lname` , "" ) as lname' )  )
          ->where('medical.status',2)
          ->get();

        return $approvallist;
    }
}
