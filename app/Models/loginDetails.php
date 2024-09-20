<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loginDetails extends Model
{
    use HasFactory;
    
    protected $table = 'login-details';
    protected $fillable = ['user_name', 'password', 'role', 'Is_Active'];
}
