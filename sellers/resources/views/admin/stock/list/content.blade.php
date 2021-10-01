<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title mb-0">{{$title}}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fe fe-grid mr-2 fs-14"></i>Seller Management</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">{{$title}}</a></li>
        </ol>
    </div>
<!--    <div class="page-rightheader">
        <div class="btn btn-list">
            <a href="" id="addData" class="btn btn-primary addmodule"><i class="fe fe-plus mr-1"></i> Add New</a>
        </div>
    </div>-->
</div>

<div class="row flex-lg-nowrap">
    <div class="col-12">
        <div class="row flex-lg-nowrap">
            <div class="col-12 mb-3">
                <div class="e-panel card">
                    <div class="card-body">
                        <div class="card-body table-card-body">
                            <div>
                                <table id="stock" class="stock-table table table-striped table-bordered w-100 text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="wd-15p notexport">Select</th>
                                            <th class="wd-15p">Seller</th>
                                            <th class="wd-15p">Product</th>
                                            <th class="wd-15p">Type</th>
                                            <th class="wd-20p">Qty.</th>
                                            <th class="wd-10p">Created On</th>
                                            <th class="wd-25p text-center notexport action-btn">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($stocks && count($stocks) > 0) @php $n = 0; @endphp
                                            @foreach($stocks as $row) @php $n++; @endphp <?php // echo '<pre>'; print_r($row->price($row->prd_id)); echo '</pre>'; die; ?>
                                                <tr class="dtrow" id="dtrow-{{$row->id}}">
                                                    <td><span class="d-none">{{$n}}</span></span></td>
                                                    <td>{{$row->product->seller->fname}}</td> 
                                                    <td>{{$row->product->name}}</td> 
                                                    <td>{{$row->type}}</td> 
                                                    <td>{{$row->stock}}</td> 
                                                    <td>{{date('d M Y',strtotime($row->created_at))}}</td>
                                                    <td class="text-center">
                                                        <button id="editForm-{{$row->id}}" data-seller="{{$row->product->seller->seller_id}}" data-product="{{$row->prd_id}}" class="mr-2 btn btn-info btn-sm editForm"><i class="fa fa-plus mr-1"></i>Add Stock</button>
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

