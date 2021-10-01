<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminProduct extends Model{
    use HasFactory;
    protected $table = 'prd_admin_products';
    protected $fillable = ['prd_id','image','thumb','created_by','is_active'];
    
    public function category(){ return $this->belongsTo(Category ::class, 'category_id'); }
    public function subCategory(){ return $this->belongsTo(Subcategory ::class, 'sub_category_id'); }
    public function brand(){ return $this->belongsTo(Brand ::class, 'brand_id'); }
}
