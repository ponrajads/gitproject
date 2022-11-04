<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class FoodSession extends Model
{
    use HasFactory;
    protected $table = 'foodsession';

    protected $primaryKey = 'id';
	protected $fillable = ['id','eventid','sessionDate','foodType','created_at','updated_at'];

   
}
