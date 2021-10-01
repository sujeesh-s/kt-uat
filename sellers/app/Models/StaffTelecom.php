<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class StaffTelecom extends Model{
    use HasFactory;
    protected $table        =   'usr_staff_telecom';
    protected $fillable     =   ['staff_id','type_id', 'value'];
    
    static function ValidateUnique($field,$value,$id) {
      //  DB::enableQueryLog();
        $query              =   StaffTelecom::join('usr_staff_mst as M','usr_staff_telecom.id','=','M.'.$field)
                                ->join('usr_staff_info as I','M.id','=','I.staff_id')
                                ->where('I.is_deleted',0)->where('usr_staff_telecom.value',$value);
     //   dd(DB::getQueryLog());
        if($query->count()  >   0){
            if($query->first(['M.id'])->id   !=  $id){ return true; }else{ return false; }
        }else{ return false; }
    }
    
}
