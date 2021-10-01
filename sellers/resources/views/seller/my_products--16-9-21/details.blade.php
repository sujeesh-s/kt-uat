<?php  //  echo '<pre>'; print_r($product); echo '</pre>';  die;
if($product){ 
    $prices         =   $product->prdPrice;         $prdAssAttrs    =   $product->assignedAttrs($product->id); // echo '<pre>'; print_r($prices); echo '</pre>';
    $id             =   $product->id;               $sellerId       =   $product->seller_id;        $prdType        =       $product->product_type;
    $catId          =   $product->category_id;      $subCatId       =   $product->sub_category_id;  $brandId        =       $product->brand_id;
    $commi          =   $product->commission;       $approved       =   $product->is_approved;      $apprDate       =       $product->approved_at;
    $status         =   $product->is_active;        $taxId          =   $product->tax->id;           $price          =       $prices->price;
    $adminPrd       =   $product->admin_prd_id;     $sPrice         =   $prices->sale_price;        $stDate         =       $prices->sale_start_date;
    $edDate         =   $prices->sale_end_date;     
    $prdName        =   getContent($product->name_cnt_id,$langId);      $sDesc              =       getContent($product->short_desc_cnt_id,$langId);
    $desc           =   getContent($product->desc_cnt_id,$langId);      $content            =       getContent($product->content_cnt_id,$langId);
     if(isset($product->spec_cnt_id)) { $specification            =       getContent($product->spec_cnt_id,$langId);  }else { $specification = '';   } 
    
    $featured         =   $product->is_featured; $daily_deals         =   $product->daily_deals; 
    if($adminPrd    >   0){ $sellCkd = false; $adminCkd = true; }else{  $sellCkd = true; $adminCkd  =   false; }
}else{ 
    $adminPrd = $id =   0; $commi = $prdType = $prdName = $catId = $subCatId = $brandId = $sDesc = $desc = $content = $price = $sPrice = $taxId = $stDate = $edDate = $specification = ''; 
    $status         =   1;  $featured   = $daily_deals      = 0; $sellerId = $seller->seller_id; $sellCkd = true; $adminCkd = false; $prdAssAttrs = []; $id = 0;
}
if($prdType == 2)   {   $conficLi = ''; }else{ $conficLi = 'no-disp'; }
?>  <?php // echo '<pre>'; print_r($catIds); echo '</pre>'; ?>
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title mb-0">{{$title}}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fe fe-grid mr-2 fs-14"></i>Seller Management</a></li>
            <li class="breadcrumb-item"><a href="#" id="bc_list"><i class="fe fe-grid mr-2 fs-14"></i>Product List</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">{{$title}}</a></li>
        </ol>
    </div>
</div>
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body pb-2">
            {{ Form::open(array('url' => "product/save", 'id' => 'adminForm', 'name' => 'adminForm', 'class' => '','files'=>'true')) }}
                 {{Form::hidden('id',$id,['id'=>'id'])}} 

                <div class="tabs-menu mb-4">
                    <ul class="nav panel-tabs">
                        <li><a href="#tab1" data-toggle="tab" id="nav_tab_1" class="active"><span>General Info.</span></a></li>
                        <li><a href="#tab2" data-toggle="tab" id="nav_tab_2"><span>Price & Tax</span></a></li>
                        <li><a href="#tab3" data-toggle="tab" id="nav_tab_3"><span>Images</span></a></li>
                        <li><a href="#tab4" data-toggle="tab" id="nav_tab_4"><span>Attributes</span></a></li>
                        <li><a href="#tab5" data-toggle="tab" id="nav_tab_5" class="{{$conficLi}}"><span>Associative Products</span></a></li>
                   </ul>
                </div>
                <div class="row panel-body tabs-menu-body">
                    <div class="tab-content col-12">
                        <div class="tab-pane active " id="tab1">@include('seller.my_products.details.general')</div>
                        <div class="tab-pane" id="tab2">@include('seller.my_products.details.price_tax')</div>
                        <div class="tab-pane" id="tab3">@include('seller.my_products.details.image')</div>
                        <div class="tab-pane attr" id="tab4">@include('seller.my_products.details.attribute')</div>
                        <div class="tab-pane asso" id="tab5">@if($prdType == 2 && $id > 0) @include('seller.my_products.details.associative_prds') @endif</div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card-footer text-right">
                        {{Form::hidden('can_submit',0,['id'=>'can_submit'])}}
                        <button id="cancel_btn" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button id="save_btn" type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
           {{Form::close()}}
        </div>
    </div>
</div>
<!-- INTERNAL WYSIWYG Editor js -->
<script src="{{URL::asset('admin/assets/js/form-editor.js')}}"></script>
		

