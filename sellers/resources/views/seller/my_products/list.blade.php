@extends('layouts.admin')
@section('title', 'Seller Product List')
@section('css')
<link href="{{URL::asset('admin/assets/plugins/wysiwyag/richtext.css')}}" rel="stylesheet" />
<link href="{{URL::asset('admin/assets/plugins/quill/quill.snow.css')}}" rel="stylesheet">
        <link href="{{URL::asset('admin/assets/plugins/quill/quill.bubble.css')}}" rel="stylesheet">
<!---combo tree-->
<link href="{{URL::asset('admin/assets/css/combo-tree.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.0.45/css/materialdesignicons.min.css">
        <link href="{{URL::asset('admin/assets/css/datepicker.css')}}" rel="stylesheet" />
               <link href="{{URL::asset('admin/assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
<link href="{{URL::asset('admin/assets/plugins/fileupload/css/fileupload.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('admin/assets/css/chosen.min.css')}}" rel="stylesheet"/>
@endsection
@section('content') @php $n_img = 1; @endphp
<style>.modal-sm { max-width: 420px; } .modal-body label{ font-size: 16px; }</style>
<div id="content_list">@include('seller.my_products.list.content')</div>
<div id="content_detail" class="row no-disp"></div>
<div id="newAlertModal" style="display: none">   
    <div class="modal-header">
        <h5 class="modal-titlee" id="exampleModalLongTitle">Select Seller</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="col-12">
            {{Form::select('sel_seller',$sellers,'',['id'=>'sel_seller','class'=>'form-control','placeholder'=>'Select Seller'])}}
            <span id="sel_seller_error" class="error"></span><span id="selected_id" class="d-none"></span>
        </div>
    </div>
    <div class="modal-footer">
       {{Form::hidden('del_id',0,['id'=>'del_id'])}}
        <button id="cancel_btn" type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button id="sell_continue" type="button" data-id='0' class="btn btn-primary delUser">Continue</button>
    </div>
</div>
<style type="text/css">
    table.dataTable tr.parent {
animation: none !important;
    }
    table.dataTable tr.selected p {
color: #fff;
    }

ul.prod_imgs {
/*  flex-direction: column;
  flex-wrap: wrap;
  display: flex;
  height: 100vh;*/
}
ul li.prod_img {
  width:33.333333%; float:left;
  margin-bottom: 15px;
}
.prod_img img {
    max-width: 300px;
}

</style>
@section('js') 
 <script src="{{asset('admin/assets/js/datatable/tables/seller_product-datatable.js')}}"></script>
 <script src="{{URL::asset('admin/assets/js/bootstrap-datepicker.js')}}"></script>
 <script src="{{URL::asset('admin/assets/js/jquery.validate.min.js')}}"></script>
<!-- INTERNAL WYSIWYG Editor js -->
<script src="{{URL::asset('admin/assets/plugins/wysiwyag/jquery.richtext.js')}}"></script>
<script src="{{URL::asset('admin/assets/js/form-editor.js')}}"></script>
<!---combo tree--->
<script src="{{URL::asset('admin/assets/plugins/combotree/comboTreePlugin.js')}}"></script>
<script src="{{URL::asset('admin/assets/plugins/quill/quill.min.js')}}"></script>

 <script src="{{URL::asset('admin/assets/plugins/fileupload/js/dropify.js')}}"></script>
        <script src="{{URL::asset('admin/assets/js/filupload.js')}}"></script>
 <script src="{{URL::asset('admin/assets/js/chosen.jquery.min.js')}}"></script>
    <script>
    


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }); 
    $(document).ready(function(){ 
        $('#adminForm #can_submit').val(0); 
        @if(Session::has('success')) toastr.success("{{ Session::get('success')}}"); 
        @elseif(Session::has('error')) toastr.error("{{ Session::get('error')}}");  @endif
        $('body').on('click','#cancel_btn',function(){ $('#content_list').fadeIn(700); $('#content_detail').hide();  });
        $('body').on('click','#bc_list',function(){ $('#content_list').fadeIn(700); $('#content_detail').hide();  });
        var sellerId = 0;
        sellerId = "<?php echo $sellerinfo->seller_id; ?>";
        $('body').on('click','#addNew',function(){ 
             $('body #sel_seller_error').text('');  
            if(sellerId > 0){ 
                $.ajax({
                    type: "GET",
                    url: '{{url("my-product/0")}}/'+sellerId,
                    success: function (data) { $('.bd-example-modal-sm').modal('hide');
                        $('body #content_detail').html(data); $('body #content_detail').fadeIn(700); $('#content_list').hide(); 
                    } 
                }); return false;
            }else{ $('body #sel_seller_error').text('Select Seller'); }
         
        }); 
        $('body').on('click','#nav_tab_4',function(){ 
    $('.stars').stars();
        });
       
        $('body').on('click','.editBtn',function(){ 
            var id = this.id.replace('editBtn-','');
            $('#'+this.id+' span').text('Loading...'); $(this).prop('disabled',true);
            $.ajax({
                type: "GET",
                url: '{{url("/product")}}/'+id+'/0/edit',
                success: function (data) { $('.bd-example-modal-sm').modal('hide'); 
                    $('body #content_detail').html(data); $('body #content_detail').fadeIn(700); $('#content_list').hide(); 
                    $('body #content_detail .no-disp').hide();   $('#editBtn-'+id+' span').text('Edit');  $('#editBtn-'+id).prop('disabled',false);
                    setAssociPrds();
                } 
            }); return false;
        })
        
        $('body').on('click','.cus_radio',function(){ 
            if(this.id == 'option2'){ 
                $('#adminForm #admin_div').show(); $('#adminForm #seller_div').hide(); $('#adminForm .admin').val(''); 
                $('#adminForm #prd_type_div').hide(); $('#adminForm #config_attr_div').hide(); $('#adminForm #prd_type_div #prd_type').val('');
                $('#adminForm .ckIn').each(function(){ $(this).prop('checked',false); });  $('#adminForm #nav_tab_5').hide();
            }else{ 
                $('#adminForm #admin_div').hide(); $('#adminForm .admin').val(''); $('#adminForm .admin').prop('disabled',false);
                 $('#adminForm #seller_div').show(); $('#adminForm #admin_prd_id').val('');
                 $('#adminForm #prd_type_div').show(); 
            }
        });
        
        $('body').on('click','#adminForm .ckIn',function(){ var attrIds = [];
            $('#adminForm #tab5').html('Loading Data...');
            $('#adminForm .ckIn').each(function(){ if($(this).prop('checked') == true){ attrIds.push(this.value); } });
            $.ajax({
                type: "POST",
                url: '{{url("product/associativeProducts")}}',
                data: {attrIds: attrIds, prdId: $('#adminForm #id').val(),sellerId: $('#adminForm #seller_id').val()},
                success: function (data) { 
                    $('#adminForm #tab5').html(data);
                } 
            }); 
        });
        
        $('body').on('change','#adminForm #prd_type',function(){
            if($(this).val() == 2){ $('#adminForm #config_attr_div').show(); $('#adminForm #nav_tab_5').show(); }
            else{ $('#adminForm #config_attr_div').hide(); $('#adminForm #nav_tab_5').hide(); }
        });
        
        $('body').on('click','#tab5 .assosi',function(){ var id  =   this.id.replace('assosi_',''); select(id,'tab5'); });
        
        $('body').on('change','#admin_prd_id',function(){
            var value = this.value;
            if(value == ''){ $('#adminForm .admin').val(''); $('#adminForm .admin').prop('disabled',false); }
             $.ajax({
                type: "GET",
                url: '{{url("/adminProduct")}}/'+value,
                data: {active: $('#active_filter').val()},
                success: function (data) { 
                    $.each(data, function(key,value) {  //console.log(key+' -- '+value);
                        if(key != 'id'){ $('#adminForm #'+key).val(value); }
                        if(key == "category_id") { $('#adminForm #categoryList').val(value); }
                        if(key == "sub_category_id") { $('#adminForm #sub-category-id').val(value); loadsubcat('1'); }
                         if(key == "desc") { $('#adminForm #desc').parents('.richText').find(".richText-editor").html(value); }
                         if(key == "content") { $('#adminForm #content').parents('.richText').find(".richText-editor").html(value); }
                         if(key == "spec_cnt_id") { 
                             var container = document.querySelector("#quillEditor");
                            var quill = new Quill(container);
                            if(Quill.find(container) === quill) {
                                quill.setContents(JSON.parse(value), 'api');
                            }
                             
                         }
                         
                    });  $('#adminForm .admin').prop('disabled',true);
                } 
            }); 
        });
        
        
        $('body').on('click','.del-img', function(){
            var id  =   this.id.replace('del-img-','');
            $.ajax({
                type: "POST",
                data: {imgId :id},
                url: '{{url("delete/product/image")}}',
                success: function (data) { 
                    if(data == 'success'){  toastr.success('Prduct image deleted successfully!'); $('#prdImg-'+id).remove(); }
                    else{ toastr.error('Somethng went wrong. Please try after some time.'); }
                } 
            });
        });
        
        $('body').on('click','#tab5 .dtrow .ck',function(){ 
            var id          =   this.id.replace('ck-','');
            var atteSet     =   $('#tab5 #dtrow-'+id).data('val');
            if($('#tab5 #assosi_'+id).prop('disabled') == true){ return false; } 
            else{
                if($('#tab5 #assosi_'+id).prop('checked') == true){ 
                    $('#tab5 #assosi_'+id).prop('checked',false); $('#tab5 .dtrow.'+atteSet).removeClass('disabled'); $('#tab5 .dtrow.'+atteSet).attr('disabled',false);
                     $('#tab5 .cb.'+atteSet).attr('disabled',false);  $('#tab5 .dtrow.'+atteSet).removeClass('selected');
                }else{  
                    $('#tab5 #assosi_'+id).prop('checked',true); $('#tab5 .dtrow.'+atteSet).addClass('disabled'); $('#tab5 .dtrow.'+atteSet).attr('disabled',true); 
                     $('#tab5 .cb.'+atteSet).attr('disabled',true);  $('#tab5 #assosi_'+id).prop('disabled',false);
                    $('#tab5 #dtrow-'+id).removeClass('disabled'); $('#tab5 #dtrow-'+id).addClass('selected'); $('#tab5 #dtrow-'+id).attr('disabled',false);
                }
            }
        });
        
        $('body').on('change','#sale_start_date',function(){ $('#sale_end_date').attr('min',this.value); });
        $('body').on('change','#sale_end_date',function(){ $('#sale_start_date').attr('max',this.value); });

        
        $('body').on('submit','#adminForm',function(e){ 
            $('body #adminForm .error').html('');
            $("#specification").val(JSON.stringify(new Quill('#quillEditor').getContents()));
            if($('#adminForm #option2').prop('checked') == true && $('#adminForm #admin_prd_id').val() == '' &&  $('#adminForm #id').val() == 0){ 
                $('#adminForm #admin_prd_id').closest('div').find('.error').html('Select Admin Product'); $('#adminForm #admin_prd_id').focus(); $('#adminForm #nav_tab_1').trigger('click'); return false;
            }else{
                if($('#adminForm #can_submit').val() > 0){ return true; }
                else{ 
                    $("#hidden_table").remove();
                    e.preventDefault();    
                    var formData = new FormData(this); 
                    $('#adminForm #save_btn').attr('disabled',true); $('#adminForm #save_btn').text('Validating...'); 
                    $.ajax({
                        type: "POST",
                        url: '{{url("/product/validate")}}',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            if(data == 'success'){  var atrRes;
                                $('#adminForm .attr .required').each(function(){ 
                                    if(this.value == ''){ $(this).closest('div').find('.error').text('This field is required'); atrRes = false; }
                                    else{ $(this).closest('div').find('.error').text(''); }
                                });
                                if(atrRes  == false){ $('#adminForm #nav_tab_4').trigger('click');
                                    $('#adminForm #save_btn').attr('disabled',false); $('#adminForm #save_btn').text('Save'); return false;
                                }else{ 
                                    $('#adminForm #tab1 select').prop('disabled',false); 
                                    $('#adminForm #save_btn').text('Saving...'); 
                                 //    submitForm(formData); return false;
                                     $('#adminForm #can_submit').val(1); $('#adminForm').submit();
                                 } 
                            }else{
                                var errKey = ''; var n = 0;
                                $.each(data, function(key,value) { if(n == 0){ errKey = key; n++; }
                                    

                                    $('#adminForm #'+key).closest('div').find('.error').html(value);
                                    if(key == 'error' && value == 'prd'){ $('#adminForm #nav_tab_1').trigger('click'); }
                                    else if(key == 'error' && value == 'price'){ $('#adminForm #nav_tab_2').trigger('click'); }
                                    else if(key == 'error' && value == 'attribute_1'){ $('#adminForm #nav_tab_2').trigger('click');
                                        $("#attribute_1_name").html("Attribute Name is required.");
                                     }
                                     else if(key == 'error' && value == 'attribute_1_val'){ $('#adminForm #nav_tab_2').trigger('click');
                                        $("#attribute_1_value").html("Attribute values are required.");
                                     }
                                    else if(key == 'error' && value == 'attribute_2'){ $('#adminForm #nav_tab_2').trigger('click');$("#attribute_2_name").html("Attribute Name is required."); }
                                    else if(key == 'error' && value == 'attribute_2_val'){ $('#adminForm #nav_tab_2').trigger('click');
                                        $("#attribute_2_value").html("Attribute values are required.");
                                     }
                                }); 
                                $('#'+errKey).focus();
                                $('#adminForm #save_btn').attr('disabled',false); $('#adminForm #save_btn').text('Save'); return false;
                            }
                            return false;
                        }
                    });

                }
            }
          return false; 
        });

          $('body').on('click','#offer_save_btn',function(){



             
        });

$('body').on('click','#importval',function(){


$("#importForm").validate({
rules: {
imp_file : {
required: true
},
},

messages : {
imp_file: {
required: "Excel file is required.",

}

},
errorPlacement: function(error, element) {

if (element.attr("name") == "imp_file" ) {
$("#errNm1").text($(error).text());

}else {
error.insertAfter(element)
}
},
});



});

$('body').on('change','#imp_file',function(){
$("#errNm1").empty();

});
                $('body').on('click','.specialOfr',function(){
            var id      =   this.id.replace('specialOfr-','');  
            $.ajax({
                type: "GET",
                url: '{{url("/my-products/offer")}}/'+id,
                success: function (data) {
                    $('#content_detail').html(data); $('#content_detail').fadeIn(700); $('#content_list').hide(); 
                    var seldate=$("[name='valid_from']").val();
                    
                    if(seldate){
                         $(".datepicker").datepicker({ 
                    autoclose: true, 
                    todayHighlight: true,
                    startDate: new Date()
                    }).datepicker();
                    }else {
                         $(".datepicker").datepicker({ 
                    autoclose: true, 
                    todayHighlight: true,
                    startDate: new Date()
                    }).datepicker('update', new Date());
                    }



$("#offerForm").validate({
rules: {

discount_value : {
required: true,
number: true,
min: 1
},

discount_type: {
required: true,
},
quantity_limit: {
required: true,
number: true,
min: 1
},

valid_from: {
required: true,
},
valid_to: {
required: true,
},
is_active: {
required: true,
},

},

messages : {
discount_value: {
required: "Discount Value is required.",
min: "Discount Value must be greater than 0"
},
discount_type: {
required: "Discount Type is required."
},
quantity_limit: {
required: "Product Quantity Limit is required.",
min: "Product Quantity Limit must be greater than 0"
},
valid_from: {
required: "Validity From Date is required."
},
valid_to: {
required: "Validity To Date is required."
},

is_active: {
required: "Status field is required."
},

}
});
                    
                } 
            }); return false;
        });

         $('body').on('click','.viewBtn',function(){
            
            var id      =   this.id.replace('viewBtn-','');  
            var sellerId = 0;
            sellerId = "<?php echo $sellerinfo->seller_id; ?>";
            
            $.ajax({
                type: "GET",
               url: '{{url("my-product/")}}/'+id+"/"+sellerId+"/view",
                success: function (data) {
                    $('#content_detail').html(data); $('#content_detail').fadeIn(700); $('#content_list').hide(); 
                  //  $('#content_detail #country_id').trigger("chosen:updated");
                } 
            }); return false;
        });
        


        $("body").on("change", ".status-btn", function () {
            var id          =   this.id.replace('status-','');
            var bId         =   this.id;
            var sts         =   $(this).prop("checked");
            var url         =   '{{url("my-products/product/updateStatus")}}';
            var smsg        =   'Seller activated successfully!';
            if (sts == true){ var status = 1; }else if (sts == false){var status = 0; smsg = 'Seller deactivated successfully!'; }
            updateStatus(id,bId,status,url,'dtrow-','is_active',smsg);
        });
        $('body').on('click','.delBtn',function(){  // alert('sss');
            var id          =   this.id.replace('delBtn-',''); 
            var status      =   1;
            var url         =   '{{url("my-products/product/updateStatus")}}';
            var smsg        =   'Seller deleted successfully!';
            swal({
                title: "Delete Confirmation",
                text: "Are you sure you want to delete this Seller?",
                // type: "input",
                showCancelButton: true,
                closeOnConfirm: true,
                confirmButtonText: 'Yes'
            },function(inputValue){
                if (inputValue == true) { alert('id');
                    updateStatus(id,'',status,url,'seller','is_deleted',smsg);
                }
            });
        });
        var row      =   parseInt('{{$n_img}}'); 
        $('body').on('click','#add_more',function(){ 
            var htmlContent             =   $('#add_more_img').html();
            htmlContent                 =   htmlContent.replace('img_row_id','img_row_'+row);
            htmlContent                 =   htmlContent.replace('img_id_id','img_id_'+row);
            htmlContent                 =   htmlContent.replace('image_file_id','image_'+row);
            htmlContent                 =   htmlContent.replace('image_disp_id','image_'+row+'_img');
            htmlContent                 =   htmlContent.replace('del_img_id','del_img_'+row);
            $('#adminForm #prd_imgs').append(htmlContent); row++;
        });
        
        $('body').on('click','#adminForm .del_img.del',function(){
            var id      =   this.id.replace('del_img_',''); 
            $('#adminForm #img_row_'+id).remove();
        });
        
        $("body").on('change','#adminForm input.img',function(){ readURL(this); });


        // prod attribute starts

       $('body').on('change','#prd_type',function(){ 
            if($(this).val() ==1) {
                $(".variable_prod").hide(500);
                $(".simple_prod").show(500);
            }else {
                $(".variable_prod").show(500);
                $(".simple_prod").hide(500);

            }
        });
         $('body').on('click','.variation',function(){ 
         
                $(".attr_content").show(500);
                $(".variation").hide(500);
          
        });

        $('body').on('click','#add_val',function(){ 
            var row      =   parseInt($("#attr-val-content-1 .attr_value").length); 
            var htmlContent             =   $('#adnl_rows').html();
            htmlContent                 =   htmlContent.replace('attr_val_row_id','attr-val-row-'+row);
            htmlContent                 =   htmlContent.replace('value_id_id','value_id_'+row);
            htmlContent                 =   htmlContent.replace('attr_val_id','val'+row);
            htmlContent                 =   htmlContent.replace('value[val][]','attr_1_value[attr1_'+row+'][]');
            htmlContent                 =   htmlContent.replace('attr_0_img','attr_1_img[attr1_'+row+'][]');
            htmlContent                 =   htmlContent.replace('attr1_0','attr1_'+row);
            htmlContent                 =   htmlContent.replace('val_error_id','val_error_'+row);
            htmlContent                 =   htmlContent.replace('del_val_id','del_val_'+row);
            $('#adminForm #attr-val-content-1').append(htmlContent); row++;
            if($("#attr-val-content-1 .attr_value").length >=5){
                $("#add_val").hide();
            }else {
               $("#add_val").show(); 
            }
        });
         $('body').on('click','#add_var_2',function(){ 
            var row      =   parseInt($("#attr-val-content-2 .attr_value").length); 
            var htmlContent             =   $('#adnl_rows').html();
            htmlContent                 =   htmlContent.replace('attr_val_row_id','attr-val-row-'+row);
            htmlContent                 =   htmlContent.replace('value_id_id','value_id_'+row);
            htmlContent                 =   htmlContent.replace('value[val][]','attr_2_value[attr2_'+row+'][]');
            htmlContent                 =   htmlContent.replace('attr_0_img','attr_2_img[attr1_'+row+'][]');
            htmlContent                 =   htmlContent.replace('attr1_0','attr2_'+row);
            htmlContent                 =   htmlContent.replace('attr_val_id','val'+row);
            htmlContent                 =   htmlContent.replace('val_error_id','val_error_'+row);
            htmlContent                 =   htmlContent.replace('del_val_id','del_val_'+row);
            $('#adminForm #attr-val-content-2').append(htmlContent); row++;
            if($("#attr-val-content-2 .attr_value").length >=5){
                $("#add_var_2").hide();
            }else {
               $("#add_var_2").show(); 
            }
        });
        
        $('body').on('click','#adminForm #attr-val-content-2 .del_val.del',function(){
            var id      =   this.id.replace('del_val_',''); 
            $('#adminForm #attr-val-content-2 #attr-val-row-'+id).remove();
              build_table();
              if($("#attr-val-content-2 .attr_value").length <5){
                $("#add_var_2").show();
            }
            
        });
         $('body').on('click','#adminForm #attr-val-content-1 .del_val.del',function(){
            var id      =   this.id.replace('del_val_',''); 
            $('#adminForm #attr-val-content-1 #attr-val-row-'+id).remove();
              build_table();
              
             if($("#attr-val-content-1 .attr_value").length < 5){
                $("#add_val").show();
            }
        });
        
        $('body').on('click','#adminForm .delete_existing',function(){
           $(".attr_content").hide(500);
           $('.attr_content').find('input:text').val('');  
           $("#attr-val-content-2 .attr_val_row_id").remove();
                $(".variation").show(500);
                build_table();
                $(".converted").remove();
        });



        // variation table starts

        $('body').on('input','.prod_attr_1 input,.prod_attr_2 input',function(){
           
           // $('.variation_table .init_name').text($(this).val());
           build_table();

        });

        var price_vals = {};
         $('body').on('input','#variation_table input',function(){
           
                var $a = $("#variation_table tbody").clone();

                // $a.appendTo("body");
            $("#hidden_table").html("");
            $("#hidden_table").html($a);

        });


        // attributes validation

//         $('body').on('click','#save_btn',function(){
//           $("#adminForm").validate({
// rules: {
// "price[price]": {
//     required: function(){
// return (''+$("#prd_type option:selected").val() ==1) ;
// },
// },
// "price[tax]": {
//     required: function(){
// return (''+$("#prd_type option:selected").val() ==1) ;
// },
// },
// },

// messages : {
// "price[price]": {
// required: "Price is required.",

// },
// "price[tax]": {
// required: "Tax is required.",

// }

// },
// errorPlacement: function(error, element) {

// if (element.attr("name") == "imp_file" ) {
// $("#errNm1").text($(error).text());

// }else {
// error.insertAfter(element)
// }
// },
// });
//         });


    });
    
    function deleteValue(id){ $('#adminForm #attr-val-row-'+id).remove();}

   function build_table(){ 


        var table = $("#variation_table");
        var attr_lp = 0; var tbody_html ='';var thead_html ='';
        if(jQuery("#attr-val-content-1 .attr_value").length >0) {

            if($('.prod_attr_1 #attr_name_1').val() !="") {
                thead_html ='<thead><tr><th class="text-center init_name">'+$('.prod_attr_1 #attr_name_1').val()+'</th><th class="text-center">Price</th><th class="text-center">Stock</th><th class="text-center">SKU</th><th class="text-center">Shipping</th></tr></thead>';
            }else {
                thead_html ='<thead><tr><th class="text-center init_name">Name</th><th class="text-center">Price</th><th class="text-center">Stock</th><th class="text-center">SKU</th><th class="text-center">Shipping</th></tr></thead>';
            }
            

        $("#attr-val-content-1 .attr_value").each(function(){
            attr_lp++;
            // alert(attr_lp);
            var opt_name = $(this).data("val");
            var opt_title = $(this).val();
            if($(this).val() !=""){
                
                var price_set = 0; var stock_set = 0; var sku_set = 0;
                if(jQuery("#attr-val-content-2 .attr_value").length >0 && ($('.prod_attr_2 #attr_name_2').val() !="" || $("#attr-val-content-2 #attr_val_id").val() !="" )) {

                    //thead
                    if($('.prod_attr_2 #attr_name_2').val() !="") {
                    thead_html ='<thead><tr><th class="text-center init_name">'+$('.prod_attr_1 #attr_name_1').val()+'</th><th class="text-center attr2_name">'+$('.prod_attr_2 #attr_name_2').val()+'</th><th class="text-center">Price</th><th class="text-center">Stock</th><th class="text-center">SKU</th><th class="text-center">Shipping</th></tr></thead>'; 
                    } else{ 
                    thead_html ='<thead><tr><th class="text-center init_name">'+$('.prod_attr_1 #attr_name_1').val()+'</th><th class="text-center">Name</th><th class="text-center">Price</th><th class="text-center">Stock</th><th class="text-center">SKU</th><th class="text-center">Shipping</th></tr></thead>';
                    } 

                     tbody_html +='<tbody><tr id='+attr_lp+'><td class="text-center init_value" rowspan="'+$("#attr-val-content-2 .attr_value").length+'"><input class="form-control" placeholder="Option" value="'+$(this).val()+'" readonly="true" type="text"></td>';
                    var k =0;
                                
                            $("#attr-val-content-2 .attr_value").each(function(){
                                k++; var rwpan_s = "";var rwpan_e = ""; var price_set = 0; var stock_set = 0; var sku_set = 0;
                                if(k >1) {  rwpan_s = "<tr id="+k+">"; rwpan_e = "</tr>"; }
                                
                            if($(this).val() !=""){
                                if($('#hidden_table [name="price['+opt_name+']['+$(this).data("val")+']"]').val() !=null) {
                                price_set = $('#hidden_table [name="price['+opt_name+']['+$(this).data("val")+']"]').val();
                                 }else { price_set =0; }
                                 if($('#hidden_table [name="stock['+opt_name+']['+$(this).data("val")+']"]').val() !=null) {
                                stock_set = $('#hidden_table [name="stock['+opt_name+']['+$(this).data("val")+']"]').val();
                                 }else { stock_set =0; }
                                 if($('#hidden_table [name="sku['+opt_name+']['+$(this).data("val")+']"]').val() !=null) {
                                sku_set = $('#hidden_table [name="sku['+opt_name+']['+$(this).data("val")+']"]').val();
                                 }else { sku_set =0 }
                            tbody_html += rwpan_s+'<td class="text-center"><input class="form-control" placeholder="Option" value="'+$(this).val()+'" type="text"></td><td class="text-center"><input class="form-control price_field" placeholder="Price" required value="'+price_set+'" name="price['+opt_name+']['+$(this).data("val")+']" type="number"></td><td class="text-center"><input class="form-control" required placeholder="Stock" type="number" value="'+stock_set+'" name="stock['+opt_name+']['+$(this).data("val")+']"></td><td class="text-center"><input class="form-control" placeholder="SKU" value="'+sku_set+'" name="sku['+opt_name+']['+$(this).data("val")+']" type="text"><input type="hidden" class="field_name"  value="['+opt_name+']['+$(this).data("val")+']"><input type="hidden" name="dyn_prds['+opt_name+']" value="1"><input type="hidden" name="dyn_prds['+$(this).data("val")+']" value="1"><input type="hidden" name="dyn_prds_names['+opt_name+"~"+$(this).data("val")+']" value="'+opt_title+" - "+$(this).val()+'"></td><td><i class="fe fe-edit shipping mr-1"></i></td>'+rwpan_e;
                            }else {

                                if($('#hidden_table [name="price['+opt_name+']"]').val() !=null) {
                                price_set = $('#hidden_table [name="price['+opt_name+']"]').val();
                                 }else { price_set =0; }
                                 if($('#hidden_table [name="stock['+opt_name+']"]').val() !=null) {
                                stock_set = $('#hidden_table [name="stock['+opt_name+']"]').val();
                                 }else { stock_set =0; }
                                 if($('#hidden_table [name="sku['+opt_name+']"]').val() !=null) {
                                sku_set = $('#hidden_table [name="sku['+opt_name+']"]').val();
                                 }else { sku_set =0 }



                                tbody_html +=rwpan_s+'<td class="text-center"><input class="form-control" placeholder="Option" value="Option" type="text"></td><td class="text-center"><input class="form-control price_field" placeholder="Price" value="'+price_set+'" required name="price['+opt_name+']" type="number"></td><td class="text-center"><input class="form-control" name="stock['+opt_name+']" required placeholder="Stock" value="'+stock_set+'" type="number"></td><td class="text-center"><input class="form-control" placeholder="SKU" value="'+sku_set+'" name="sku['+opt_name+']" type="text"><input type="hidden" name="dyn_prds['+opt_name+']" value="1"><input type="hidden" class="field_name"  value="['+opt_name+']"><input type="hidden" name="dyn_prds_names['+opt_name+']" value="'+opt_title+'"></td><td><i class="fe fe-edit shipping mr-1"></i></td>'+rwpan_e;
                            }
                            });
                tbody_html = tbody_html+"</tr></tbody>";


                    //tbody

                }else{
                    thead_html ='<thead><tr><th class="text-center init_name">'+$('.prod_attr_1 #attr_name_1').val()+'</th><th class="text-center">Price</th><th class="text-center">Stock</th><th class="text-center">SKU</th><th class="text-center">Shipping</th></tr></thead>';

                    tbody_html +='<tbody><tr id='+attr_lp+' ><td class="text-center init_value" rowspan="'+$("#attr-val-content-2 .attr_value").length+'"><input class="form-control" placeholder="Option" value="'+$(this).val()+'" readonly="true" type="text"></td>';
                                
                            if($('#hidden_table [name="price['+opt_name+']"]').val() !=null) {
                                price_set = $('#hidden_table [name="price['+opt_name+']"]').val();
                                 }else { price_set =0; }
                                 if($('#hidden_table [name="stock['+opt_name+']"]').val() !=null) {
                                stock_set = $('#hidden_table [name="stock['+opt_name+']"]').val();
                                 }else { stock_set =0; }
                                 if($('#hidden_table [name="sku['+opt_name+']"]').val() !=null) {
                                sku_set = $('#hidden_table [name="sku['+opt_name+']"]').val();
                                 }else { sku_set =0 }

                                tbody_html +='<td class="text-center"><input class="form-control price_field" required name="price['+opt_name+']" placeholder="Price" value="'+price_set+'" type="number"></td><td class="text-center"><input class="form-control" value="'+stock_set+'" placeholder="Stock" required name="stock['+opt_name+']" type="number"></td><td class="text-center"><input class="form-control"  value="'+sku_set+'" name="sku['+opt_name+']" placeholder="SKU" type="text"><input type="hidden" name="dyn_prds['+opt_name+']" value="1"><input type="hidden" class="field_name"  value="['+opt_name+']"><input type="hidden" name="dyn_prds_names['+opt_name+']" value="'+opt_title+'"></td><td><i class="fe fe-edit shipping mr-1"></i></td>';
                           
                           
                tbody_html = tbody_html+"</tr></tbody>";

                }
            }


        // alert($(this).val());
        });
          table.empty();
            table.append(thead_html);
            table.append(tbody_html);
            var s =0;
            $("#variation_table tbody tr").each(function(){
            s++;
            $(this).attr("id","tr_"+s);
            });
    }
     
          

    }

    $('body').on('click','i.shipping',function(){ 

   var trid = $(this).closest('tr').attr('id');
   var fld_name = $('#'+trid).find('.field_name').val();
    var row      =   fld_name.replace(/[\[\]']+/g,''); 
   add_modal(row,fld_name);
   $('#attr_'+row).modal('show');

        });

    function add_modal(row,fld_name){
        // alert(attr_lp);
        // var row      =   fld_name.replace(/[\[\]']+/g,''); 
        if ($('#attr_'+row).length)
        {
        // alert("exists");
        }
        else
        {
     
        
        var htmlContent             =   $('#add_modal').html();
        htmlContent                 =   htmlContent.replace('modal_row_id','attr_'+row);
        htmlContent                 =   htmlContent.replace('tochange','converted');
        htmlContent                 =   htmlContent.replace('mweight','mweight_'+row);
        htmlContent                 =   htmlContent.replace('mdimension[weight]','weight'+fld_name);
        htmlContent                 =   htmlContent.replace('mdimension[length]','length'+fld_name);
        htmlContent                 =   htmlContent.replace('mdimension[width]','width'+fld_name);
        htmlContent                 =   htmlContent.replace('mdimension[height]','height'+fld_name);
        $('#adminForm .attr_list').append(htmlContent); 


        }
    }
    

    function updateStatus(id,rowId,status,url,row,field,smsg){
        $.ajax({
            type: "POST",
            url: url,
            data: { "_token": "{{csrf_token()}}", id: id, value: status,field: field, field, page: row},
            success: function (data) {
                if(field == 'is_deleted'){ window.location.reload();
                  //  $('#content_list').html(data); toastr.success(smsg);
                }else{ 
                    if (data.type == 'warning' || data.type == 'error'){ 
                        toastr.error(smsg);
                         }else{
                            if(field == 'is_active')
                            {
                                if(status ==1){
                                    jQuery('#status-'+id).closest("td").attr("data-search","Active");
                                }else {
                                    jQuery('#status-'+id).closest("td").attr("data-search","Inactive");
                                }
                                var table = $.fn.dataTable.tables( { api: true } );
                                  table.rows().invalidate().draw();

                            }
                          toastr.success(smsg);
                           }
                } 
            }
        });
    }
    function submitForm(postValues){
        $.ajax({
            type: "POST",
            url: '{{url("product/save")}}',
            data: postValues,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) { 
              $('#adminForm #save_btn').attr('disabled',false); $('#adminForm #save_btn').text('Save');
              if($('#adminForm #id').val() > 0){ var msg = 'Seller updated successfully!'; }else{ msg = 'Seller added successfully!'; }
              $('#content_list').html(data);  $('#content_list').fadeIn(700); $('#content_detail').hide(); ;
              toastr.success(msg);  return false;
            } 
        });
    }
    function getStateDropdown(cId,selected){ 
        $.ajax({
            type: "POST",
            url: '{{url("admin/getDropdown/states/")}}',
            data: {field: 'country_id', value:cId, label:'name',selected: selected, placeholder:'Select State','_token': '{{ csrf_token()}}'},
            success: function (data) {
                $('#userForm #state').html(data);
            }
        });
    }
    
    function readURL(input) { 
        if (input.files && input.files[0]) { 
            var reader = new FileReader(); 
            reader.onload = function (e) { $('#adminForm img#'+input.id+'_img').attr('src', e.target.result); $('#adminForm #'+input.id+'_img').show(); }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    function setAssociPrds(){
         $('body #tab5 .dtrow').each(function(){ 
            var id      =   this.id;
            var patern  =   $(this).data('val');
            if($('body #tab5 .'+patern).hasClass('selected')){ 
                $('body #tab5 .dtrow.'+patern).addClass('disabled'); $('body #tab5 .selected.'+patern).removeClass('disabled'); 
                $('body #tab5 .cb.'+patern).each(function(){ if($(this).prop('checked') == false){ $(this).prop('disabled',true); } });
            }
        });
    }

 function date_check() 
    {
      var sdate=$("[name='valid_from']").val();
      var tdate=$("[name='valid_to']").val();
      
      $('#valid_from').datepicker('setStartDate',new Date(sdate));
      if(sdate && tdate)
      {
        var d1 = Date.parse(sdate);
        var d2 = Date.parse(tdate);
        if (d1 > d2) 
        {
          $("[name='valid_to']").val(sdate);
          $('#valid_to').datepicker('setStartDate',new Date(sdate));
        }
      }
      
    }
</script>
<script type="text/javascript">
$(function() {
$('.plus-minus-toggle').on('click', function() {
$(this).toggleClass('collapsed');
$('#filtersec').toggle('slow');
});


});
</script>
@endsection
@endsection