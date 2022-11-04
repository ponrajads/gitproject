<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Podium extends Model
{
    use HasFactory;
    protected $table = 'podium';

    protected $primaryKey = 'id';
	protected $fillable = ['playersid','eventid','serviceid','status','reason','createdby','created_at','updatedby','updated_at'];

    public static function getAlreadyRegisteredOrNot($playerid) {

        $status=Podium::where('playersid',$playerid)->first();

        return $status;
    }

    public static function getApprovedPlayers($eventid) {

        $approvallist=Podium::join('players', function($join) {
            $join->on('players.id', '=', 'podium.playersid');
          })
          ->where('players.eventid',$eventid)
          ->where('podium.eventid',$eventid)
		  ->select('podium.*','players.*',  DB::Raw('IFNULL(`lname` , "" ) as lname' )  )
          ->where('podium.status',1)
          ->get();

        return $approvallist;
    }

    public static function getRejectedPlayers($eventid) {

        $approvallist=Podium::join('players', function($join) {
            $join->on('players.id', '=', 'podium.playersid');
          })
          ->where('players.eventid',$eventid)
          ->where('podium.eventid',$eventid)
		  ->select('podium.*','players.*',  DB::Raw('IFNULL(`lname` , "" ) as lname' )  )
          ->where('podium.status',2)
          ->get();

        return $approvallist;
    }
}
