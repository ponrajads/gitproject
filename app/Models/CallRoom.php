<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class CallRoom extends Model
{
    use HasFactory;
    protected $table = 'callroom';

    protected $primaryKey = 'id';
	protected $fillable = ['playersid','eventid','serviceid','status','reason','createdby','created_at','updatedby','updated_at'];

    public static function getAlreadyRegisteredOrNot($playerid) {

        $status=CallRoom::where('playersid',$playerid)->first();

        return $status;
    }

    public static function getApprovedPlayers($eventid) {

        $approvallist=CallRoom::join('players', function($join) {
            $join->on('players.id', '=', 'callroom.playersid');
          })
          ->where('players.eventid',$eventid)
          ->where('callroom.eventid',$eventid)
		   ->select('callroom.*','players.*',  DB::Raw('IFNULL(`lname` , "" ) as lname' )  )
          ->where('callroom.status',1)
          ->get();

        return $approvallist;
    }

    public static function getRejectedPlayers($eventid) {

        $approvallist=CallRoom::join('players', function($join) {
            $join->on('players.id', '=', 'callroom.playersid');
          })
          ->where('players.eventid',$eventid)
          ->where('callroom.eventid',$eventid)
		   ->select('callroom.*','players.*',  DB::Raw('IFNULL(`lname` , "" ) as lname' )  )
          ->where('callroom.status',2)
          ->get();

        return $approvallist;
    }
}
