<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    protected $fillable = [
        'cus_id',
        'o_id',
        'grand_total',
        'paidAmnt',
        'b_date',
        'time_from',
        'time_to',
        'cus_req',
        'Is_Active',
        'pay_pic',
    ];

 
}
