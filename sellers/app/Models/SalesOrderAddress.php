<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderAddress extends Model
{
    use HasFactory;
    protected $table = 'sales_order_adderss';
    protected $fillable = ['sales_id','cust_id', 'addr_id', 'name','phone','email', 'address1', 'address2','zip_code','city', 'state','country', 'latitude', 'longitude',];
    
    
}