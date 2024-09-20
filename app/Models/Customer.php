<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    
    protected $table = 'customer';
    protected $fillable = ['c_id','full_name', 'address', 'mobile', 'email', 'customer_photo'];
}
