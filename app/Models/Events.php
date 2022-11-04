<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;

    protected $table = 'events';
	protected $primaryKey = 'id';
	
	protected $fillable = ['userid','name','location','startdate','enddate','logo','status','createdby','created_at','updatedby','updated_at'];

	const UPDATED_AT = 'updated_at';
	
	const CREATED_AT = 'created_at';

	public static function getAllEventsList($userUID){

        $eventsList=Events::where('userid',$userUID)->orderBy('id', 'DESC')->get();

        return $eventsList;
    }
}
