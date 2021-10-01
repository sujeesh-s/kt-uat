<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title mb-0">{{$title}}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fe fe-grid mr-2 fs-14"></i>User Management</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">{{$title}}</a></li>
        </ol>
    </div>
    <div class="page-rightheader" style="display:flex; flex-direction: row; justify-content: center; align-items: center">
        <label class="form-label mr-2" for="filterSel">Filter </label>
        {{Form::select('active',[1=>'Avtive',0=>'Inactive'],$active,['id'=>'active_filter','class'=>'form-control mr-4','placeholder'=>'All Status'])}}
        <div class="btn btn-list">
            <a id="addNew"   class="btn btn-primary addmodule"><i class="fe fe-plus mr-1"></i> Add New</a>
        </div>
    </div>
</div>
<div class="row flex-lg-nowrap">
    <div class="col-12">
        <div class="row flex-lg-nowrap">
            <div class="col-12 mb-3">
                <div class="e-panel card">
                    <div id="data-content" class="card-body">
                       
                        <div id="table_body" class="card-body table-card-body">
                            <div>
                                    <table id="attribute" class="seller-table table table-striped table-bordered w-100 text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="wd-15p notexport">ID</th>
                                            <th class="wd-15p">Store Name</th>
                                            <th class="wd-15p">Seller Name</th>
                                            <th class="wd-15p">Email</th>
                                            <th class="wd-20p">Phone</th>
                                            <th class="wd-10p">Created On</th>
                                            <th class="wd-25p notexport">Status</th>
                                            <th class="wd-25p text-center notexport action-btn">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($sellers && count($sellers) > 0) @php $n = 0; @endphp
                                            @foreach($sellers as $row) @php $n++; @endphp
                                                @php if($row->is_active == 1){ $active = "Active"; $checked = 'checked'; }else if ($row->is_active == 0){ $active = "Inactive"; $checked = ""; } @endphp
                                                <tr class="dtrow" id="dtrow-{{$row->id}}">
                                                    <td><span class="d-none">{{$n}}</span></td>
                                                    <td><a id="dtlBtn-{{$row->seller_id}}" class="font-weight-bold viewDtl">{{$row->store($row->seller_id)->store_name}}</a></td> 
                                                    <td>{{$row->fname.' '.$row->lname}}</td>
                                                    <td>{{$row->sellerMst->teleEmail->value}}</td>
                                                    <td>{{$row->sellerMst->telePhone->value}}</td>
                                                    <td>{{date('d M Y',strtotime($row->created_at))}}</td>
                                                    <td>
                                                        <div class="switch">
                                                            <input class="switch-input status-btn" id="status-{{$row->sellerMst->id}}" type="checkbox" {{$checked}} name="status">
                                                            <label class="switch-paddle" for="status-{{$row->sellerMst->id}}">
                                                                <span class="switch-active" aria-hidden="true">Active</span>
                                                                <span class="switch-inactive" aria-hidden="true">Inactive</span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        @if(checkPermission('admin/sellers','edit') == true)
                                                        <button id="editBtn-{{$row->seller_id}}" class="mr-2 btn btn-info btn-sm editBtn"><i class="fa fa-edit mr-1"></i>Edit</button>
                                                         @endif
                                                         @if(checkPermission('admin/sellers','delete') == true)
                                                        <button id="delBtn-{{$row->seller_id}}" class="mr-2 btn btn-secondary btn-sm delBtn"><i class="fe fe-trash-2 mr-1"></i>Delete</button>
                                                        @endif
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

 <script src="{{asset('admin/assets/js/datatable/tables/seller-datatable.js')}}"></script>
 