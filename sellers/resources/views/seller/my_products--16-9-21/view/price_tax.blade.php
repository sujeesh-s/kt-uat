<div class="tab-pane" id="tab2">
    <div class="card-header mb-4"><div class="card-title">Price & Tax</div></div>
    <div class="col-lg-6 fl">
        <div class="form-group">
        
            <label class="form-label view" for="fname">Price: </label>
            <p class="view_value">{{ $price->price; }} </p>
        </div>
    </div>
    <div class="col-lg-6 fl">
        <div class="form-group">
            
             <label class="form-label view" for="fname">Sale Price: </label>
            <p class="view_value">{{ $price->sale_price; }} </p>
        </div>
    </div> 
    <div class="col-lg-6 fl">
        <div class="form-group">
         
             <label class="form-label view" for="fname">Sale From Date: </label>
            <p class="view_value"> {{date('d M Y',strtotime($price->sale_start_date))}}  </p>
        </div>
    </div> 
    <div class="col-lg-6 fl">
        <div class="form-group">
           
            <label class="form-label view" for="fname">Sale To Date: </label>
            <p class="view_value"> {{date('d M Y',strtotime($price->sale_end_date))}}  </p>
        </div>
    </div> 
    <div class="col-lg-6 fl">
        <div class="form-group">
         
             <label class="form-label view" for="fname">Tax: </label>

            <p class="view_value">  @foreach ($taxes as $tx_id=>$tx_name)
            <?php if($product->tax_id==$tx_id){ echo $tx_name ;}?> 
            @endforeach
            </p>
        </div>
    </div>
</div>
                        