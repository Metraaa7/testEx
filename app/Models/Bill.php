<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

///**
// * @property string href
// */

class Bill extends Model
{
    use HasFactory;

    protected $table = 'bills';
    protected $fillable = ['href'];


}
