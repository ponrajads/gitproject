<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class EventMaster extends Model
{
    use HasFactory;
    protected $table = 'eventmaster';

    protected $primaryKey = 'id';
	protected $fillable = ['eventID','eventName','isActive','created_at','updated_at'];
}
