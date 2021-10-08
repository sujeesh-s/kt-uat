<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Models\Category;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Telecom;
use App\Models\Seller;
use App\Models\SellerInfo;
use App\Models\SellerSecurity;
use App\Models\SellerTelecom;
use App\Models\StoreCategory;
use App\Models\Store;
use App\Models\SlotDelySlot;
use App\Models\SpotDelySlot;
use App\Models\AssignedSlot;
use App\Models\SellerBank;
use App\Models\Email;
use App\Models\SellerOTP;

use App\Rules\Name;
use Validator;
use Session;

class SellerController extends Controller{
    public function __construct(){ $this->middleware('auth:admin'); }
    public function sellers(Request $request){ 
        $post                       =   (object)$request->post(); $res = []; $action = '';
        if(isset($post->viewType))  {   $viewType = $post->viewType; }else{ $viewType = ''; }
        $data['title']              =   'Seller List';
        $data['menuGroup']          =   'userGroup';
        $data['menu']               =   'seller';
        $data['active']             =   '';
        $sellers                    =   SellerInfo::where('is_approved',1)->where('is_deleted',0);
        if(isset($request->active)     &&  $request->active != ''){ 
            $sellers                =   $sellers->where('is_active',$request->active); 
            $data['active']         =   $request->active;
        }
        if(isset($post->vType)       ==  'ajax'){
           $search                  =   (isset($post->search['value']))? $post->search['value'] : ''; 
           $start                   =   (isset($post->start))? $post->start : 0; 
           $length                  =   (isset($post->length))? $post->length : 10; 
           $draw                    =   (isset($post->draw))? $post->draw : ''; 
           $totCount                =   $sellers->count(); $filtCount  =   $sellers->count();
           if($search != ''){
                $sellers            =   $sellers->where(function($qry) use ($search){
                                            $qry->whereIn('seller_id', $this->searchStoreSellerIds($search,'business_name'));
                                            $qry->orWhereIn('seller_id', $this->searchStoreSellerIds($search,'store_name'));
                                            $qry->orWhereIn('seller_id', $this->searchTelecomSellerIds($search));
                                        });
                $filtCount          =   $sellers->count();
           }
           if($length > 0){$sellers =   $sellers->offset($start)->limit($length); }
           $activities              =   $sellers->orderBy('id','desc')->get();
           if($activities){ foreach (   $activities as $row){
               if($row->is_active   ==  1){ $checked    = 'checked="checked"'; $act = 'Active'; }else{ $checked = '';  $act = 'Inactive'; }
               if($row->store($row->seller_id)->service_status  ==  1){ $sChecked    = 'checked="checked"'; }else{ $sChecked = ''; }
               $val['id']           =   '';                                 $val['store_name']      =   $row->store($row->seller_id)->store_name;
               $val['business_name']=   '<a id="dtlBtn-'.$row->seller_id.'" class="font-weight-bold viewDtl">'.$row->store($row->seller_id)->store_name.'</a>';
               $val['email']        =   $row->sellerMst->teleEmail->value;      $val['phone']       =   $row->sellerMst->telePhone->value;
               $val['created_at']   =   date('d M Y, g:i a',strtotime($row->created_at)); 
               $val['status']       =   '<div class="switch" data-search="'.$act.'">
                                            <input class="switch-input status-btn" id="status-'.$row->sellerMst->id.'" type="checkbox" '.$checked.' name="status">
                                            <label class="switch-paddle" for="status-'.$row->sellerMst->id.'">
                                                <span class="switch-active" aria-hidden="true">Active</span><span class="switch-inactive" aria-hidden="true">Inactive</span>
                                            </label>
                                        </div>';
               $val['service_status']=  '<div class="switch" data-search="'.$act.'">
                                            <input class="switch-input service-status-btn" id="service-status-'.$row->sellerMst->id.'" type="checkbox" '.$sChecked.' name="status">
                                            <label class="switch-paddle" for="service-status-'.$row->sellerMst->id.'">
                                                <span class="switch-active" aria-hidden="true">Active</span><span class="switch-inactive" aria-hidden="true">Inactive</span>
                                            </label>
                                        </div>';
                                        $action ='';
                if(checkPermission('admin/sellers','edit') == true){
                    $action         .=   '<button id="editBtn-'.$row->sellerMst->id.'" class="mr-2 btn btn-info btn-sm editBtn"><i class="fa fa-edit mr-1"></i>Edit</button>';
                }if(checkPermission('admin/sellers','delete') == true){
                    $action         .=   '<button id="delBtn-'.$row->sellerMst->id.'" class="mr-2 btn btn-secondary btn-sm delBtn"><i class="fe fe-trash-2 mr-1"></i>Delete</button>';
                }
               $val['action']       =   $action; $res[] = $val;  
           } }
           $returnData = array(
			"draw"            => $draw,   
			"recordsTotal"    => $totCount,  
			"recordsFiltered" => $filtCount,
			"data"            => $res   // total data array
			);
            return $returnData;
        }
        if($viewType == 'ajax')     {   return view('admin.seller.list',$data); }else{ return view('admin.seller.page',$data); }
    }
    
    public function newSellers()
    { 
        $data['title']              =   'New Seller Request List';
        $data['menuGroup']          =   'userGroup';
        $data['menu']               =   'seller';
        $data['sellers']            =   SellerInfo::where('is_approved','!=',1)->where('is_deleted',0)->orderBy('id','desc')->get();
        return view('admin.new_seller.list',$data);
    }
    
    function seller(Request $request, $id=0,$type=''){
        if($type == 'view')         {   $title = 'View Seller'; }else if($type == 'new'){ $title = 'View Seller'; }else if($id > 0){ $title = 'Edit Seller'; }else{ $title = 'Add Seller'; }
        $data['title']              =   'View Seller'; 
        $data['menuGroup']          =   'userGroup';
        $data['menu']               =   'seller';
        $stateId = $countryId       =   0;
        $data['seller']             =   Seller::where('id',$id)->first();
        $data['info']               =   SellerInfo::where('id',$id)->first();
        $data['bank']               =   SellerBank::getBankData($id);
        $store                      =   Store::where('seller_id',$id)->where('is_deleted',0)->first();
        $data['store']              =   $store;
        if($store){ $countryId      =  (int)$store->country_id; $stateId = (int)$store->state_id; }
        $data['categories']         =   getDropdownData(Category::where('is_deleted',0)->get(),'category_id','cat_name');
        $data['countries']          =   getDropdownData(Country::where('is_deleted',0)->get(),'id','country_name');
        $data['states']             =   getDropdownData(State::where('country_id',$countryId)->where('is_deleted',0)->get(),'id','state_name');
        $data['cities']             =   getDropdownData(City::where('state_id',$stateId)->where('is_deleted',0)->get(),'id','city_name');
        $data['slots']              =   getDropdownData(SlotDelySlot::where('is_deleted',0)->get(),'id','slot_name');
        $data['spots']              =   getDropdownData(SpotDelySlot::where('is_deleted',0)->get(),'id','slot_name');
        $data['assSlots']           =   AssignedSlot::where('seller_id',$id)->where('slot_type','slot')->where('is_deleted',0)->get();
        $data['assSpots']           =   AssignedSlot::where('seller_id',$id)->where('slot_type','spot')->where('is_deleted',0)->get();
        $data['assCategories']      =   StoreCategory::where('seller_id',$id)->where('is_deleted',0)->get(['category_id']);
        $data['filters']            =   $request->post();
        if($type == 'new')          {   return view('admin.new_seller.details',$data); }else if($type == 'view'){ return view('admin.seller.view',$data); }
        return view('admin.seller.details',$data);
    }

    function validateSeller(Request $request){
        $post                   =   (object)$request->post(); $error = false;
        $info                   =   $request->post('info'); $store = $request->post('store'); $storeSet = $request->post('storeSet');
        $rules                  =   [
                                        'email'                 =>  'required|string|email|max:100',
                                        'phone'                 =>  'required|numeric|digits_between:7,12',
                                        'business_name'         =>  'required|string','store_name'  =>  'required|string',
                                        'director_name'         =>  ['required', 'string','max:100', new Name],
                                    ];
        $validator              =   Validator::make($post->info,$rules);
        $validEmail             =   SellerTelecom::ValidateUnique('email',$info['email'],$post->id);
        $validPhone             =   SellerTelecom::ValidateUnique('phone',$info['phone'],$post->id);
        if ($validator->fails()){
            $error['error']     =   'info';
           foreach($validator->messages()->getMessages() as $k=>$row){ $error[$k] = $row[0]; }
        }
        if($validEmail){ $error['email']    =   $validEmail; $error['error']     =   'info';}
        if($validPhone){ $error['phone']    =   $validPhone; $error['error']     =   'info';}
        if($error) { return $error; }
        $rules                  =   ['address'  => 'required|string|max:250','country_id' =>  'required','state_id' =>  'required', 'city_id' =>  'required',];   
        $validator              =   Validator::make($store,$rules);
        if ($validator->fails()){
            $error['error']     =   'store';
           foreach($validator->messages()->getMessages() as $k=>$row){ $error[$k] = $row[0]; }
        } 
        if($error) { return $error; }
        $rules                  =   ['categories'  => 'required','commission' =>  'required|numeric|min:1|max:99'];   
        $validator              =   Validator::make($storeSet,$rules);
        if ($validator->fails()){
            $error['error']     =   'storeSet';
           foreach($validator->messages()->getMessages() as $k=>$row){ $error[$k] = $row[0]; }
        } 
        if($error) { return $error; }else{ return 'success'; }
    }   

    function saveSeller(Request $request){
        $post                   =   (object)$request->post(); 
        $info                   =   (object)$post->info;
        $store                  =   $post->store; 
        $storeSet               =   (object)$post->storeSet; 
        $images                 =   $request->file('image'); if(isset($post->filter)) { $filter = (object)$post->filter; }
        $selInfo                   =   ['fname'=>$info->director_name,'ic_number'=>$info->ic_number,'is_active'=>$storeSet->is_active];
        
     //   $store['pack_charge']   =   $storeSet->pack_charge;
     $store['licence'] =   $info->licence; $store['incharge_name'] =   $info->incharge_name; $store['incharge_phone'] =   $info->incharge_phone;
        $store['business_name'] =   $info->business_name;       $store['store_name']    =   $info->store_name;      $store['licence']    =   $info->licence;
        $store['commission']    =   $storeSet->commission;      $store['is_active']     =   $storeSet->is_active;
        $emailTypeId            =   Telecom::where('name','email')->first()->id; $phoneTypeId   =   Telecom::where('name','phone')->first()->id;
        if($post->id            >   0){ 
            $seller             =   Seller::where('id',$post->id)->first();
            if($info->email     !=  $seller->username){ Seller::where('id',$post->id)->update(['username'=>$info->email]); }
            $sellerId           =   $post->id; $storeId = $post->storeId;
                                    SellerTelecom::where('id',$seller->email)->update(['value'=>$info->email]);
                                    SellerTelecom::where('id',$seller->phone)->update(['value'=>$info->phone]);
                                    SellerInfo::where('seller_id',$sellerId)->update($selInfo); Store::where('id',$storeId)->update($store);
            $msg                =   'Seller updated successfully!';
        }else{
            $selInfo['is_approved']=   1;  $selInfo['approved_at'] = date('Y-m-d H:i:s'); $selInfo['ic_number'] = $info->ic_number;
            $sellerId           =   Seller::create(['username'=>$info->email,'password'=>Hash::make('123456')])->id; $selInfo['seller_id'] = $store['seller_id'] = $sellerId; 
            $storeId            =   Store::create($store)->id; SellerInfo::create($selInfo);
            $teleEmail          =   ['seller_id'=>$sellerId,'type_id'=>$emailTypeId,'value'=>$info->email]; 
            $telePhone          =   ['seller_id'=>$sellerId,'type_id'=>$phoneTypeId,'value'=>$info->phone]; 
            $emailId            =   SellerTelecom::create($teleEmail)->id; 
            $phoneId            =   SellerTelecom::create($telePhone)->id; Seller::where('id',$sellerId)->update(['email'=>$emailId,'phone'=>$phoneId]);
                                    SellerSecurity::create(['seller_id'=>$sellerId,'password_hash'=>Hash::make('123456')]); 
            $msg                =   'Seller added successfully!';
        }
        $this->assignStoreCategories($storeSet->categories,$storeId,$sellerId);
        if($images){ foreach($images as $k=>$image){
            $imgName            =   $k.'logo.'.$image->extension();
            $path               =   '/app/public/stores/'.$storeId;
            $destinationPath    =   storage_path($path);
            $image->move($destinationPath, $imgName);
            $imgData[$k]        =   $path.'/'.$imgName;
            Store::where('id',$storeId)->update($imgData);
        } }
        if($post->formType      ==  'newSeller'){ 
            $sellerotp = mt_rand(100000, 999999);
            $currTime = date('Y-m-d H:i:s');
            
            $msg = '<h4>Hi, ' . $seller->fname . ' </h4>';
            $msg .= '<p>Your account has been approved by the Admin. Please use the below OTP for authentication, once authenticated you will be able to create your account password. OTP is valid for 5 minutes</p><h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">'.$sellerotp.'</h2><p><a href="' . url('/sellers/otp-verification/') . '">Click here</a> to verify your OTP.</p><p style="font-size:0.9em;">Regards,<br />' . ucfirst(geSiteName()) . '</p>';
            $update = SellerOTP::create(['user_id'=>$sellerId,'user_type'=>'seller','email'=>$info->email,'token'=>$sellerotp]);
            if ($update) Email::sendEmail(geAdminEmail(), $info->email, 'OTP For Login', $msg);

            SellerInfo::where('seller_id',$sellerId)->update(['is_approved'=>1,'approved_at'=>date('Y-m-d H:i:s')]); $msg =   'Seller approved successfully!';
           
        }
        $data['title']          =   'Seller List';
      if(isset($filter)){  $data['active']         =   $filter->active; }else {  $data['active']         = ""; }
        $sellers                =   SellerInfo::where('is_approved',1)->where('is_deleted',0);
        if(isset($post->active) &&  $post->active != ''){ 
            $attributes         =   $sellers->where('is_active',$post->active); 
            $data['active']     =   $post->active;
        }
        $data['sellers']        =   $sellers->orderBy('id','desc')->get();
       return redirect('admin/new-sellers');
    }
    
    function assignStoreCategories($catIds,$storeId,$sellerId){
        StoreCategory::where('store_id',$storeId)->update(['is_deleted'=>1]);
        foreach($catIds as $cId){ 
            if(StoreCategory::where('store_id',$storeId)->where('category_id',$cId)->count() > 0){ 
                StoreCategory::where('store_id',$storeId)->where('category_id',$cId)->update(['is_deleted'=>0]);
            }else{ StoreCategory::create(['seller_id'=>$sellerId,'store_id'=>$storeId,'category_id'=>$cId]); }
        } return true;
    }
    
    function updateStatus(Request $request){
        $post               =   (object)$request->post(); 
        $result             =   SellerInfo::where('id',$post->id)->update([$post->field => $post->value]);
        if($post->page      !=  'new_seller'){  Store::where('seller_id',$post->id)->update([$post->field => $post->value]); }
        if($post->field     ==  'is_approved'){
            Session::flash('success', $post->msg);
        }else{
            if($result){ return ['type'=>'success','id'=>$post->id]; }else{  return ['type'=>'warning','id'=>$post->id]; } 
        }
    }
    function updateServiceStatus(Request $request){
        $post               =   (object)$request->post(); 
        $result             =   Store::where('seller_id',$post->id)->update([$post->field => $post->value]);
        
            if($result){ return ['type'=>'success','id'=>$post->id]; }else{  return ['type'=>'warning','id'=>$post->id]; } 
        
    }
    function saveSellerBank(Request $request){
        $post               =   (object)$request->post(); 
        $encrypted = Crypt::encryptString($post->acc_number);
        // $decrypt= Crypt::decryptString($encrypted);
        $bank_arr = array();
        $bank_arr['seller_id'] = $post->seller_id;
        $bank_arr['ac_no'] = $encrypted;
        $bank_arr['ac_holder'] = $post->acc_holder;
        $bank_arr['bank'] = $post->bank_name;
        $bank_arr['acc_type'] = $post->acc_type;
        $bank_arr['ifsc'] = $post->ifsc;
        $bank_arr['branch'] = $post->branch_name;
        $bank_arr['is_active'] = 1;
        $bank_arr['is_deleted'] = 0;

        if($post->bank_id >0){
            $bank_arr['updated_at'] = date('Y-m-d H:i:s');
           SellerBank::where('seller_id',$post->seller_id)->update($bank_arr);
           return      back()->with('success','Seller bank updated successfully! ');
        }else {
            $bank_arr['created_at'] = date('Y-m-d H:i:s');
        $bank_arr['updated_at'] = date('Y-m-d H:i:s');
        $insId      =   SellerBank::create($bank_arr)->id;
        return      back()->with('success','Seller bank created successfully! ');
        }
       
    }
    
    function searchStoreSellerIds($keywords,$field){
        $query              =   Store::where($field, 'LIKE', '%'.$keywords.'%')->where('is_deleted',0); $sellerIds = [0];
        if($query->count()  >   0)  {   foreach($query->get() as $row){ $sellerIds[]    =   $row->seller_id; }}return $sellerIds; 
    }
    
    function searchTelecomSellerIds($keywords){
        $query              =   SellerTelecom::where('value', 'LIKE', '%'.$keywords.'%'); $sellerIds = [0];
        if($query->count()  >   0)  {   foreach($query->get() as $row){ $sellerIds[]    =   $row->seller_id; }}return $sellerIds; 
    }
}
