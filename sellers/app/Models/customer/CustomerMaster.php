<?php

namespace App\Models\customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\customer\CustomerAddress;
use App\Models\customer\CustomerAddressType;

class CustomerMaster extends Model
{
    use HasFactory;
    protected $table = 'usr_mst';
    protected $guarded=[];
    public function telecom_ph($user_id){ return CustomerTelecom::where('user_id',$user_id)->where('usr_telecom_typ_id',2)->where('is_active',1)->where('is_deleted',0)->first(); }
    public function telecom_email($user_id){ return CustomerTelecom::where('user_id',$user_id)->where('usr_telecom_typ_id',1)->where('is_active',1)->where('is_deleted',0)->first(); }
    public function user_address($user_id,$default=''){ 
        
    $addr = CustomerAddress::getUserAddress($user_id,$default);
    return $addr;
    }

}
