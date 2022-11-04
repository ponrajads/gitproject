<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class OnField extends Model
{
    use HasFactory;
    protected $table = 'onfield';

    protected $primaryKey = 'id';
	protected $fillable = ['playersid','eventid','serviceid','status','reason','createdby','created_at','updatedby','updated_at'];

    public static function getAlreadyRegisteredOrNot($playerid) {

        $status=OnField::where('playersid',$playerid)->first();

        return $status;
    }

    public static function getApprovedPlayers($eventid) {

        $approvallist=OnField::join('players', function($join) {
            $join->on('players.id', '=', 'onfield.playersid');
          })
          ->where('players.eventid',$eventid)
          ->where('onfield.eventid',$eventid)
		  ->select('onfield.*','players.*',  DB::Raw('IFNULL(`lname` , "" ) as lname' )  )
          ->where('onfield.status',1)
          ->get();

        return $approvallist;
    }

    public static function getRejectedPlayers($eventid) {

        $approvallist=OnField::join('players', function($join) {
            $join->on('players.id', '=', 'onfield.playersid');
          })
          ->where('players.eventid',$eventid)
          ->where('onfield.eventid',$eventid)
		  ->select('onfield.*','players.*',  DB::Raw('IFNULL(`lname` , "" ) as lname' )  )
          ->where('onfield.status',2)
          ->get();

        return $approvallist;
    }
}
