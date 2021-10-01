<div class="tab-pane" id="tab5">
    <div class="card-header mb-4"><div class="card-title">Store Settings</div></div>
{{Form::hidden('bank_id',$bank_id,['id'=>'bank_id'])}}
    <div class="col-lg-6 fl">
        <div class="form-group">
            <label>Account Number <span class="text-red">*</span></label>

{!! Form::text('acc_number', $ac_no, ['class' => 'form-control','required','id'=>'acc_number']) !!}
            <span class="error"></span>
        </div>
    </div>
    <div class="col-lg-6 fl ">
        <div class="form-group">
<label>Bank Name <span class="text-red">*</span></label>

{!! Form::text('bank_name', $bank_name, ['class' => 'form-control','required','id'=>'bank_name']) !!}
            <span class="error"></span>
        </div>
    </div>
     <div class="clearfix"></div>
    <div class="col-lg-6 fl ">
        <div class="form-group">
<label>Account Type <span class="text-red">*</span></label>
@php $acc_types = array("Current account"=>"Current account","Savings account"=>"Savings account","Salary account"=>"Salary account","Fixed deposit account"=>"Fixed deposit account","NRI account"=>"NRI account"); @endphp
{!! Form::select('acc_type', $acc_types, $acc_type,['class' => 'form-control','required','id'=>'acc_type']); !!}
            <span class="error"></span>
        </div>
    </div>
    <div class="col-lg-6 fl ">
        <div class="form-group">
<label>IFSC <span class="text-red">*</span></label>

{!! Form::text('ifsc', $ifsc, ['class' => 'form-control','required','id'=>'ifsc']) !!}
            <span class="error"></span>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-lg-6 fl">
        <div class="form-group">
<label>Branch Name <span class="text-red">*</span></label>

{!! Form::text('branch_name', $branch, ['class' => 'form-control','required','id'=>'branch_name']) !!}
            <span class="error"></span>
        </div>
    </div>
    <div class="col-lg-6 fl">
        <div class="form-group">
<label>Account Holder <span class="text-red">*</span></label>

{!! Form::text('acc_holder', $ac_holder, ['class' => 'form-control','required','id'=>'acc_holder']) !!}
            <span class="error"></span>
        </div>
    </div>
</div>
                    