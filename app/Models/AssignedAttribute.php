<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignedAttribute extends Model{
    use HasFactory;
    protected $table = 'prd_assigned_attributes';
    protected $fillable = ['prd_id','attr_id','attr_val_id','attr_value','created_by',];
    
    public function attrValue(){ return $this->belongsTo(PrdAttributeValue ::class, 'attr_val_id'); }
    
    /***API***/
    public function PrdAttr(){ return $this->belongsTo(PrdAttribute::class, 'attr_id'); }
    public function PrdAttr_value(){ return $this->belongsTo(PrdAttributeValue::class, 'attr_id'); }
    
}
