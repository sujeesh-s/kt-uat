
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title mb-0">{{$title}}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fe fe-grid mr-2 fs-14"></i>Seller Management</a></li>
            <li class="breadcrumb-item" aria-current="page"><a id="bc_list" href="">Stock List</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">{{$title}}</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body pb-2">
                {{ Form::open(array('url' => "admin/seller/product-stock/save", 'id' => 'adminForm', 'name' => 'adminForm', 'class' => '','files'=>'true')) }}

                    <div class="tabs-menu mb-4">
<!--                        <ul class="nav panel-tabs">
                            <li><a href="#tab1" class="active" data-toggle="tab" id="nav_tab_1"><span>Attribute Details</span></a></li>
                            <li><a href="#tab2" data-toggle="tab" id="nav_tab_2"><span>Title Labels</span></a></li
                       </ul>-->
                    </div>
                    <div class="row panel-body tabs-menu-body">
                        <div class="tab-content col-12">
                            <div class="tab-pane active " id="tab1">
                                <div class="col-lg-6 fl">
                                    <div class="form-group">
                                        {{Form::label('name','Product Name',['class'=>''])}}
                                        {{Form::text('attr[name]',$product->name,['id'=>'name','class'=>'form-control','disabled'=>true])}}
                                        {{Form::hidden('stock[prd_id]',$product->id,['id'=>'prd_id'])}} {{Form::hidden('stock[seller_id]',$seller->seller_id,['id'=>'seller_id'])}} 
                                        <span class="error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 fl">
                                    <div class="form-group">
                                        {{Form::label('seller','Seller Name',['class'=>''])}}
                                        {{Form::text('attr[seller]',$seller->fname,['id'=>'seller','class'=>'form-control','disabled'=>true])}}
                                        <span class="error"></span>
                                    </div>
                                </div>
                                <div id="" class="col-lg-4 fl">
                                    <div class="form-group">
                                        {{Form::label('rate','Price',['class'=>''])}}
                                        {{Form::text('stock[rate]',$price->price,['id'=>'rate', 'class'=>'form-control','readonly'=>true])}}
                                        <span class="error"></span>
                                    </div>
                                </div><div id="" class="col-lg-4 fl">
                                    <div class="form-group">
                                        {{Form::label('qty','Quantity',['class'=>''])}}
                                        {{Form::text('stock[qty]','',['id'=>'qty', 'class'=>'form-control numberonly','placeholder'=>'Quantity'])}}
                                        <span id="qty_error" class="error"></span>
                                    </div>
                                </div>
                                <div class="col-lg-4 fl">
                                    <div class="form-group">
                                        {{Form::label('amount','Amount',['class'=>''])}} {{Form::hidden('stock[type]','add',['id'=>'add'])}}
                                        {{Form::text('amount',0,['id'=>'amount', 'class'=>'form-control','readonly'=>true])}}
                                        <span class="error"></span>
                                    </div>
                                </div>
                                <div id="" class="col-12 fl">
                                    <div class="form-group">
                                        {{Form::label('desc','Description',['class'=>''])}} {{Form::hidden('stock[created_by]',auth()->user()->id,['id'=>'created_by'])}}
                                        {{Form::textarea('stock[desc]','',['id'=>'desc', 'class'=>'form-control','placeholder'=>'Description','rows'=>2])}}
                                        <span class="error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                    <div class="card-footer text-right">
                            {{Form::hidden('can_submit',0,['id'=>'can_submit'])}}{{Form::hidden('page','stock',['id'=>'stock'])}}
                            <button id="cancel_btn" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button id="save_btn" type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
               {{Form::close()}}
            </div>
        </div>
    </div>
</div>
