@extends('layouts.admin')
@section('css')
		<!-- INTERNAl Data table css -->
		<link href="{{URL::asset('admin/assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
		<link href="{{URL::asset('admin/assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}"  rel="stylesheet">
		<link href="{{URL::asset('admin/assets/plugins/datatable/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
		<link href="{{URL::asset('admin/assets/plugins/sweet-alert/jquery.sweet-modal.min.css')}}" rel="stylesheet" />
		<link href="{{URL::asset('admin/assets/plugins/sweet-alert/sweetalert.css')}}" rel="stylesheet" />
		<link href="{{URL::asset('admin/assets/css/combo-tree.css')}}" rel="stylesheet" />
		<link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.0.45/css/materialdesignicons.min.css">
		<link href="{{URL::asset('admin/assets/css/datepicker.css')}}" rel="stylesheet" />
		<link href="{{URL::asset('admin/assets/css/chosen.min.css')}}" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="{{URL::asset('admin/assets/css/bootstrap-datetimepicker.min.css')}}">
@endsection
@section('page-header')
						<!--Page header-->


						<div class="page-header">
							<div class="page-leftheader">
								<h4 class="page-title mb-0">{{ $title }}</h4>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#"><i class="fe fe-grid mr-2 fs-14"></i>Product Management</a></li>
									<li class="breadcrumb-item"><a href="{{ url('shocking-sales')}}"><i class="fe fe-grid mr-2 fs-14"></i>Shocking Sale</a></li>
									
									<li class="breadcrumb-item active" aria-current="page"><a href="#">{{ $title }}</a></li>
								</ol>
							</div>
							<div class="page-rightheader">
						
							</div>
						</div>
                        <!--End Page header-->
@endsection
@section('content')
						<!-- Row -->
						<div class="row flex-lg-nowrap">
							<div class="col-12">

						
								<div class="row flex-lg-nowrap">
									<div class="col-12 mb-3">
										<div class="e-panel card">
											<div class="card-body">
												<div class="e-table">
													<div class="table-responsiv table-lg mt-3">
													{{ Form::open(array('url' => "/shocking-sales/save", 'id' => 'shocksaleForm', 'name' => 'shocksaleForm', 'class' => '','files'=>'true')) }}
												
												{{Form::hidden('id',$shockingsale['id'],['id'=>'saleid'])}}
												{{Form::hidden('title_cid',$shockingsale['title_cid'],['id'=>'title_cid'])}}
												<div class="py-1">
													
														<div class="row">
															<div class="col">
																<div class="row">

																	

																	<div class="col">
																		<div class="form-group">

																			
																			<label class="form-label">Product <span class="text-red">*</span></label>
																		
																			<select class="form-control chosen-select" data-placeholder="Select Product" multiple  name="prd_id[]" id="prd_id" required >
																			


																			@if($products && count($products) > 0)
																			@foreach($products as $row)

																			
																			<option value="{{ $row->id }}">{{ $row->name }}</option>
																			@endforeach
																			@endif
																			</select>
																		</div>
																		<p style="color: red" id="errNm1"></p>
																		@error('prd_id')
																	<p style="color: red" class="error">{{ $message }}</p>
																	@enderror
																	</div>

																	
																</div>
															

																<div class="row">
																<div class="col">
																<div class="form-group">
																<label class="form-label">Caption <span class="text-red">*</span></label>

																{!! Form::text('caption', $shockingsale['title'], ['class' => 'form-control','rows' => 3,'disabled','id'=>'caption']) !!}
																</div>
																@error('caption')
																<p style="color: red" class="error">{{ $message }}</p>
																@enderror

																</div>

														
																	<div class="col">
																		<div class="form-group">
																			<label class="form-label">Start Date <span class="text-red">*</span></label>
<div class="input-group date" id="" data-target-input="nearest">
<input type="text" class="form-control datetimepicker-input" name="sale_start" data-target="#sale_start"  value="{{ $shockingsale['start_time'] }}" disabled />
<div class="input-group-append" data-target="#sale_start" data-toggle="datetimepicker">
<div class="input-group-text"><i class="fa fa-calendar"></i></div>
</div>
</div>
																		</div>
																		<p style="color: red" id="errNm3"></p>
																		@error('sale_start')
																	<p style="color: red" class="error">{{ $message }}</p>
																	@enderror
																		
																	</div>

																	<div class="col">
																		<div class="form-group">
																			<label class="form-label">End Date <span class="text-red">*</span></label>
																			
																			<div class="input-group date" id="sale_end" data-target-input="nearest">
<input type="text" class="form-control datetimepicker-input" name="sale_end" data-target="#sale_end" value="{{ $shockingsale['end_time'] }}" disabled  />
<div class="input-group-append" data-target="#sale_end" data-toggle="datetimepicker">
<div class="input-group-text"><i class="fa fa-calendar"></i></div>
</div>
</div>
																		</div>
																		<p style="color: red" id="errNm2"></p>
																		@error('sale_end')
																	<p style="color: red" class="error">{{ $message }}</p>
																	@enderror
																		
																	</div>
																</div>
																<div class="row">
															<div class="col">
															<div class="form-group">
															<label class="form-label">Offer Value <span class="text-red">*</span></label>

															{!! Form::text('offer_value', $shockingsale['discount_value'], ['class' => 'form-control','disabled','rows' => 3,'id'=>'offer_value']) !!}
															</div>
															</div>
															<div class="col">
															<div class="form-group">
															<label class="form-label">Offer Type </label>

															<select name="ofr_type" id="ofr_type" class="form-control" disabled>
																<option value="percentage" <?php if($shockingsale['discount_type']=="percentage"){ echo "selected";}?> >Percentage</option>
																<option value="amount" <?php if($shockingsale['discount_type']=="amount"){ echo "selected";}?>>Amount</option>
																
															</select>
															</div>
															</div>
															<div class="col">
																		<div class="form-group">
																			<label class="form-label">Status <span class="text-red">*</span></label>
																	
																			{!! Form::select('is_active', array('1' => 'Active', '0' => 'Inactive'),$shockingsale['is_active'],['class' => 'form-control','disabled','required','id'=>'coupon_status']); !!}
																		</div>
																		@error('is_active')
																	<p style="color: red" class="error">{{ $message }}</p>
																	@enderror
																	</div>

															</div>
																
																<div class="row">
																	
																	




																	
																	
																	
																</div>
																
																

																
															</div>
														</div>
														
														<div class="row">
															<div class="col d-flex justify-content-end">
															<input class="btn btn-primary" type="submit" id="frontval" value="Save Changes">
															</div>
														</div>
													
												</div>
												{{Form::close()}}

													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- End Row -->


								

					</div>
				</div><!-- end app-content-->
            </div>
<style type="text/css">
	.radio-opts {
		margin-top: 10px;
	}

.chosen-container-multi .chosen-choices {
    padding: 4px 10px;
    border: 1px solid #e3e4e9;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    border-radius: 5px;
}

</style>

@endsection
@section('js')
		<!-- INTERNAl Data tables -->
<script src="{{URL::asset('admin/assets/js/jquery.validate.min.js')}}"></script>

<script src="{{URL::asset('admin/assets/js/chosen.jquery.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('admin/assets/js/moment.js')}}"></script>
<script src="{{URL::asset('admin/assets/js/bootstrap-datetimepicker.min.js')}}"></script>
		<script src="{{URL::asset('admin/assets/js/datatables.js')}}"></script>
	<!-- INTERNAL Popover js -->
		<script src="{{URL::asset('admin/assets/js/popover.js')}}"></script>
		<script src="{{URL::asset('admin/assets/js/bootstrap-datepicker.js')}}"></script>
		<!-- INTERNAL Sweet alert js -->
		<script src="{{URL::asset('admin/assets/plugins/sweet-alert/jquery.sweet-modal.min.js')}}"></script>
		<script src="{{URL::asset('admin/assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
		<script src="{{URL::asset('admin/assets/js/sweet-alert.js')}}"></script>
		<script src="{{URL::asset('admin/assets/js/sweet-alert.js')}}"></script>
		<script src="{{URL::asset('admin/assets/js/comboTreePlugin.js')}}"></script>
<script type="text/javascript">



	jQuery(document).ready(function(){


$("#frontval").click(function(){

$("#shocksaleForm").validate({
	ignore: [],
rules: {


"prd_id[]": {
required: true
}


},

messages : {

"prd_id[]": {
required: "Product is required."
},



},


 errorPlacement: function(error, element) {
 	 $("#errNm1").empty();
 	 console.log($(error).text());
            if (element.attr("name") == "prd_id[]" ) {
            	console.log("innnnnn");
                $("#errNm1").text($(error).text());
                
            }else if (element.attr("name") == "sale_end" ) {
                $("#errNm2").text($(error).text());
                
            }else if (element.attr("name") == "sale_start" ) {
                $("#errNm3").text($(error).text());
                
            }else {
               error.insertAfter(element)
            }
        },

});
});




	});
</script>

<script type="text/javascript">
    $(document).ready(function(){
            @if(Session::has('message'))
            @if(session('message')['type'] =="success")
            
            toastr.success("{{session('message')['text']}}"); 
            @else
            toastr.error("{{session('message')['text']}}"); 
            @endif
            @endif
            
            @if ($errors->any())
            @foreach ($errors->all() as $error)
            toastr.error("{{$error}}"); 
            
            @endforeach
            @endif
    });
    </script>


<script type="text/javascript">

  
    $('#prd_id').on('change',function()
        {
               $("#errNm1").empty();
            
        });

  


$(document).ready(function(){


$(".chosen-select").chosen({
  no_results_text: "Oops, nothing found!"
})


});



</script>
@endsection