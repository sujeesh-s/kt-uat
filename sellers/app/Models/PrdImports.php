<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Product;
use App\Models\PrdShockingSaleProduct;
class PrdImports extends Model{
    use HasFactory;
    protected $table = 'prd_imports';
    protected $fillable = ['file','user_id','created_at'];
    

}
