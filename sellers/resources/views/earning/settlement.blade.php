<style> 
    .form-control{ max-width: 150px; } #settlement_filter{ float: right !important;} 
</style>

<div class="modal-header">
    <h5 class="modal-titlee" id="exampleModalLongTitle">Settlements</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row flex-lg-nowrap">
        <div class="col-12">
            <button id="payBtn-2" class="mr-2 btn btn-success btn-sm payBtn" data-page="settlements" data-seller="{{auth()->user()->id}}" data-toggle="modal" data-target=".bd-example-modal-sm">Make Payment</button>
            <div class="row flex-lg-nowrap">
                <div class="col-12 mb-3">
                    <div id="table_body" class="card-body table-card-body">
                        <div>
                            <table id="settlement" class="settlement-table table table-striped table-bordered w-100 text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="wd-15p notexport">Select</th>
                                        <th class="wd-15p">Date</th>
                                        <th class="text-right" class="wd-10p">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($settlements && count($settlements) > 0) @php $n = 0; @endphp
                                        @foreach($settlements as $row) @php $n++; @endphp
                                            @php 
                                            @endphp
                                            <tr class="dtrow" id="dtrow-{{$row->id}}">
                                                <td><span class="d-none">{{$n}}</span></span></td>
                                                <td>{{date('d M Y',strtotime($row->created_at))}}</td>
                                                <td class="text-right">{{ getCurrency()->name }} {{$row->amount}}</td>
                                            </tr>
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
<div class="col-lg-12 modal-footer">
    <div class="">
        <button id="cancel_btn" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
</div>
<script src="{{URL::asset('admin/assets/js/datatable/tables/settlement-datatable.js')}}"></script>

