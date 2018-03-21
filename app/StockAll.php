<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockAll extends Model
{
    protected $table = 'stock_all';

    protected $fillable = [
        'item' ,'unit', 'amount'
    ];
}
