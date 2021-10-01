<div class="card-header mb-4"><div class="card-title">Product Info</div></div>
<div class="col-lg-6  col-lg-offset-6">
        <div class="form-group">
            {{Form::label('prd_type','Product Type',['class'=>''])}} <span class="text-red">*</span>
            {{Form::select('prd_type',$prdTypes,$prdType,['id'=>'prd_type','class'=>'form-control'])}}
            <span class="error"></span>
        </div>
    </div>

 <?php if($prdType !="") { if($prdType ==1) { $simple_prod = "display:block;"; $var_prod = "display:none;"; }else {  $simple_prod = "display:none;"; $var_prod = "display:block;"; } }else { $simple_prod = "display:block;"; $var_prod = "display:none;"; }  ?>

     <div class="row panel-body tabs-menu-body simple_prod" style="<?php echo $simple_prod; ?>">     
        <div class="tab-content col-12">
     <div class="card-header mb-4"><div class="card-title">Price & Tax</div></div>       
     <div class="clearfix"></div>   
    <div class="col-lg-6 fl">
        <div class="form-group">
            {{Form::label('price','Price',['class'=>''])}}
            {{Form::text('price[price]',$price,['id'=>'price', 'class'=>'form-control','placeholder'=>'price'])}}
            <span class="error"></span>
        </div>
    </div>
    <div class="col-lg-6 fl">
        <div class="form-group">
            {{Form::label('sale_price','Sale Price',['class'=>''])}}
            {{Form::text('price[sale_price]',$sPrice,['id'=>'sale_price','class'=>'form-control chosen-select','placeholder'=>'Sale Price'])}}
            <span class="error"></span>
        </div>
    </div> 
    <div class="col-lg-6 fl">
        <div class="form-group">
            {{Form::label('sale_start_date','Sale From Date',['class'=>''])}}
            {{Form::date('price[sale_start_date]',$stDate,['id'=>'sale_start_date','class'=>'form-control','placeholder'=>'Start Date'])}}
            <span class="error"></span>
        </div>
    </div> 
    <div class="col-lg-6 fl">
        <div class="form-group">
            {{Form::label('sale_end_date','Sale To Date',['class'=>''])}}
            {{Form::date('price[sale_end_date]',$edDate,['id'=>'sale_end_date','class'=>'form-control','placeholder'=>'End Date'])}}
            <span class="error"></span>
        </div>
    </div> 
    <div class="col-lg-6 fl">
        <div class="form-group">
            {{Form::label('tax','Tax',['class'=>''])}}
            {{Form::select('price[tax]',$taxes,$taxId,['id'=>'tax','class'=>'form-control','placeholder'=>'Select Tax'])}}
            <span class="error"></span>
        </div>
    </div>
</div>
</div>
                <div class="row panel-body tabs-menu-body variable_prod" style="<?php echo $var_prod; ?>">
                <div class="tab-content col-12">
                <div class="tab-pane active " id="tab1">
                <div class="card-header mb-4"><div class="card-title">Attribute Details</div></div>
                <div class="row">
                        <div class="col-lg-7 col-lg-pull-5 fl prod_attr_1 tabs-menu-body">

                            <div>
                                <div class="form-group">
                                {{Form::label('attr_name','Attribute Name',['class'=>''])}} 
                                {{Form::text('attr_1[attr_name]',$attr_1_name,['id'=>'attr_name_1','class'=>'form-control attr_name','placeholder'=>'Attribute Name'])}}
                                <span class="error fl" id="attribute_1_name"></span>
                                </div>
                        
                                <div class="clr"></div>

                                    <div id="attr-val-content-1" > 

                                         <?php if($attr_1_value !=""){ $ar1_id = 0; foreach ($attr_1_value as $att1_k => $att1_v) {
                                            
                                        ?>  

                                            <div id="attr-val-row-<?php echo $ar1_id; ?>" class="attr_val_row_id">
                                            <div class="col-lg-11 tofix mb-2 fl">

                                            <div class="mb-1">
                                                {{form::label('attr_val_id','Options',['class'=>'m-0'])}}
                                                {{Form::text("attr_1_value[$att1_k][]",$att1_v[0],['id'=>'attr_val_id','class'=>'form-control attr_value required','placeholder'=>'Enter Variation Options, eg: Red, etc.','data-val'=>"$att1_k"])}}
                                            <span class="error"></span>
                                            </div>


                                            </div>
                                            <div class="col-1 pl-0 mb-2 fl">
                                            <div class="clr"></div>
                                            <a id="del_val_<?php echo $ar1_id; ?>" class="del_val del"><i class="fa fa-trash"></I></a>
                                            </div>
                                            <div class="clr"></div>
                                            </div>
                                        <?php  ++$ar1_id; } }else { $ar1_id = 0;  ?>

                                            <div class="col-lg-11 mb-2 fl tofix">
                                           
                                                    <div class=" mb-1">

                                                    {{form::label('attr_val_id','Options',['class'=>'m-0'])}}
                                                    {{Form::text("attr_1_value[attr1_$ar1_id][]","",['id'=>'attr_val_id','class'=>'form-control attr_value required','placeholder'=>'Enter Variation Options, eg: Red, etc.','data-val'=>"attr1_$ar1_id"])}}
                                                    <span class="error"></span>
                                                    </div>

                                            </div>
                                  
                                            <div class="col-1 pl-0 mb-2 fl">
                                            <div class="clr"></div>
                                            <a id="del_val_id" class="del_val del"><i class="fa fa-trash"></I></a>
                                            </div>
                                            <div class="clr"></div>

                                           <?php } ?>

                                    </div>  
                                    <div class="clr"></div>
                                    <div class="col-12 text-right">
                                    <button id="add_val" class="mt-4 mb-4 btn btn-info btn-sm" <?php if($ar1_id>4){ ?> style="display: none;" <?php } ?> type="button"><i class="fa fa-plus mr-1"></i>Add</button>
                                    <div class="clr"></div>
                                    <span class="error fl" id="attribute_1_value"></span>
                                    </div>
                                </div>
                        </div>
                       <div class="col-lg-7 col-lg-pull-5 fl prod_attr_2 tabs-menu-body">
                                <a  class="btn btn-outline-primary variation " <?php if($attr_2_name !=""){ echo 'style="display:none;"'; }else { echo 'style="display:block;"'; } ?>><i class="fa fa-plus mr-2"></i>Add Attribute</a>

                            <div class="attr_content" <?php if($attr_2_name !=""){ echo 'style="display:block;"'; }else { echo 'style="display:none;"'; } ?>>
                                <a id="delete_existing"  class="delete_existing"><i class="ion-close-circled"></I></a>
                                <div class="form-group">
                                {{Form::label('attr_name','Attribute Name',['class'=>''])}} 
                                {{Form::text('attr_2[attr_name]',$attr_2_name,['id'=>'attr_name_2','class'=>'form-control attr_name','placeholder'=>'Attribute Name'])}}
                                <span class="error fl" id="attribute_2_name"></span>
                                </div>
                        
                                <div class="clr"></div>

                                    <div id="attr-val-content-2" > 

                                         <?php if($attr_2_value !=""){ $ar2_id = 0; foreach ($attr_2_value as $att2_k => $att2_v) {
                                            
                                        ?>  

                                            <div id="attr-val-row-<?php echo $ar2_id; ?>" class="attr_val_row_id">
                                            <div class="col-lg-11 tofix mb-2 fl">

                                            <div class="mb-1">
                                                {{form::label('attr_val_id','Options',['class'=>'m-0'])}}
                                                {{Form::text("attr_2_value[$att2_k][]",$att2_v[0],['id'=>'attr_val_id','class'=>'form-control attr_value required','placeholder'=>'Enter Variation Options, eg: Red, etc.','data-val'=>"$att2_k"])}}
                                            <span class="error"></span>
                                            </div>


                                            </div>
                                            <div class="col-1 pl-0 mb-2 fl">
                                            <div class="clr"></div>
                                            <a id="del_val_<?php echo $ar2_id; ?>" class="del_val del"><i class="fa fa-trash"></I></a>
                                            </div>
                                            <div class="clr"></div>
                                            </div>
                                        <?php  ++$ar2_id; } }else { $ar2_id = 0; ?>


                                             <div class="col-lg-11 mb-2 fl tofix">
                                           
                                                    <div class=" mb-1">

                                                    {{form::label('attr_val_id','Options',['class'=>'m-0'])}}
                                                    {{Form::text("attr_2_value[attr2_$ar2_id][]","",['id'=>'attr_val_id','class'=>'form-control attr_value required','placeholder'=>'Enter Variation Options, eg: Red, etc.','data-val'=>"attr2_$ar2_id"])}}
                                                    <span class="error"></span>
                                                    </div>

                                            </div>
                                  
                                            <div class="col-1 pl-0 mb-2 fl">
                                            <div class="clr"></div>
                                            <a id="del_val_id" class="del_val del"><i class="fa fa-trash"></I></a>
                                            </div>
                                            <div class="clr"></div>

                                        <?php } ?>

                                    </div>  
                                    <div class="clr"></div>
                                    <div class="col-12 text-right">
                                    <button id="add_var_2" class="mt-4 mb-4 btn btn-info btn-sm" <?php if($ar2_id>4){ ?> style="display: none;" <?php } ?> type="button"><i class="fa fa-plus mr-1"></i>Add</button>
                                    <div class="clr"></div>
                                    <span class="error fl" id="attribute_2_value"></span>
                                    </div>
                                </div>
                        </div>
            
                        </div>    <!--  row ends -->
                     </div> <!--  tab1 ends -->


                </div><!--  tab content ends -->
                </div>   <!--  panel body ends -->       


<div id="adnl_rows" class="d-none">
    <div id="attr_val_row_id" class="attr_val_row_id">
                <div class="col-lg-11 tofix mb-2 fl">
                   
                        <div class="mb-1">
                            {{form::label('attr_val_id','Options',['class'=>'m-0'])}}
                            {{Form::text('value[val][]','',['id'=>'attr_val_id','class'=>'form-control attr_value required','placeholder'=>'Enter Variation Options, eg: Red, etc.','data-val'=>'attr1_0'])}}
                            <span class="error"></span>
                        </div>
                 
                   
                </div>
                <div class="col-1 pl-0 mb-2 fl">
                    <div class="clr"></div>
                    <a id="del_val_id" class="del_val del"><i class="fa fa-trash"></I></a>
                </div>
                <div class="clr"></div>
    </div>
</div>     

<table class="variation_table_hid table" id="hidden_table" style="display: none;">
</table>

<div class="row panel-body tabs-menu-body variable_prod" style="<?php echo $var_prod; ?>">
                <div class="tab-content col-12">
                <div class="tab-pane active " id="tab1">
                <div class="card-header mb-4"><div class="card-title">Variation List</div></div>
                <div class="row">

                     <div class="variation_table_div table-responsive tabs-menu-body">


                        <table class="variation_table table" id="variation_table">
                            <thead>
                                <tr>
                                    <?php if($attr_1_name !=""){ ?> <th class="text-center init_name"><?php echo $attr_1_name; ?></th> <?php }else { ?> 
                                     <th class="text-center init_name">Name</th>
                                 <?php } ?>
                                 <?php if($attr_2_name !=""){ ?> <th class="text-center init_name"><?php echo $attr_2_name; ?></th> <?php } ?>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Stock</th>
                                    <th class="text-center">SKU</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  


               if(isset($attr_stock) && $attr_stock !=""  )
                {


                foreach($attr_stock as $dyk=>$dyv){
              
                if(is_array($dyv)) {
                    $at_2 = 0;
                    foreach($dyv as $dyk2=>$dyv2){
                         $at_2++;
                     
                    ?>

                   <tr>
                   <?php if($at_2 ==1){ ?> <td class="text-center init_value" rowspan="<?php echo count($dyv) ?>"><input class="form-control" placeholder="Option" value="<?php echo $attr_1_value->$dyk[0]; ?>" readonly="true" type="text"></td> <?php } ?>
                    <td class="text-center"><input class="form-control" placeholder="Option" value="<?php echo $attr_2_value->$dyk2[0]; ?>" type="text"></td>
                    <td class="text-center"><input class="form-control price_field" name="price[<?php echo $dyk; ?>][<?php echo $dyk2; ?>]" placeholder="Price" value="<?php echo $attr_price[$dyk][$dyk2]; ?>" type="text"></td>
                    <td class="text-center"><input class="form-control stock_field" name="stock[<?php echo $dyk; ?>][<?php echo $dyk2; ?>]" placeholder="Stock" value="<?php echo $attr_stock[$dyk][$dyk2]; ?>" type="text"></td>
                    <td class="text-center"><input class="form-control sku_field" name="sku[<?php echo $dyk; ?>][<?php echo $dyk2; ?>]" placeholder="SKU" value="<?php echo $attr_sku[$dyk][$dyk2]; ?>" type="text"></td>
                    </tr>

              <?php } }else { ?>
                    <tr>
                     <td class="text-center init_value" ><input class="form-control" placeholder="Option" value="<?php echo $attr_1_value->$dyk[0]; ?>" readonly="true" type="text"></td> 
                    
                    <td class="text-center"><input class="form-control" placeholder="Price" name="price[<?php echo $dyk; ?>]" value="<?php echo $attr_price[$dyk]; ?>" type="text"></td>
                    <td class="text-center"><input class="form-control" placeholder="Stock" name="stock[<?php echo $dyk; ?>]" value="<?php echo $attr_stock[$dyk]; ?>" type="text"></td>
                    <td class="text-center"><input class="form-control" placeholder="SKU" name="sku[<?php echo $dyk; ?>]" value="<?php echo $attr_sku[$dyk]; ?>" type="text"></td>
                    </tr>

                <?php }
                }
                }else { ?>

                                <tr>
                                    <td class="text-center init_value"><input class="form-control" placeholder="Option" readonly="true" type="text"></td>
                                    <td class="text-center"><input class="form-control" placeholder="Price" type="text"></td>
                                    <td class="text-center"><input class="form-control" placeholder="Stock" type="text"></td>
                                    <td class="text-center"><input class="form-control" placeholder="SKU" type="text"></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                            
                        </table>

                    </div>
                        
                        </div>    <!--  row ends -->
                     </div> <!--  tab1 ends -->


                </div><!--  tab content ends -->
                </div>   <!--  panel body ends -->              

<style type="text/css">
    .prod_attr_2 .attr_content{
        margin-top: 20px;
    }
    .prod_attr_2 {
          margin-top: 20px;
    }
    a.variation {
        margin: auto;
        display: block;
        text-align: center;
    }
    .delete_existing {
    position: absolute;
    right: 30px;
    border: 1px solid white;
    border-radius: 50%;
    width: 25px;
    height: 25px;
    background: white;
    top: 5px;
    cursor: pointer;
}
.delete_existing i {
    display: block;
    text-align: center;
    margin: auto;
    padding-top: 15px;
    font-size: 20px;
    color: #f00;
    }
    .del_val i {
        font-size: 18px;
        margin-top: 30px;
    }
    .attr_name {
            max-width: 470px;
    margin-left: 10px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $("#variation_table input").trigger("input");
         build_table();
    });
</script>