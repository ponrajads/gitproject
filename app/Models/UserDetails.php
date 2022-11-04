<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class UserDetails extends Model
{
    use HasFactory;
    protected $table = 'userdetails';

    protected $primaryKey = 'id';
	protected $fillable = ['userid','roleid','fname','lname','organizer','createdby','created_at','updatedby','updated_at'];

   
}
