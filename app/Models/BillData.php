<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillData extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = 'bill_data';
    protected $fillable = ['Card_Key', 'CurrencyDoc_Key', 'Organization_Key'];

    public static array $fields = [
        'Карточка_Key' =>'Card_Key',
        'ВалютаДокумента_Key' => 'CurrencyDoc_Key',
        'Организация_Key' =>'Organization_Key'
    ];

}
