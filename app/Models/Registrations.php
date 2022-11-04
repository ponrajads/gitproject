<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Registrations extends Model
{
    use HasFactory;

    protected $table = 'registrations';

    protected $primaryKey = 'id';
	protected $fillable = ['playersid','eventid','serviceid','status','reason','createdby','created_at','updatedby','updated_at'];

    public static function getAlreadyRegisteredOrNot($playerid) {

        $status=Registrations::where('playersid',$playerid)->first();

        return $status;
    }

    public static function getApprovedRegistrationPlayers($eventid) {

        $approvallist=Registrations::join('players', function($join) {
            $join->on('players.id', '=', 'registrations.playersid');
          })
          ->where('players.eventid',$eventid)
          ->where('registrations.eventid',$eventid)
		  ->select('registrations.*','players.*',  DB::Raw('IFNULL(`lname` , "" ) as lname' )  )
          ->where('registrations.status',1)
          ->get();

        return $approvallist;
    }

    public static function getRejectedRegistrationPlayers($eventid) {

        $approvallist=Registrations::join('players', function($join) {
            $join->on('players.id', '=', 'registrations.playersid');
          })
          ->where('players.eventid',$eventid)
          ->where('registrations.eventid',$eventid)
		  ->select('registrations.*','players.*',  DB::Raw('IFNULL(`lname` , "" ) as lname' )  )
          ->where('registrations.status',2)
          ->get();

        return $approvallist;
    }
}
