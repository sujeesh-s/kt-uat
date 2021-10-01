
@php $row = 0; @endphp
<div id="list_form"> @include('settlement.list.content')</div>
<div id="dtl_form">  </div>
@section('js') 
<script src="{{URL::asset('admin/assets/js/datatable/tables/settlement-datatable.js')}}"></script>

    <script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }); 
    $(document).ready(function(){ 
        
        
        $('body').on('click', '#cancel_btn', function(){ $('#dtl_form').hide(); $('#list_form').fadeIn(700); });
        $('body').on('click', '#back_btn', function(){ $(this).prop('disabled',true); $(this).text('Redirecting..'); $('#bc_list').trigger('click'); });
        $('body').on('click', '#bc_list', function(){ 
            var id      =   $(this).data('seller'); 
            $.ajax({
                type: "GET",
                url: '{{url("settlements")}}', 
                data: {type: 'ajax'},
                success: function (data) {
                    $('#list_form').html(data); // $('#dtl_form').fadeIn(700); $('#list_form').hide();
                } 
            });
        });
        
        $('body').on('click','.editForm',function(){ 
            var id      =   $(this).data('seller'); 
             $(this).prop('disabled',true); $(this).text('Loading..'); 
            $.ajax({
                type: "GET",
                url: '{{url("/earnings")}}/'+id, 
                success: function (data) {
                    $('#list_form').html(data); // $('#dtl_form').fadeIn(700); $('#list_form').hide();
                } 
            });
        });
        
        $('body').on('click','.payBtn',function(){ 
            var id      =   $(this).data('seller'); 
            $.ajax({
                type: "GET",
                url: '{{url("/payment")}}/'+id,
                data: {page: 'settlement'},
                success: function (data) {
                    $('.modal-content').html(data);
                } 
            });
        });
        
        $('body').on('submit','#adminForm',function(e){  
            var rAmt    =   parseInt($('#adminForm #remain_amt').val());
            var pAmt    =   parseInt($('#adminForm #pay_amt').val());
            $('#adminForm .error').text(''); 
            if(pAmt > rAmt){ $('#adminForm #pay_error').text('Pay Amount Should be less than or equal to Pending Settlement amount'); return false; }
            else if(pAmt == '' || pAmt == 0){ $('#adminForm #pay_error').text('Enter Amount'); return false; }
            else{ 
                e.preventDefault();    
                var formData = new FormData(this);
                $('#adminForm #save_btn').attr('disabled',true); $('#adminForm #save_btn').text('Saving...'); 
             //   $('#adminForm #tab-1').trigger('click');
                $.ajax({
                    type: "POST",
                    url: '{{url("settlement/save")}}',
                    data: formData, cache: false, contentType: false, processData: false, 
                    success: function (data) {
                        $('#pg_content').html(data); $('#small-modal').modal('hide'); toastr.success("Payment Added Successfully!");
                    }
                });
            } return false;
        });
              
        @if(Session::has('success')) toastr.success("{{ Session::get('success')}}"); @endif
        @if(Session::has('error')) toastr.error("{{ Session::get('error')}}"); @endif
        
        $('body').on('change','.number',function(){  
            var id  =   this.id; var val = this.value.replace(/[^0-9\.]/g,''); $(this).val(val); if($(this).val() == ''){ $(this).val(0); }
        });
        $('body').on('change','.numberonly',function(){  
            var id  =   this.id; var val = this.value.replace(/[^0-9]/g,''); $(this).val(val); if($(this).val() == ''){ $(this).val(0); }
        });
    });
    
//    function confirmDelete(id,row){
//        var cnf      =   confirm("Are you sure?!");
//        if(cnf){ 
//            $.ajax({
//                type: "POST",
//                url: "{{url('attribute/value/delete')}}",
//                data: { "_token": "{{csrf_token()}}", id: id},
//                success: function (data) { deleteValue(row); }
//            });
//        }else{ return false; }
//    }
    function deleteValue(id){ $('#adminForm #attr-val-row-'+id).remove();}
    
    function updateStatus(id,rowId,status,url,row,field,smsg){  
        $.ajax({
            type: "POST",
            url: url,
            data: {id: id, value: status,field: field,page: row},
            success: function (data) {  
                if(field == 'is_deleted'){ 
                    $('#active_filter').trigger('change'); toastr.success(smsg);
                }else{ 
                    if($('#active_filter').val() != ''){ $('#active_filter').trigger('change'); }
                    if (data.type == 'warning' || data.type == 'error'){ toastr.error(smsg); }else{ toastr.success(smsg); }
                } 
            }
        }); return false;
    }

</script>
@endsection