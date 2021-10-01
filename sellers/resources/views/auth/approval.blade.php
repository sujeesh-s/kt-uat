@extends('layouts.master2')
@section('css')
<link rel="stylesheet" href="{{URL::asset('admin/assets/css/toastr.min.css')}}" />
<style>
.c-text {
    font-size: 16px;
}
</style>
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
                                <h4 class="display-4 mb-5 font-weight-bold error-text text-center"><strong>Approval Pending</strong></h4>
                               
                                @csrf
                                <div class="row">
                                    <div class="col-12 d-block mx-auto">
                                        <p class="c-text">Your account is still waiting for the approval from the Admin. Please retry after recieving the admin approval mail confirmation, or you can contact admin directly using below link.</p>
                                    </div>
                                </div>
                            </form>
                            <div class="pt-4 text-center">
                                    <div class="font-weight-normal fs-16"><a class="btn-link font-weight-bold text-decoration- underline text-white-80" href="{{ url('login')}}"><b>Contact Admin</b></a></div>
                            </div>
                            <div class="pt-4 text-center">
                                    <div class="font-weight-normal fs-1<6"><a class="btn-link font-weight-normal text-white-80" href="{{ url('login')}}">Back to login page</a></div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <!--<div class="col-md-6 d-none d-md-flex align-items-center">-->
                    <!--	<img src="{{URL::asset('assets/images/png/login.png')}}" alt="img">-->
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
        $('#updatePass').on('submit',function(){
            var result  =   true;   var pass    =   $('#password').val();   var cPass   =    $('#confirm_password').val();
            if($('#email').val() != $('#usr_email').val()){ toastr.error("Entered incorrect Email"); result = false; }
            if(pass != cPass){ toastr.error("The password not match with comfirm password"); result = false; }
            if(pass.length < 6){ toastr.error("The password must be at least 6 characters"); result = false; }
            if(result == true){ return true; }else{ return false; } return false;
        });
    });
</script>
@endsection