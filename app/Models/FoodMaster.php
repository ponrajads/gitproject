<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class FoodMaster extends Model
{
    use HasFactory;
    protected $table = 'foodmaster';

    protected $primaryKey = 'id';
	protected $fillable = ['id','foodList','created_at','updated_at'];

   
}
