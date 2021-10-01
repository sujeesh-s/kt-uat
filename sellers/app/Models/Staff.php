<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable{
    use Notifiable;
    protected $table = 'usr_staff_mst';
    protected $fillable = ['org_id','username', 'ref_code','seller_id', 'password',];
    protected $hidden = ['password',];
    public function staffInfo(){ return $this->hasOne(StaffInfo::class, 'staff_id'); }
    public function store(){ return $this->hasOne(Store::class, 'seller_id'); }
    public function security(){ return $this->hasOne(StaffSecurity::class, 'staff_id'); }
    public function teleEmail(){ return $this->belongsTo(StaffTelecom::class, 'email'); }
    public function telePhone(){ return $this->belongsTo(StaffTelecom::class, 'phone'); }
    
}
