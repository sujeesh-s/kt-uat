<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use DB;
use Redirect;
use App\Models\Store;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;
use App\Models\Seller;
use App\Models\SellerInfo;
use App\Models\Product;
use App\Models\Tax;
use App\Models\AdminProduct;
use App\Models\ProductType;
use App\Models\PrdPrice;
use App\Models\PrdImage;
use App\Models\PrdStock;
use App\Models\Language;
use App\Models\CmsContent;
use App\Models\PrdAttribute;
use App\Models\PrdAttributeValue;
use App\Models\AssignedAttribute;
use App\Models\AssociatProduct;
use App\Models\PrdAssignedTag;
use App\Models\RelatedProduct;
use App\Models\AssConfigAttribute;
use App\Models\PrdOffer;
use App\Models\PrdReview;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

use App\Models\Modules;
use App\Models\UserRoles;
use App\Models\Admin;
use App\Models\UserRole;


use App\Rules\Name;
use Validator;

class ProductImport implements ToCollection
{
   
    public function collection(Collection $rows)
    {
        $al_exists = $im_success = 0;

        foreach ($rows as $row_k => $row_v) 
        {
            if($row_k !=0) {

                if (Product::where('name', $row_v[0])->where('is_deleted',0)->exists() == false) {
                
               // dd($rows);
               $prd_arr = array();
               $prd_arr['seller_id']= auth()->user()->id;
               $prd_arr['sku']=$row_v[1];
               $prd_arr['product_type']=$row_v[2];
               $prd_arr['category_id']=$this->findCatId($row_v[3]);
             if(isset($row_v[4])) { $prd_arr['sub_category_id']=$this->findSubCatId($row_v[4],$this->findCatId($row_v[3])); }  
               $prd_arr['brand_id']=$this->findBrndId($row_v[5]);
               $prd_arr['tax_id']=$this->findTaxId($row_v[13]);
               $prd_arr['name']=$row_v[0];
               $prd_name = $this->addCmsData($row_v[0]);
               $prd_arr['name_cnt_id']=$this->addCmsData($row_v[0]);
               $prd_arr['short_desc_cnt_id']=$this->addCmsData($row_v[6]);
               $prd_arr['desc_cnt_id']=$this->addCmsData($row_v[7]);
               $prd_arr['content_cnt_id']=$this->addCmsData($row_v[8]);
               // dd($prd_arr);
               $prdId              =   Product::create($prd_arr)->id;
               // $prdId              = 110;
               $price_arr = array();
                $price_arr['created_by']    =   auth()->user()->id;
                $price_arr['prd_id']    =   $prdId;
                $price_arr['price']    =   $row_v[9]; 
                $price_arr['sale_price']    =   $row_v[10]; 
                if(isset($row_v[11])) {
                $sale_start_date = ($row_v[11] - 25569) * 86400;
                $sale_start_date = gmdate("Y-m-d", $sale_start_date); 
                $price_arr['sale_start_date']    =   $sale_start_date; 
                }

                if(isset($row_v[12])) {
                $sale_end_date = ($row_v[12] - 25569) * 86400;
                $sale_end_date = gmdate("Y-m-d", $sale_end_date);   
                $price_arr['sale_end_date']    =   $sale_end_date; 
                }

                 PrdPrice::create($price_arr);

                 if(isset($row_v[14])) {
                    PrdImage::create(['prd_id'=>$prdId,'image'=>$row_v[14],'thumb'=>$row_v[14],'created_by'=>auth()->user()->id]);

                 }
                 if(isset($row_v[15])) {

                    $exp_arr = explode(",", $row_v[15]);
                   
                    foreach($exp_arr as $ex_k=>$ex_v) {

                        $attr_exp = explode(":", $ex_v);
                        if(isset($attr_exp)){
                             // dd($attr_exp);
                        $attr_id = $this->findAttrId($attr_exp[0]);
                        if($attr_id>0) {
                          $attr_val_id = $this->findAttrValId($attr_exp[1]);
                          $attr_value = $attr_exp[1];

                            $prdAttr            =   ['prd_id'=>$prdId,'attr_id'=>$attr_id,'created_by'=>auth()->user()->id];
                            if(!isset($attr_val_id)){ $attr_val_id = NULL; } if(!isset($attr_value) || $attr_value == ''){ $attr_value = NULL; }
                            $prdAttr['attr_val_id'] = $attr_val_id; $prdAttr['attr_value'] = $attr_value;
                            if($attr_val_id  !=  NULL    ||  $attr_value != NULL){  
                            $prdAttr['updated_by'] = auth()->user()->id;
                            AssignedAttribute::create($prdAttr); 
                            }

                        }
                        }
                    }

                 }

                 if(isset($row_v[16])) {
                    $exp_arr = explode(",", $row_v[16]);
                    foreach($exp_arr as $ex_kv) {
                        $attr_id = $this->findAttrId($ex_kv);
                        if($attr_id>0 && $row_v[2] == 2) {
                            AssConfigAttribute::create(['prd_id'=>$prdId,'attr_id'=>$attr_id]); 
                        }

                        }

                    
                if(isset($row_v[17])) {
                    $exp_arr = explode(",", $row_v[17]);
                    foreach($exp_arr as $ex_kv) {

                         $prod_id = $this->findProdId($ex_kv);
                        if($prod_id>0 && $row_v[2] == 2) {
                           AssociatProduct::create(['prd_id'=>$prdId,'ass_prd_id'=>$prod_id]); 
                        }

                    }

                }
    

                 }

     
       
       
        $im_success = 1;
           }else {
            $al_exists = 1;

           } 
            }
            
        }
        $msg = '';
        if($im_success ==1 && $al_exists == 0) {
            $msg = "Product(s) imported successfully.";
        }else if($im_success ==1 && $al_exists == 1) {
            $msg = "Product(s) imported successfully. Some product(s) already existing.";
        }else if($im_success ==0 && $al_exists == 1) {
            $msg = " Some product(s) already existing.";
        }else {
             $msg = "Product import failed.";
        }
        Session::put('message', $msg);
    }

    public function getCpnContent($field_id){ 

        $language =DB::table('glo_lang_lk')->where('is_active', 1)->first();
        $content_table=DB::table('cms_content')->where('cnt_id', $field_id)->where('lang_id', $language->id)->first();
        if($content_table){ 
        $return_cont = $content_table->content;
        return $return_cont;
        }else{ return false; }
        }
        public function addCmsData($content){
            $latest = DB::table('cms_content')->orderBy('id', 'DESC')->first();
        $cms_field_cid=++$latest->cnt_id;
        

        $content_insert= DB::table('cms_content')->insertGetId([
        'org_id' => 1, 
        'lang_id' => 1,
        'cnt_id'=>$cms_field_cid,
        'content' => $content,
        'is_active'=>1,
        'created_by'=>auth()->user()->id,
        'updated_by'=>auth()->user()->id,
        'is_deleted'=>0,
        'created_at'=>date("Y-m-d H:i:s"),
        'updated_at'=>date("Y-m-d H:i:s")
        ]);

        return $cms_field_cid;
        }

        public function findCatId($field_id){ 

        $cat_id = 0;
        // whereRaw( 'LOWER(`cat_name`) LIKE ?', [ $field_id ] )
        if (Category::where('cat_name', $field_id)->where('is_deleted',0)->exists()) {

            $cat_id = Category::where('cat_name', $field_id)->where('is_deleted',0)->first()->category_id;
            return $cat_id;
        }else {
            
        //     $latest = DB::table('cms_content')->orderBy('id', 'DESC')->first();
        //     $latest_cat_cid=++$latest->cnt_id;
        //     $latest_desc_cid =$latest_cat_cid+1;
        //     $cat_cid = DB::table('cms_content')->insertGetId(
        //     ['org_id' => 1, 'lang_id' => 1,'cnt_id'=>$latest_cat_cid,'content' => $field_id,'is_active'=>1,'created_by'=>auth()->user()->id,'updated_by'=>auth()->user()->id,'is_deleted'=>0,'created_at'=>date("Y-m-d H:i:s"),'updated_at'=>date("Y-m-d H:i:s")]
        //     );
        //     $cat_desc_cid = DB::table('cms_content')->insertGetId(
        //     ['org_id' => 1, 'lang_id' => 1,'cnt_id'=>$latest_desc_cid,'content' => $field_id,'is_active'=>1,'created_by'=>auth()->user()->id,'updated_by'=>auth()->user()->id,'is_deleted'=>0,'created_at'=>date("Y-m-d H:i:s"),'updated_at'=>date("Y-m-d H:i:s")]
        //     );
        //     $cat_id              =   Category::create([
        //     'cat_name_cid' => $latest_cat_cid,
        //     'cat_name'=>$field_id,
        //     'slug' => strtolower(str_replace(" ", "-", $field_id)),
        //     'cat_desc_cid' => $latest_desc_cid,
        //     'image' => '',
        //     'sort_order'=>0,
        //     'is_active'=>1,
        //     'is_deleted'=>0,
        //     'created_by'=>auth()->user()->id,
        //     'modified_by'=>auth()->user()->id,
        //     'created_at'=>date("Y-m-d H:i:s"),
        //     'updated_at'=>date("Y-m-d H:i:s")
        // ])->category_id;
         
          return $cat_id;      
        }

        }
        public function findSubCatId($field_id,$cat_id){ 

        $return_id = 0;
        // whereRaw( 'LOWER(`subcategory_id`) LIKE ?', [ $field_id ] )
        if (Subcategory::where('subcategory_name', $field_id)->where('category_id',$cat_id)->where('is_deleted',0)->exists()) {

            $return_id = Subcategory::where('subcategory_name', $field_id)->where('category_id',$cat_id)->where('is_deleted',0)->first()->subcategory_id;
            return $return_id;
        }else {
            
        //     $latest = DB::table('cms_content')->orderBy('cnt_id', 'DESC')->first();
        //     $latest_cat_cid=++$latest->cnt_id;
        //     $latest_desc_cid =$latest_cat_cid+1;
        
        //     $cat_cid = DB::table('cms_content')->insertGetId(
        //     ['org_id' => 1, 'lang_id' => 1,'cnt_id'=>$latest_cat_cid,'content' => $field_id,'is_active'=>1,'created_by'=>auth()->user()->id,'updated_by'=>auth()->user()->id,'is_deleted'=>0,'created_at'=>date("Y-m-d H:i:s"),'updated_at'=>date("Y-m-d H:i:s")]
        //     );
        //     $cat_desc_cid = DB::table('cms_content')->insertGetId(
        //     ['org_id' => 1, 'lang_id' => 1,'cnt_id'=>$latest_desc_cid,'content' => $field_id,'is_active'=>1,'created_by'=>auth()->user()->id,'updated_by'=>auth()->user()->id,'is_deleted'=>0,'created_at'=>date("Y-m-d H:i:s"),'updated_at'=>date("Y-m-d H:i:s")]
        //     );

        //     $parentid_1=0;
        //     $level=0;


        //     $cat_id   =   Category::create([
        //     'category_id'=>$cat_id,
        //     'sub_name_cid' => $latest_cat_cid,
        //     'subcategory_name'=>$field_id,
        //     'slug' =>strtolower(str_replace(" ", "-", $field_id)),
        //     'desc_cid' => $latest_desc_cid,
        //     'image' => '',
        //     'parent'=> $parentid_1,
        //     'level'=>$level,
        //     'is_active'=>1,
        //     'is_deleted'=>0,
        //     'created_by'=>auth()->user()->id,
        //     'modified_by'=>auth()->user()->id,
        //     'created_at'=>date("Y-m-d H:i:s"),
        //     'updated_at'=>date("Y-m-d H:i:s")

        // ])->subcategory_id;
         
          return $return_id;      
        }

        }
         public function findBrndId($field_id){ 

        $return_id = 0;
        // whereRaw( 'LOWER(`cat_name`) LIKE ?', [ $field_id ] )
        if (Brand::where('name', $field_id)->where('is_deleted',0)->exists()) {

            $return_id = Brand::where('name', $field_id)->where('is_deleted',0)->first()->id;
            return $return_id;
        }else {
            
        //     $latest = DB::table('cms_content')->orderBy('id', 'DESC')->first();
        //     $brand_name_cid=++$latest->cnt_id;
        //     $brand_desc_cid =$brand_name_cid+1;
        //     $cat_cid = DB::table('cms_content')->insertGetId(
        //     ['org_id' => 1, 'lang_id' => 1,'cnt_id'=>$brand_name_cid,'content' => $field_id,'is_active'=>1,'created_by'=>auth()->user()->id,'updated_by'=>auth()->user()->id,'is_deleted'=>0,'created_at'=>date("Y-m-d H:i:s"),'updated_at'=>date("Y-m-d H:i:s")]
        //     );
        //     $cat_desc_cid = DB::table('cms_content')->insertGetId(
        //     ['org_id' => 1, 'lang_id' => 1,'cnt_id'=>$brand_desc_cid,'content' => $field_id,'is_active'=>1,'created_by'=>auth()->user()->id,'updated_by'=>auth()->user()->id,'is_deleted'=>0,'created_at'=>date("Y-m-d H:i:s"),'updated_at'=>date("Y-m-d H:i:s")]
        //     );
        //     $return_id   =   Brand::create([
        //     'org_id' => 1, 
        //     'name' =>$field_id,
        // 'brand_name_cid' => $brand_name_cid,
        // 'brand_desc_cid' => $brand_desc_cid,
        // 'is_active'=>1,
        // 'is_deleted'=>0,
        // 'created_by'=>auth()->user()->id,
        // 'modified_by'=>auth()->user()->id,
        // 'created_at'=>date("Y-m-d H:i:s"),
        // 'updated_at'=>date("Y-m-d H:i:s")
        // ])->id;
         
          return $return_id;      
        }

        }
        public function findTaxId($field_id){ 
          $return_id = 0;
        // whereRaw( 'LOWER(`name`) LIKE ?', [ $field_id ] )
        if (Tax::where('name', $field_id)->where('is_deleted',0)->exists()) {

            $return_id = Tax::where('name', $field_id)->where('is_deleted',0)->first()->id;
            return $return_id;
        }else {
            return $return_id;      
        }
        }
         public function findAttrId($field_id){ 
          $return_id = 0;
        if (PrdAttribute::where('name', $field_id)->where('is_deleted',0)->exists()) {

            $return_id = PrdAttribute::where('name', $field_id)->where('is_deleted',0)->first()->id;
            return $return_id;
        }else {
            return $return_id;      
        }
        }
        public function findAttrValId($field_id){ 
        $return_id = 0;
        if (PrdAttributeValue::where('name', $field_id)->where('is_deleted',0)->exists()) {

        $return_id = PrdAttributeValue::where('name', $field_id)->where('is_deleted',0)->first()->id;
        return $return_id;
        }else {
        return $return_id;      
        }
        }
        public function findProdId($field_id){ 
        $return_id = 0;
        if (Product::where('name', $field_id)->where('is_deleted',0)->exists()) {

        $return_id = Product::where('name', $field_id)->where('is_deleted',0)->first()->id;
        return $return_id;
        }else {
        return $return_id;      
        }
        }


}