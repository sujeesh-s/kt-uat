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
		<link href="{{URL::asset('admin/assets/css/daterangepicker.css')}}" rel="stylesheet" />
		<link href="{{URL::asset('admin/assets/css/jquery-ui.css')}}" rel="stylesheet" />
@endsection
@section('page-header')
						<!--Page header-->


						<div class="page-header">
							<div class="page-leftheader">
								<h4 class="page-title mb-0">{{ $title }}</h4>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#"><i class="fe fe-grid mr-2 fs-14"></i>Ecom Benefits</a></li>
									
									<li class="breadcrumb-item active" aria-current="page"><a href="#">{{ $title }}</a></li>
								</ol>
							</div>
											<div class="page-rightheader" style="display:flex; flex-direction: row; justify-content: center; align-items: center">
								<label class="form-label" for="filterSel" style="margin-right: 8px;">Filter </label>
							
								<select class="form-control" id="filterCpn" style="margin-right: 30px;">
								<option value="">Coupon</option>
								@if($coupons && count($coupons) > 0)
								@foreach($coupons as $row)

								<option value="{{$row['id']}}" @if($cpn_id ==$row['id'] ) {{ "selected" }} @endif >{{$row['cpn_title']}}</option>

								@endforeach
								@endif

								</select>
								<div class="btn btn-list">
									<!-- <a href="#" class="btn btn-info"><i class="fe fe-settings mr-1"></i> General Settings </a>
									<a href="#" class="btn btn-danger"><i class="fe fe-printer mr-1"></i> Print </a> -->
									
								</div>
							</div>
						</div>

							<div class="row" id="filterrow">
							<div class="plus-minus-toggle collapsed"><p>Additional Filters</p></div> 

							</div>
							<div class="row" id="filtersec" style="display:none; margin-bottom: 20px;">
							<div class="col-4">
							<div class="page-filters"  >
							<div  class="datepicker input-group date">
							<input class="form-control" name="valid_from"  id="valid_from" type="text" readonly   />
							<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
							<input type="hidden" id="startdate" value="<?php echo date("Y-m-d"); ?>">
							<input type="hidden" id="enddate" value="<?php echo date("Y-m-d"); ?>">
							</div>
							
							</div>
							</div>
							<div class="col-5">
							<div class="page-filters" style="display: inline-flex;">

							<a  id="viewfilter"  class="mr-2 btn btn-info btn-sm cursor"><i class="fa fa-check-circle"></i> Apply</a>

							</div>								
							</div>
							
							

							</div>

                        <!--End Page header-->
@endsection
@section('content')
						<!-- Row -->
						<div class="row flex-lg-nowrap">
							<div class="col-12">

								<!--@if(Session::has('message'))-->

								<!--<div class="alert alert-{{session('message')['type']}}" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{session('message')['text']}}</div>-->
								<!--@endif-->
								<!--@if ($errors->any())-->
								<!--@foreach ($errors->all() as $error)-->

								<!--<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>{{$error}}</div>-->
								<!--@endforeach-->
								<!--@endif-->
								<div class="row flex-lg-nowrap">
									<div class="col-12 mb-3">
										<div class="e-panel card">
											<div class="card-body">
												<div class="e-table">
													<div class="table-responsive table-lg mt-3">
														<table class="table table-bordered border-top text-nowrap couponloglist" id="couponloglist">
															<thead>
																<tr>
																	<th class="align-top border-bottom-0 wd-5 notexport">Select</th>
																	<th class="border-bottom-0 w-20">Order ID</th>
																	
																	<th class="border-bottom-0 w-30">Customer ID</th>
																	<th class="border-bottom-0 w-30">Date of purchase</th>
																	<th class="border-bottom-0 w-30">Order value</th>
																	<th class="border-bottom-0 w-30">Coupon Value</th>
																																		
																</tr>
															</thead>

															<tbody>

																@if($log && count($log) > 0)
                    											@foreach($log as $row)
																<tr>
																	<td class="align-middle select-checkbox" id="moduleid" data-value="{{$row['id']}}">
																		<label class="custom-control custom-checkbox">
																			
																			<!--{{ $loop->iteration }}-->
																		</label>
																	</td>
																	<td class="align-middle" >
																		<div class="d-flex">
																	
																	<h6 class=" font-weight-bold"> <?php echo date('y',strtotime($row['created_at'])).date('m',strtotime($row['created_at'])).$row['order_id']; ?> </h6>
																				
																			
																		</div>
																	</td>
																	<td class="align-middle" >
																		<div class="d-flex">
																		<p>{{$row['user_name']}}</p>
																	</div>
																	</td>
																	<td class="align-middle" >
																		<div class="d-flex">
																			<p>{{ date('Y-m-d',strtotime($row['created_at'])) }}
																			</p>
																		</div>
																	</td>
																	<td class="align-middle" >
																		<div class="d-flex">
																			<p>{{ ucfirst($row['order_value']) }}</p>
																		</div>
																	</td>
																	<td class="align-middle" >
																		<div class="d-flex">
																			<p>{{ ucfirst($row['ofr_value']) }}</p>
																		</div>
																	</td>
																	
																	
																	
																	
																	
																	
																	
																</tr>
																     @endforeach
                @endif
																
																
																
																
															</tbody>
														</table>
														
													</div>
													
												</div>
												
											</div>
										
										</div>
										<div class="row">
															<div class="col d-flex justify-content-end">
																<a href="{{url('/coupons')}}"  class="mr-2 btn btn-secondary" >Back</a>
															</div>
														</div>
											
									</div>
								</div>
							</div>
						</div>
						<!-- End Row -->


						<!-- Add Form Modal -->

							<div style="display:none;">
								<table id="hiddentable" style="display: none;">
									<tbody>
										
									</tbody>
								</table>
								
							</div>
						
								
								

					</div>
				</div><!-- end app-content-->
            </div>


<style type="text/css">
	table.dataTable tr.parent {
animation: none !important;
	}
	table.dataTable tr.selected p {
color: #fff;
	}
</style>

@endsection
@section('js')
		<!-- INTERNAl Data tables -->

		<script src="{{URL::asset('admin/assets/js/datatable/tables/couponloglist-datatable.js')}}"></script>
	<!-- INTERNAL Popover js -->
		<script src="{{URL::asset('admin/assets/js/popover.js')}}"></script>
		<script src="{{URL::asset('admin/assets/js/comboTreePlugin.js')}}"></script>
				<script src="{{URL::asset('admin/assets/js/moment.min.js')}}"></script>
		<script src="{{URL::asset('admin/assets/js/daterangepicker.js')}}"></script>

		<!-- INTERNAL Sweet alert js -->
		<script src="{{URL::asset('admin/assets/plugins/sweet-alert/jquery.sweet-modal.min.js')}}"></script>
		<script src="{{URL::asset('admin/assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
		<script src="{{URL::asset('admin/assets/js/sweet-alert.js')}}"></script>
<script type="text/javascript">


	jQuery(document).ready(function(){

$('#filterCpn').on( 'change', function(){ 

var sel = $(this).val();
window.location = "{{ url('/coupons/log/') }}/"+sel;
 } );


// Prompt
	


        
        $('#userrole').DataTable({
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
			lengthMenu: '_MENU_',
		}
	});
        
	});


$(document).ready(function(){

  $('#valid_from').daterangepicker
        (
          {
            locale: {
                      format: 'DD/MM/YYYY'
                    },
            ranges:
            {
              'Today'       : [moment(), moment()],
              'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
              'Tomorrow'    : [moment().add(1, 'days'), moment().add(1, 'days')],
              'Next 7 Days' : [moment(),moment().add(6, 'days')],
              'Next 30 Days': [moment(),moment().add(29, 'days')],
              'This Month'  : [moment().startOf('month'), moment().endOf('month')],
              'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
          },
          function(start, end, label)
          {
            startDate = start.format('YYYY-MM-DD');
            endDate = end.format('YYYY-MM-DD');
            console.log('A date range was chosen: ' + startDate + ' to ' + endDate);
            $("#startdate").val(startDate);
            $("#enddate").val(endDate);
      
        
          }
        );





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
$(function() {
$('.plus-minus-toggle').on('click', function() {
$(this).toggleClass('collapsed');
$('#filtersec').toggle('slow');
});
});
</script>
@endsection