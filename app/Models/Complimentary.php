<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Complimentary extends Model
{
    use HasFactory;
    protected $table = 'complimentary';

    protected $primaryKey = 'id';
	protected $fillable = ['playersid','eventid','serviceid','status','reason','createdby','created_at','updatedby','updated_at'];

    public static function getAlreadyRegisteredOrNot($playerid) {

        $status=Complimentary::where('playersid',$playerid)->first();

        return $status;
    }

    public static function getApprovedPlayers($eventid) {

        $approvallist=Complimentary::join('players', function($join) {
            $join->on('players.id', '=', 'complimentary.playersid');
          })
          ->where('players.eventid',$eventid)
          ->where('complimentary.eventid',$eventid)
          ->where('complimentary.status',1)
		   ->select('complimentary.*','players.*',  DB::Raw('IFNULL(`lname` , "" ) as lname' )  )
          ->get();

        return $approvallist;
    }

    public static function getRejectedPlayers($eventid) {

        $approvallist=Complimentary::join('players', function($join) {
            $join->on('players.id', '=', 'complimentary.playersid');
          })
          ->where('players.eventid',$eventid)
          ->where('complimentary.eventid',$eventid)
		  ->select('complimentary.*','players.*',  DB::Raw('IFNULL(`lname` , "" ) as lname' )  )
          ->where('complimentary.status',2)
          ->get();

        return $approvallist;
    }
}
