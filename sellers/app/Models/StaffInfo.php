<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffInfo extends Model{
    use HasFactory;
    protected $table = 'usr_staff_info';
    protected $fillable = ['staff_id','fname', 'mname', 'lname','staff_role_id','avatar','is_active'];
    public function staffMst(){  return $this->belongsTo(Staff ::class, 'staff_id'); }
    public function store($sellerId){ return Store::where('seller_id',$sellerId)->first(); }
    public function staffRole(){ return $this->belongsTo(SellerUserRole::class, 'staff_role_id'); }
}
