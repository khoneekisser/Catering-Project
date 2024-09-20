<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    
    protected $table = 'owner';
    protected $fillable = ['o_id', 'Catering_Name', 'Logo','latitude', 'longitude', 'Provience', 'District', 'L_Muncipality', 'Ward', 'Pan_no', 'Pan_no_Photo', 'Reg_no', 'Reg_no_Photo', 'Contact', 'Mobile', 'Email', 'Remark', 'qr_photo'];
}
