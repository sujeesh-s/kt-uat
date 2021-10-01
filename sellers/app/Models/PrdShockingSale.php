<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Product;
use App\Models\PrdShockingSaleProduct;
class PrdShockingSale extends Model{
    use HasFactory;
    protected $table = 'prd_shock_sale';
    protected $fillable = ['title_cid','start_time','end_time','discount_type','discount_value','is_active','is_deleted','created_by','updated_by','user_type'];
    public function product(){ return $this->belongsTo(Product ::class, 'prd_id'); }

    static function getShockingSales(){ 
         
           $shk_list = PrdShockingSale::where(function ($query) { $query->where('is_deleted', '=', NULL)->orWhere('is_deleted', '=', 0);})->where('is_active',1)->orderBy('id', 'DESC')->get();     
           
        

            if($shk_list){ 
            $data               =   [];
            foreach($shk_list    as  $row){
            $data[$row->id]['id']        =   $row->id;
            $data[$row->id]['title_cid']         =   $row->title_cid;
            $data[$row->id]['title']       =    PrdShockingSale::getCpnContent($row->title_cid);
            // $data[$row->id]['prd_id']         =   $row->prd_id;
            $data[$row->id]['products']         =   PrdShockingSaleProduct::getShockingSalesProducts($row->id);
            $data[$row->id]['start_time']       =   $row->start_time;
            $data[$row->id]['end_time']       =   $row->end_time;
            $data[$row->id]['expired']         =   PrdShockingSale::getExpireStatus($row->end_time);
            $data[$row->id]['discount_type']       =   $row->discount_type;
            $data[$row->id]['discount_value']       =   $row->discount_value;
            $prd_status      =   PrdShockingSaleProduct::getShockingSalesProductsStatus($row->id);
            if(isset($prd_status) && count($prd_status)>0) {
                $data[$row->id]['is_active']       =   $prd_status['is_active'];
            $data[$row->id]['prd_sale_id']       =   $prd_status['id'];
            }else {
                $data[$row->id]['is_active']       =   0;
            $data[$row->id]['prd_sale_id']       =   0;
            }
            
            $data[$row->id]['created_by']       =   $row->created_by; 
            $data[$row->id]['created_at']       =   $row->created_at; 
              }

            return $data;
            }else{ return false; }

        }
        static function getShockingSalesData($id){ 
         
           $shk_list = PrdShockingSale::where('id',$id)->get();     
           
            if($shk_list){ 
            $data               =   [];
            foreach($shk_list    as  $row){
            $data['id']        =   $row->id;
            $data['title_cid']         =   $row->title_cid;
            $data['title']       =    PrdShockingSale::getCpnContent($row->title_cid);
            $data['prd_id']         =   $row->prd_id;
            $data['products']         =   PrdShockingSale::getProducts($row->prd_id);
            $data['start_time']       =   $row->start_time;
            $data['end_time']       =   $row->end_time;
            $data['expired']         =   PrdShockingSale::getExpireStatus($row->end_time);
            $data['discount_type']       =   $row->discount_type;
            $data['discount_value']       =   $row->discount_value;
            $data['is_active']       =   $row->is_active;
            $data['created_by']       =   $row->created_by; 
            $data['created_at']       =   $row->created_at; 
              }

            return $data;
            }else{ return false; }

        }
    
    static function getCpnContent($field_id){ 

        $language =DB::table('glo_lang_lk')->where('is_active', 1)->first();
        $content_table=DB::table('cms_content')->where('cnt_id', $field_id)->where('lang_id', $language->id)->first();
        if($content_table){ 
        $return_cont = $content_table->content;
        return $return_cont;
        }else{ return false; }
        }

    static function getProducts($field_id){ 

        $exp = explode(",", $field_id);
        $prd_arr = [];
        foreach($exp as $k=>$v){

          if(Product::where("id",$v)->first()){ $prd_arr[] = Product::where("id",$v)->first()->name; }  
        }
        if($prd_arr){ 
        $return_cont = implode(",", $prd_arr);
        return $return_cont;
        }else{ return false; }
        }
        static function getExpireStatus($field_id){ 
        date_default_timezone_set("Asia/Calcutta");
        $expired = 0;
        if(strtotime($field_id) < time()) {
        $expired = 1;
        }
      
        return $expired;
        
        }

}
