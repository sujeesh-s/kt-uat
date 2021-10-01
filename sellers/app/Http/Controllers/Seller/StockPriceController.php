<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Intervention\Image\Facades\Image;

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

use DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

use Validator;
use Session;

class StockPriceController extends Controller{
     public function __construct()
    {
        $this->middleware('auth:seller');
    }
    public function stock_price()
    { 

        $data['title']              =   'Stock/Price';
        $data['menu']               =   'stock-price';
        
        $data['products']           =   Product::where("seller_id",auth()->user()->id)->where('is_deleted',0)->orderBy('id','desc')->get();
        $data['sellerinfo']= SellerInfo::where('is_approved',1)->where("seller_id",auth()->user()->id)->where('is_deleted',0)->first();

        
        // dd($data);
        return view('seller.stock_price.list',$data);
    }

        public function stockPriceLog($prd_id)
    { 

        $data['title']              =   'Stock/Price Logs';
        $data['menu']               =   'stock-price';
        
        $data['products']           =   Product::where("seller_id",auth()->user()->id)->where('id',$prd_id)->where('is_deleted',0)->first();
        $data['stock_log']           = PrdStock::where('prd_id',$prd_id)->orderBy('id','desc')->get(); 
        $data['price_log']           = PrdPrice::where('prd_id',$prd_id)->orderBy('id','desc')->get(); 
        $data['prd_id']           = $prd_id;
         
        // dd($data);
        return view('seller.stock_price.tabs',$data);
    }
    
   

      function saveStock(Request $request){
        $post                       =  (object) $request->post();
     // dd($post);
     $stock_arr = array();
     $stock_arr['seller_id'] = auth()->user()->id;
     $stock_arr['prd_id'] = $post->id;
     $stock_arr['type'] = 'add';
     $stock_arr['qty'] = $post->quantity;
     $stock_arr['rate'] = $post->quantity;
     $stock_arr['created_by'] = auth()->user()->id;

        $insId                      =   PrdStock::create($stock_arr)->id;
        if($insId){ $type           =   'success'; $msg = 'Stock added successfully!'; }
        else{ $type = 'error';          $msg = 'Somthing went wrong. Please try after some time'; }
        return back()->with($type,$msg);
    }

     function savePrice(Request $request){
        $post                       =  (object) $request->post();
     // dd($post);
     $price_arr = array();
     $price_arr['seller_id'] = auth()->user()->id;
     $price_arr['prd_id'] = $post->id;
     $price_arr['price'] = $post->price;
     $price_arr['sale_price'] = $post->sale_price;
     $price_arr['sale_start_date'] = $post->valid_from;
     $price_arr['sale_end_date'] = $post->valid_to;
     $price_arr['created_by'] = auth()->user()->id;

        $insId                      =   PrdPrice::create($price_arr)->id;
        if($insId){ $type           =   'success'; $msg = 'Price added successfully!'; }
        else{ $type = 'error';          $msg = 'Somthing went wrong. Please try after some time'; }
        return back()->with($type,$msg);
    }

    
}
