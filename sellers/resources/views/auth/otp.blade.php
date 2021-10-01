@extends('layouts.master2')
@section('css')
<link rel="stylesheet" href="{{URL::asset('admin/assets/css/toastr.min.css')}}" />
@endsection
@section('content')
<div class="page">
    <div class="page-content">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-6">
                    <div class="">
                        <div class="text-white">
                            <div class="card-body">
                                <h2 class="display-4 mb-5 font-weight-bold error-text text-center"><strong>OTP Verification</strong></h2>
                                <form method="POST" action="{{ url('verify/otp') }}" id="otpform">
                                @csrf
                                <div class="row">
                                    <div class="col-9 d-block mx-auto">
                                        
                                        <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa fa-key"></i></div>
                                            </div>
                                            <input id="token" type="password" class="form-control" name="token" placeholder="OTP" title="Enter OTP" autocomplete="off" required />
                                        </div> 
                                        
                                        <button type="submit" class="btn btn-secondary btn-block px-4" style="background-color:#fff; color:#f00 !important; padding:10px;"><i class="fe fe-send"></i> Send</button>
                                       
                                    </div>
                                </div>
                            </form>
                            <div class="pt-4 text-center">
                                    <div class="font-weight-normal fs-1<6"><a class="btn-link font-weight-normal text-white-80" href="{{ url('login')}}">Back to login page</a></div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <!--<div class="col-md-6 d-none d-md-flex align-items-center">-->
                    <!--    <img src="{{URL::asset('assets/images/png/login.png')}}" alt="img">-->
                    <!--</div>-->
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{URL::asset('admin/assets/js/toastr.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){ 
        $('#otpform').on('submit',function(){
            var result  =   true;   var token    =   $('#token').val();  
            if(token ==""){ toastr.error("Please enter the OTP."); result = false; }
            if(result == true){ return true; }else{ return false; } return false;
        });
    });
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
@endsection