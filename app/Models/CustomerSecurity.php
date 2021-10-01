<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerSecurity extends Model
{
    use HasFactory;
    protected $table = 'usr_security';
    protected $guarded=[];
}
