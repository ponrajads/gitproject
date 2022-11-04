<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class FoodCourt extends Model
{
    use HasFactory;
    protected $table = 'foodcourt';

    protected $primaryKey = 'id';
	protected $fillable = ['playersid','eventid','serviceid','status','reason','createdby','created_at','updatedby','updated_at'];

    public static function getAlreadyRegisteredOrNot($playerid) {

        $status=FoodCourt::where('playersid',$playerid)->first();

        return $status;
    }

    public static function getApprovedPlayers($eventid) {

        $approvallist=FoodCourt::join('players', function($join) {
            $join->on('players.id', '=', 'foodcourt.playersid');
          })
          ->where('players.eventid',$eventid)
          ->where('foodcourt.eventid',$eventid)
		  ->select('foodcourt.*','players.*',  DB::Raw('IFNULL(`lname` , "" ) as lname' )  )
          ->where('foodcourt.status',1)
          ->get();

        return $approvallist;
    }

    public static function getRejectedPlayers($eventid) {

        $approvallist=FoodCourt::join('players', function($join) {
            $join->on('players.id', '=', 'foodcourt.playersid');
          })
          ->where('players.eventid',$eventid)
          ->where('foodcourt.eventid',$eventid)
		  ->select('foodcourt.*','players.*',  DB::Raw('IFNULL(`lname` , "" ) as lname' )  )
          ->where('foodcourt.status',2)
          ->get();

        return $approvallist;
    }
}
