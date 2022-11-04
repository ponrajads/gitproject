<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerMaster extends Model
{
    use HasFactory;
    protected $table = 'playermaster';

    protected $primaryKey = 'id';
	protected $fillable = ['servicename','uniqueid','fname','lname','dob','gender','address1','address2','district',
    'state','email','mobile','photo','qrcode','status','createdby','created_at','updatedby','updated_at'];

  
}
