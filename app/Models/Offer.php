<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected  $table = 'offers';
    protected  $fillable=['name','price','details','photo','created_at','updated_at'];
    protected $hidden = ['created_at','updated_at'];
//    protected $timestmps = false;
}
