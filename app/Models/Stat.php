<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Stat extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'views', 'clicks', 'cost'];

    //преобразуем в нужные типы, так как на выходе тип float выдает 0.6200000000001, хотя в БД записано 2 знака после запятой, не знаю почему так
    protected $casts = [
        'CPC' => 'string',
        'CPM' => 'string',
        'CTR' => 'string',
        'cost' => 'string',
        'COUNT' => 'string',
    ];

}
