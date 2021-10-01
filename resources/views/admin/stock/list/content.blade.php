<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title mb-0">{{$title}}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fe fe-grid mr-2 fs-14"></i>Seller Management</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">{{$title}}</a></li>
        </ol>
    </div>

</div>

<div class="row flex-lg-nowrap">
    <div class="col-12">
        <div class="row flex-lg-nowrap">
            <div class="col-12 mb-3">
                <div class="e-panel card">
                    <div class="card-body">
                        <div class="card-body table-card-body">
                            <div class="table-responsive">
                                <table id="stock" class="stock-table table table-striped table-bordered w-100 text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="wd-15p notexport">Select</th>
                                            <th class="wd-15p">Seller</th>
                                            <th class="wd-15p">Product</th>
                                            <th class="wd-15p tar">Price ({{getCurrency()->name}})</th>
                                            <th class="wd-20p tar">Stock</th>
                                            <th class="wd-25p text-center notexport action-btn">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($products && count($products) > 0) @php $n = 0; @endphp
                                            @foreach($products as $row) @php $n++; @endphp <?php // echo '<pre>'; print_r($row->price($row->prd_id)); echo '</pre>'; die; ?>
                                                <tr class="dtrow" id="dtrow-{{$row->id}}">
                                                    <td><span class="d-none">{{$n}}</span></span></td>
                                                    <td>{{$row->seller->fname}}</td> 
                                                    <td>{{$row->name}}</td> 
                                                    <td class="tar">{{$row->prdPrice->price}}</td> 
                                                    <td class="tar">{{$row->prdStock($row->id)}}</td> 
                                                    <td class="text-center">
                                                        {{Form::hidden('prd_name_'.$row->id,$row->name,['id'=>'prd_name_'.$row->id])}}{{Form::hidden('slr_name_'.$row->id,$row->seller->fname,['id'=>'slr_name_'.$row->id])}}{{Form::hidden('prd_price_'.$row->id,$row->prdPrice->price,['id'=>'prd_price_'.$row->id])}}
                                                        {{Form::hidden('sale_price_'.$row->id,$row->prdPrice->sale_price,['id'=>'sale_price_'.$row->id])}}{{Form::hidden('sale_start_date_'.$row->id,$row->prdPrice->sale_start_date,['id'=>'sale_start_date_'.$row->id])}}{{Form::hidden('sale_end_date'.$row->id,$row->prdPrice->sale_end_date,['id'=>'sale_end_date_'.$row->id])}}
                                                        <button id="editForm-{{$row->id}}" data-seller="{{$row->seller->seller_id}}" data-product="{{$row->id}}" class="mr-2 btn btn-info btn-sm editForm" data-toggle="modal" data-target=".bd-example-modal"><i class="fa fa-plus mr-1"></i>Add Stock</button>
                                                        <button id="addPice-{{$row->id}}" data-seller="{{$row->seller->seller_id}}" data-product="{{$row->id}}" class="mr-2 btn btn-info btn-sm addPice" data-toggle="modal" data-target=".bd-example-modal"><i class="fa fa-plus mr-1"></i>Add Price</button>
                                                        <button id="viewForm-{{$row->id}}" class="mr-2 btn btn-success btn-sm viewForm"><i class="fa fa-eye mr-1"></i>View</button>
                                                    </td>
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
<script src="{{URL::asset('admin/assets/js/datatable/tables/stock-datatable.js')}}"></script>
