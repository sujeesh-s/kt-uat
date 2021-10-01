<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderReturnStatus extends Model
{
    use HasFactory;
    protected $table = 'sales_order_shipping_status';
    protected $fillable     =   ['sales_id',' return_id','status',];
    
}

