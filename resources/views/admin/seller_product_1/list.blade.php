@php $n_img = 1; @endphp
<style>.modal-sm { max-width: 420px; } .modal-body label{ font-size: 16px; }</style>
<div id="content_list">@include('admin.seller_product.list.content')</div>
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
@section('js') 
 <script src="{{asset('admin/assets/js/datatable/tables/seller_product-datatable.js')}}"></script>
<!-- INTERNAL WYSIWYG Editor js -->
<script src="{{URL::asset('admin/assets/plugins/wysiwyag/jquery.richtext.js')}}"></script>
<script src="{{URL::asset('admin/assets/js/form-editor.js')}}"></script>
<!---combo tree--->
<script src="{{URL::asset('admin/assets/plugins/combotree/comboTreePlugin.js')}}"></script>

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
        $('body').on('click','#addNew',function(){ 
            $('.bd-example-modal-sm .modal-content').html($('#newAlertModal').html()); 
         
        }); var sellerId = 0;
        $('body').on('change','#sel_seller',function(){ sellerId = this.value; });
        
        $('body').on('change','#active_filter',function(){  
            $('#table_body').append($('#loader').html()); $('#product').addClass('blur'); 
            $.ajax({
                type: "POST",
                url: '{{url("admin/seller/products")}}',
                data: {active: this.value,viewType: 'ajax'},
                success: function (data) {
                    $('#pg_content').html(data); 
                    $('#table_body').remove($('#loader').html()); $('#attribute').removeClass('blur');
                } 
            });
        });
        
        $('body').on('click','#sell_continue',function(){ 
            $('body #sel_seller_error').text('');  
            if(sellerId > 0){ 
                $.ajax({
                    type: "GET",
                    url: '{{url("admin/seller/product/0")}}/'+sellerId,
                    success: function (data) { $('.bd-example-modal-sm').modal('hide');
                        $('body #content_detail').html(data); $('body #content_detail').fadeIn(700); $('#content_list').hide(); 
                        $('body #content_detail .no-disp').hide();
                    } 
                }); return false;
            }else{ $('body #sel_seller_error').text('Select Seller'); }
        })
        $('body').on('click','.editBtn',function(){ 
            var id = this.id.replace('editBtn-','');
            $.ajax({
                type: "GET",
                url: '{{url("admin/seller/product")}}/'+id,
                success: function (data) { $('.bd-example-modal-sm').modal('hide');
                    $('body #content_detail').html(data); $('body #content_detail').fadeIn(700); $('#content_list').hide(); 
                    $('body #content_detail .no-disp').hide();
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
                url: '{{url("admin/associativeProducts")}}',
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
                url: '{{url("admin/admin-product")}}/'+value,
                data: {active: $('#active_filter').val()},
                success: function (data) { 
                    $.each(data, function(key,value) { // alert(key+' -- '+value);
                        $('#adminForm #'+key).val(value);
                    });  $('#adminForm .admin').prop('disabled',true);
                } 
            }); 
        });
        
        $('body').on('submit','#adminForm',function(e){ 
            $('body #adminForm .error').html('');
            if($('#adminForm #option2').prop('checked') == true && $('#adminForm #admin_prd_id').val() == ''){
                $('#adminForm #admin_prd_id').closest('div').find('.error').html('Select Admin Product'); $('#adminForm #admin_prd_id').focus(); return false;
            }else{
                if($('#adminForm #can_submit').val() > 0){ return true; }
                else{ 
                    e.preventDefault();    
                    var formData = new FormData(this); 
                    $('#adminForm #save_btn').attr('disabled',true); $('#adminForm #save_btn').text('Validating...'); 
                    $.ajax({
                        type: "POST",
                        url: '{{url("admin/seller/product/validate")}}',
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
        $('body').on('click','button.close',function(){ $('#allert_success').fadeOut(); });

        $("body").on("change", ".status-btn", function () {
            var id          =   this.id.replace('status-','');
            var bId         =   this.id;
            var sts         =   $(this).prop("checked");
            var url         =   '{{url("admin/seller/product/updateStatus")}}';
            var smsg        =   'Seller activated successfully!';
            if (sts == true){ var status = 1; }else if (sts == false){var status = 0; smsg = 'Seller deactivated successfully!'; }
            if($('#active_filter').val() != ''){ $('#table_body').append($('#loader').html()); $('#attribute').addClass('blur');  }
            updateStatus(id,bId,status,url,'dtrow-','is_active',smsg);
        });
        $('body').on('click','.delBtn',function(){  // alert('sss');
            var id          =   this.id.replace('delBtn-',''); 
            var status      =   1;
            var url         =   '{{url("admin/seller/updateStatus")}}';
            var smsg        =   'Seller deleted successfully!';
            swal({
                title: "Delete Confirmation",
                text: "Are you sure you want to delete this Seller?",
                // type: "input",
                showCancelButton: true,
                closeOnConfirm: true,
                confirmButtonText: 'Yes'
            },function(inputValue){
                if (inputValue == true) { 
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
        
        $('body').on('click','#tab5 .dtrow .ck',function(){ 
            var id          =   this.id.replace('ck-','');
            var atteSet     =   $('#tab5 #dtrow-'+id).data('val');
            if($('#tab5 #assosi_'+id).prop('disabled') == true){ return false; } 
            else{
                if($('#tab5 #assosi_'+id).prop('checked') == true){ 
                    $('#tab5 #assosi_'+id).prop('checked',false); $('#tab5 .dtrow.'+atteSet).removeClass('disabled'); $('#tab5 .dtrow.'+atteSet).attr('disabled',false);
                     $('#tab5 .cb.'+atteSet).attr('disabled',false);
                }else{  
                    $('#tab5 #assosi_'+id).prop('checked',true); $('#tab5 .dtrow.'+atteSet).addClass('disabled'); $('#tab5 .dtrow.'+atteSet).attr('disabled',true); 
                     $('#tab5 .cb.'+atteSet).attr('disabled',true);  $('#tab5 #assosi_'+id).prop('disabled',false);
                    $('#tab5 #dtrow-'+id).removeClass('disabled'); $('#tab5 #dtrow-'+id).attr('disabled',false);
                }
            }
        });

    });

    
    function select(id,form){ 
        if($('#'+form+' #assosi_'+id).prop('checked') == true){ 
            $('#'+form+' #assosi_'+id).prop('checked',false); $('#'+form+' #assosi_-'+id).removeClass('selected'); $('#'+form+' #select-'+id).text('Select');
        }else{ $('#'+form+' #attr_'+id).prop('checked',true); $('#'+form+' #assosi_-'+id).addClass('selected'); $('#'+form+' #select-'+id).text('Selected') }
    }
    function updateStatus(id,rowId,status,url,row,field,smsg){
        $.ajax({
            type: "POST",
            url: url,
            data: { "_token": "{{csrf_token()}}", id: id, value: status,field: field, field, page: row},
            success: function (data) {
                if(field == 'is_deleted'){ $('#active_filter').trigger('change'); }
                else{ if($('#active_filter').val() != ''){ $('#active_filter').trigger('change'); } }
                if (data.type == 'warning' || data.type == 'error'){ toastr.error('Something went wrong.'); }else{ toastr.success(smsg); }
            }
        });
    }
    function submitForm(postValues){
        $.ajax({
            type: "POST",
            url: '{{url("admin/seller/save")}}',
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
</script>
@endsection
