<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffSecurity extends Model{
    use HasFactory;
    protected $table = 'usr_staff_security';
    protected $fillable = ['staff_id','password_hash', 'fb_id', 'google_id','apple_id'];
    
}
