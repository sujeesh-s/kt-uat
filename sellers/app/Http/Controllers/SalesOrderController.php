<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\SalesOrder;
use App\Models\Tax;
use App\Models\Language;
use App\Models\Customer;
use App\Models\CustomerInfo;
use App\Models\SalesOrderAddress;
use App\Models\SalesOrderPayment;
use App\Models\SalesOrderCancel;
use App\Models\SalesOrderCancelNote;
use App\Models\SalesOrderStatusHistory;
use App\Models\Email;

use Validator;

class SalesOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:seller');
    }
    public function orders(Request $request,$type=''){ // echo Auth::user()->id; die;
        $post                       =   (object)$request->post();
        if(isset($post->viewType))  {   $viewType = $post->viewType; }else{ $viewType = ''; }
        $data['title']              =   'Sales Orders';
        $data['menuGroup']          =   'salesGroup';
        $data['menu']               =   'sales_request';
        $data['start_date']         =   '';
        $data['end_date']           =   '';
        $orders                     =   SalesOrder::where('seller_id',auth()->user()->id);
        if($type == 'request')      {   $orders = $orders->where('order_status','pending'); }
        if(isset($post->start_date) &&  $post->start_date != ''){ 
            $orders                 =   $orders->whereDate('created_at','>=',$post->start_date); 
            $data['start_date']     =   $post->start_date;
        }
        if(isset($post->end_date)   &&  $post->end_date != ''){ 
            $orders                 =   $orders->whereDate('created_at','<=',$post->end_date); 
            $data['end_date']       =   $post->end_date;
        }
        $data['orders']             =   $orders->orderBy('id','desc')->get();
        if($type == 'request'){   
            if($viewType == 'ajax') {   return view('sales.order_request.list.content',$data); }else{ return view('sales.order_request.page',$data); }        
        }else{ if($viewType         ==  'ajax') {   return view('sales.order.list.content',$data); }else{ return view('sales.order.page',$data); } }
    }
    
    function cancelOrders(Request $request,$type=''){
        $post                       =   (object)$request->post();
        if(isset($post->viewType))  {   $viewType = $post->viewType; }else{ $viewType = ''; }
        $data['title']              =   'Cancel Orders';
        $data['menuGroup']          =   'salesGroup';
        $data['menu']               =   'cancel_order';
        $data['type']               =   $type;
        $orders                     =   SalesOrderCancel::where('seller_id',auth()->user()->id)->where('is_deleted',0);
        if($type == 'request')      {   $orders =   $orders->where('status','pending'); }
        else if($type == 'past')    {   $orders =   $orders->where('status','!=','pending'); }
        if(isset($post->start_date) &&  $post->start_date != ''){ 
            $orders                 =   $orders->whereDate('created_at','>=',$post->start_date); 
            $data['start_date']     =   $post->start_date;
        }
        if(isset($post->end_date)   &&  $post->end_date != ''){ 
            $orders                 =   $orders->whereDate('created_at','<=',$post->end_date); 
            $data['end_date']       =   $post->end_date;
        }
        $data['orders']             =   $orders->orderBy('id','desc')->get();
    //    echo '<pre>'; print_r($post); echo '</pre>'; die;
        if($viewType == 'ajax')     {   return view('sales.cancel_order.list.content',$data); }      
        return view('sales.cancel_order.page',$data); 
    }
    
    function order(Request $request, $id=0,$type=''){
        $post                       =   (object)$request->post();
        $data['title']              =   'Sales Orders';
        $data['menuGroup']          =   'salesGroup';
        $data['menu']               =   'sales_order';
        $data['order']              =   SalesOrder::where('id',$id)->where('seller_id',auth()->user()->id)->first();
        if($type == 'request')      {   return view('sales.order_request.view',$data); }
    }
    
    function invoice(Request $request, $id=0){
        $post                       =   (object)$request->post();
        $data['title']              =   'Sales Orders';
        $data['menuGroup']          =   'salesGroup';
        $data['menu']               =   'sales_order';
        $data['order']              =   SalesOrder::where('id',$id)->where('seller_id',auth()->user()->id)->first();
        return view('sales.order.invoice',$data);
    }
    
    function cancelOrder(Request $request,$id='',$type=''){
        $post                       =   (object)$request->post();
        $data['title']              =   'Cancel Order Detail';
        $data['menuGroup']          =   'salesGroup';
        $data['menu']               =   'cancel_detail';
        $data['res']                =   SalesOrderCancel::where('seller_id',auth()->user()->id)->where('id',$id)->first();
      //  if($type == 'request')      {   return view('sales.cancel_order.page',$data); }
        return view('sales.cancel_order.view',$data); 
    }
    
    function updateStatus(Request $request){
        $post                       =   (object)$request->post(); // echo '<pre>'; print_r($post); echo '</pre>'; die;
        if($post->model             ==  'order_cancels'){
            $update                 =   SalesOrderCancel::where('id',$post->id)->update([$post->field => $post->value]);
            $cancelRec              =   SalesOrderCancel::where('id',$post->id)->first(); $salesId = $cancelRec->sales_id;
            if($post->value         ==  'accepted'){ $cnl = ['order_status'=>'cancelled','cancel_process' => 2]; }
            else if($post->value    ==  'rejected'){ $cnl['cancel_process'] = 3; $this->addCancelResponse($post->id,$post->reply); }
            $update                 =   SalesOrder::where('id',$cancelRec->sales_id)->update($cnl);
            $orders                 =   SalesOrderCancel::where('seller_id',auth()->user()->id);
        }else{ 
            $update                 =   SalesOrder::where('id',$post->id)->update([$post->field => $post->value]);
            $cInsId                 =   SalesOrderCancel::create(['sales_id'=>$post->id,'seller_id'=>auth()->user()->id,'created_by'=>auth()->user()->id,'role_id'=>auth()->user()->role_id])->id;
                                        $this->addCancelNote($cInsId,$post->title,$post->desc);
            $orders                 =   SalesOrder::where('seller_id',auth()->user()->id); $salesId = $post->id;
        }
        $stHistory                  =   ['sales_id'=>$salesId,'status'=>$post->value,'created_by'=>auth()->user()->id,'role_id'=>auth()->user()->role_id];
        $stHistory['description']   =   $post->desc;    SalesOrderStatusHistory::create($stHistory);
        if($post->type              ==  'request'){ $orders = $orders->where($post->field,'pending'); }
        if($post->type              ==  'past'){    $orders = $orders->where($post->field,'!=','pending'); }
        if(isset($post->start_date) &&  $post->start_date != ''){ 
            $orders                 =   $orders->whereDate('created_at','>=',$post->start_date); 
            $data['start_date']     =   $post->start_date;
        }
        if(isset($post->end_date)   &&  $post->end_date != ''){ 
            $orders                 =   $orders->whereDate('created_at','<=',$post->end_date); 
            $data['end_date']       =   $post->end_date;
        }
        $data['type']               =   $post->type;
        $data['orders']             =   $orders->orderBy('id','desc')->get();
        return view($post->page.'.list.content',$data);
    }
    
    function addCancelNote($cId,$title,$note){
        SalesOrderCancelNote::create(['cancel_id'=>$cId,'title'=>$title,'note'=>$note,'created_by'=>auth()->user()->id,'role_id'=>auth()->user()->role_id]);
    }
    
    function addCancelResponse($cancelId,$response){
        SalesOrderCancelNote::create(['cancel_id'=>$cancelId,'created_by'=>auth()->user()->id,'role_id'=>auth()->user()->role_id,'response'=>$response]);
    }
    
    function orderStatusEmail(Request $request){
        $post                       =   (object)$request->post();
        $sales                      =   SalesOrder::where('id',$post->id)->first();
        $msg = '<h4>Hi, ' . $sales->address->name . ' </h4>';
        $msg .= '<p>You order has been '.$sales->order_status. ' by Seller</p>';
        $msg .= '<p>Order ID : <span>'.$sales->order_id.'</span></p><p>Order Date : <span>'.date('d M Y',strtotime($sales->created_at)).'</span</p>';
        Email::sendEmail(geAdminEmail(), $sales->address->email, '#'.$sales->order_id.' :: Order '.$sales->order_status, $msg);
    }
}