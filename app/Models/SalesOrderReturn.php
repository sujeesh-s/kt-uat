<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderReturn extends Model
{
    use HasFactory;
    protected $fillable     =   ['sales_id','user_id','reason','desc',];
    
}

