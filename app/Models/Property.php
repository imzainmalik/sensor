<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{

    protected $fillable = ['title','slug','address', 'phone', 'user_id','created_at','updated_at'];
    use HasFactory;
}
