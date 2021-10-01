
<style> .no-border{ border: none } .invoice i.fa{ color: #ff0000; font-size: 10px; } </style>
@php 
$n_img = 1; $currency = getCurrency()->name;
@endphp
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title mb-0">{{$title}}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fe fe-grid mr-2 fs-14"></i>Support</a></li>
            <li class="breadcrumb-item active list-li" aria-current="page"><a href="#">{{$title}}</a></li>
            <!-- <li class="breadcrumb-item view-li no-disp"><a id="bc_list" href="">Order List</a></li> -->
            <li class="breadcrumb-item active view-li no-disp" aria-current="page"><a href="#">{{$title}}</a></li>
        </ol>
    </div>
    
</div>


<div id="content_list">@include('admin.support_customer.list')</div>
<div id="content_detail"></div>
@section('js') 
 <script src="{{asset('admin/assets/js/datatable/tables/ticket-datatable.js')}}"></script>

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
       
        
        
  //CHAT
        $('body').on('click','.viewBtn',function(){
            
            var id      =   this.id.replace('viewBtn-','');  
            var sellerId = 0;
            
            $.ajax({
                type: "GET",
               url: '{{url("admin/customer/support/chat")}}/'+id+"/chat",
                success: function (data) {
                    $('#chatmodel').modal('show');
                    $('.chat_content').html(data);
                 
                } 
            }); return false;
        });

//Create
        $('body').on('click','.createbtn',function(){
            
            var id      =   this.id.replace('create-','');  
          
            
            $.ajax({
                type: "GET",
               url: '{{url("admin/customer/support/create")}}/'+id+"/view",
                success: function (data) {
                    
                    $('.modal-body').html(data);
                     $('#normalmodal').modal('show'); 
                     // $('#content_detail').fadeIn(700); $('#content_list').hide(); 
                 
                } 
            }); return false;
        });


    

    });

     function submitThisForm(id){
       // e.preventDefault(); 
        var support_id = $('.support_id').val();
        var msg = $('.textareas').val();
        var cust_id = $('.cust_id').val();
       // var postid = $('#post_id').val();
       var id=0;
       //var form_data = new FormData(document.getElementById("form_submit"));
       
       //alert(msg);
       $.ajax({
           type: "POST",
           url: '{{url("admin/customer/support/create")}}/'+id+"/create",
           data: {msg:msg, support_id:support_id,cust_id:cust_id},
           success: function( msg ) {
              // alert( msg );
               $('#normalmodal').modal('hide'); 
           }
       });
   }

   
  
    
    
    function readURL(input) { 
        if (input.files && input.files[0]) { 
            var reader = new FileReader();
            reader.onload = function (e) { $('#adminForm #'+input.id+'Img').attr('src', e.target.result); $('#adminForm #'+input.id+'Img').show(); }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
