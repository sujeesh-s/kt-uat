<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;
use App\Models\Modules;
use App\Models\UserRoles;
use App\Models\Admin;
use App\Models\UserRole;
use App\Models\SaleOrder;
use App\Models\SaleorderItems;
use App\Models\SellerInfo;
use App\Models\Seller;
use App\Models\SellerTelecom;
use App\Models\SellerAddress;
use App\Models\customer\CustomerMaster;
use App\Models\customer\CustomerInfo;
use App\Models\customer\CustomerSecurity;
use App\Models\customer\CustomerTelecom;
use App\Rules\Name;
use Validator;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:seller');
    }


    public function index()
    {
        $data['title']              =   'Customer';
        $data['menu']               =   'Customer List';
        $data['role']               =    UserRole::where('is_deleted',NULL)->orWhere('is_deleted',0)->where('usr_role_name','Customer')->where('is_active',1)->get();
        $data['customer']           =    CustomerMaster::where('is_deleted',0)->whereIn('id',function($query) {
   $query->select('cust_id')->from('sales_orders')->where("seller_id",auth()->user()->id);})->get();
        // dd($data);
        
        return view('seller.customer.customer_list', $data);
    }

  

    public function view_customer($user_id)
    {
        $data['title']              =   'Customer Info';
        $data['menu']               =   'Customer Details';
        $data['role']               =    UserRole::where('is_deleted',NULL)->orWhere('is_deleted',0)->where('usr_role_name','Customer')->where('is_active',1)->get();
        $data['customer_mst']       =    CustomerMaster::where('is_deleted',0)->where('id',$user_id)->first();
        $data['telecom']            =    CustomerTelecom::where('user_id',$user_id)->where('is_active',1)->where('is_deleted',0)->get();
        $data['info']               =    CustomerInfo::where('user_id',$user_id)->where('is_active',1)->where('is_deleted',0)->first();
        $data['wallet']             =    DB::table("usr_cust_wallet")->select(DB::raw("SUM(credit)-SUM(debit) as wallet"))->where("is_deleted",0)->where("user_id",$user_id)->first();
        $data['order']              =    SaleOrder::where('cust_id',$user_id)->where("seller_id",auth()->user()->id)->where("order_status",'!=','cancelled')->get();
        $data['order_hist']              =    SaleOrder::where('cust_id',$user_id)->where("seller_id",auth()->user()->id)->get();
        $data['cancelled_order']              =    SaleOrder::where('cust_id',$user_id)->where("seller_id",auth()->user()->id)->where("order_status",'cancelled')->get();
        $data['refunded_order']              =    SaleOrder::where('cust_id',$user_id)->where("seller_id",auth()->user()->id)->where("order_status",'cancelled')->where("payment_status",'refunded')->get();
        return view('seller.customer.view_customer', $data);
    }

        public function invoice($id)
    {
        $data['title']              =   'Invoice';
        $data['menu']               =   'Invoice';
        $data['order']              =    SaleOrder::where('id',$id)->first();
        $user_id = $data['order']->cust_id; 
        $data['user_id']               =   $user_id;
        
        $data['customer_mst']       =    CustomerMaster::where('is_deleted',0)->where('id',$user_id)->first();
        $data['telecom']            =    CustomerTelecom::where('user_id',$user_id)->where('is_active',1)->where('is_deleted',0)->get();
        $data['info']               =    CustomerInfo::where('user_id',$user_id)->where('is_active',1)->where('is_deleted',0)->first();
        $data['wallet']             =    DB::table("usr_cust_wallet")->select(DB::raw("SUM(credit)-SUM(debit) as wallet"))->where("is_deleted",0)->where("user_id",$user_id)->first();
        
       $data['seller_address']  = SellerAddress::where('seller_id',auth()->user()->id)->where('is_deleted',0)->first();
       if($data['seller_address']) {
        $data['seller_address_city']  = getCities($data['seller_address']->city_id);
       }
        $data['order_items']             = SaleorderItems::where('sales_id',$id)->get();
       
       // dd($data);
        return view('seller.customer.invoice', $data);
    }

  

}
