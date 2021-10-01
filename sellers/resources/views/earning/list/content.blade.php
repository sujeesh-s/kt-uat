<!--<div class="page-header">-->
<!--    <div class="page-leftheader">-->
<!--        <h4 class="page-title mb-0">{{$title}}</h4>-->
<!--        <ol class="breadcrumb">-->
<!--            <li class="breadcrumb-item"><a href="#"><i class="fe fe-grid mr-2 fs-14"></i>Seller Management</a></li>-->
<!--            <li class="breadcrumb-item active" aria-current="page"><a href="#">{{$title}}</a></li>-->
<!--        </ol>-->
<!--    </div>-->
<!--    <div class="page-rightheader">-->
<!--        <button id="payBtn-1" class="btn btn-white payBtn" data-page="earnings" data-seller="{{auth()->user()->id}}" data-toggle="modal" data-target=".bd-example-modal-sm">Make Payment</button>-->
<!--        <div class="btn btn-list">-->
<!--            <a href="" id="settleData" class="btn btn-white" data-seller="{{auth()->user()->id}}" data-toggle="modal" data-target="#exampleModal"> Settlements</a>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<div class="row flex-lg-nowrap">
    <div class="col-12">
        <div class="row flex-lg-nowrap">
            <div class="col-12 mb-3">
                <div class="e-panel card">
                    <div class="card-body">
                        <div id="table_body" class="card-body table-card-body">
                            <div>
                                <table id="attribute" class="earning-table table table-striped table-bordered w-100 text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="wd-15p notexport">Select</th>
                                            <th class="wd-15p">Order ID</th>
                                            <th class="wd-15p">Seller</th>
                                            <th class="wd-15p">Date</th>
                                            <th class="wd-20p">Delivery Status</th>
                                            <th class="wd-10p">Amount</th>
                                            <th class="wd-25p notexport">Commission</th>
                                            <th class="wd-25p notexport">Earnings</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($earnings && count($earnings) > 0) @php $n = 0; @endphp
                                            @foreach($earnings as $row) @php $n++; @endphp
                                                @php 
                                                @endphp
                                                <tr class="dtrow" id="dtrow-{{$row->id}}">
                                                    <td><span class="d-none">{{$n}}</span></span></td>
                                                    <td><a id="dtlBtn-{{$row->id}}" class="font-weight-bold">#{{$row->order_id}}</a></td> 
                                                    <td>{{$row->seller->sellerInfo->fname}}</td>
                                                    <td>{{date('d M Y',strtotime($row->created_at))}}</td>
                                                    <td>{{$row->shipping_status}}</td>
                                                    <td>{{ getCurrency()->name }} {{$row->g_total}}</td>
                                                    <td>{{ getCurrency()->name }} {{$row->ecom_commission}}</td>
                                                    <td>{{ getCurrency()->name }} {{($row->g_total-$row->ecom_commission)}}</td>
                                                    
                                            @endforeach
                                        @endif
                                    </tbody>

                                </table>
                                {{ csrf_field() }}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{URL::asset('admin/assets/js/datatable/tables/earning-datatable.js')}}"></script>

