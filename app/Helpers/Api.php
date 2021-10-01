<?php
use App\Models\CustomerLogin;
use App\Models\CustomerMaster;

if (!function_exists('validateToken')){
    function validateToken($token){
        $query                      =   CustomerLogin::where('access_token',$token)->where('is_login',1)->where('is_deleted',0);
        if($query->exists()){ 
            $user                   =   CustomerMaster::where('id',$query->first()->user_id)->first(); 
            if($user->info->profile_img != NULL){ $avatar = config('app.storage_url').$user->info->profile_img; }else{ $avatar = config('app.storage_url').'/app/public/no-avatar.png'; }
            $data['user_id']        =   $user->id;                              $data['first_name']         =   $user->info->first_name;
            $data['last_name']      =   $user->info->last_name;                 $data['email']              =   $user->custEmail($user->email);
            $data['phone']          =   $user->custPhone($user->phone);    
            $data['avatar']         =   $avatar;
            return $data;
        }else{ return false; }
    }
}if (!function_exists('invalidToken')){
    function invalidToken(){
        return array('httpcode'=>401,'status'=>'error','message'=>'Invalid Access Token','data'=>['message'=>'Invalid Access Token','redirect'=>'login']); 
    }
}if (!function_exists('smsCredientials')){
    function smsCredientials(){
        $data['sms_sender_id']  =   $data['sms_username'] = $data['sms_password'] = '';
        $query              =   DB::table('settings')->where('status',1)->whereIn('type',['sms_sender_id','sms_username','sms_password']);
        if($query->count()  >   0){ foreach($query->get() as $row){ $data[$row->type] = $row->value; } }
        return (object) $data;
    }
}


if (!function_exists('push')){
    function push(){
        $data['fire_base_id']   =   '';
        $query                  =   DB::table('settings')->where('status',1)->whereIn('type',['fire_base_id']);
        if($query->count()      >   0){ foreach($query->get() as $row){ $data[$row->type] = $row->value; } }
        return (object) $data;
    }
}
