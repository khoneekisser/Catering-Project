<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddMenu extends Model
{
    use HasFactory;
    protected $table = 'menu';
    protected $fillable = ['b_id','item_name', 'category', 'picture', 'price', 'available', 'status', 'description'];
}
