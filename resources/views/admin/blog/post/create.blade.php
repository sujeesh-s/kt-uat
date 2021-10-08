@extends('layouts.admin')
@section('css')
		<!-- INTERNAl alert css -->
		<link href="{{URL::asset('admin/assets/plugins/sweet-alert/jquery.sweet-modal.min.css')}}" rel="stylesheet" />
		<link href="{{URL::asset('admin/assets/plugins/sweet-alert/sweetalert.css')}}" rel="stylesheet" />

        <!--INTERNAL Select2 css -->
		<link href="{{URL::asset('admin/assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />

        <!-- INTERNAL File Uploads css -->
		<link href="{{URL::asset('admin/assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
        <!-- INTERNAL File Uploads css-->
        <link href="{{URL::asset('admin/assets/plugins/fileupload/css/fileupload.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('page-header')
						<!--Page header-->


						<div class="page-header">
							<div class="page-leftheader">
								<h4 class="page-title mb-0">{{$title}}</h4>
								<ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#"><i class="fe fe-grid mr-2 fs-14"></i>Blog Management</a></li>
                                    <li class="breadcrumb-item" aria-current="page"><a href="{{url('admin/blog/posts')}}">Blog Posts</a></li>
									<li class="breadcrumb-item active" aria-current="page"><a href="#">New Post</a></li>
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
										<div class="card">
                                            <div class="card-body">
                                                <form action="{{url('admin/blog/savepost')}}" method="POST" enctype="multipart/form-data">
													    @csrf
                                                        <div class="row">
                                                        
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Post Name <span class="text-red">*</span></label>
                                                                <input type="text" class="form-control @error('bp_name') is-invalid @enderror" placeholder="Post Name" value="{{ old('bp_name') }}"  name="bp_name">
                                                                @error('bp_name')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Post Short Description <span class="text-red"></span></label>
                                                                <textarea class="form-control @error('bp_short_description') is-invalid @enderror" placeholder="Description" name="bp_short_description">{{ old('bp_short_description') }}</textarea>
																@error('bp_short_description')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Post Icon </label>
                                                                <input type="text" class="form-control @error('bp_faicon') is-invalid @enderror" placeholder="Post fa icon code Ex:fa fa-home," value="{{ old('bp_faicon') }}"  name="bp_faicon">
                                                                @error('bp_faicon')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Sort Order </label>
                                                                <input type="number" min="1" class="form-control @error('bp_sortorder') is-invalid @enderror" placeholder="Post Sort Order" value="{{ old('bp_sortorder') }}"  name="bp_sortorder">
                                                                @error('bp_sortorder')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Status <span class="text-red">*</span></label>
                                                                <select class="form-control select2" name="status">
                                                                    <option value="1">Published</option>
                                                                    <option value="0">Draft</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Seo Tags </label>
                                                                <input type="text" class="form-control @error('bp_seo_tag') is-invalid @enderror" placeholder="Post Seo Tags" value="{{ old('bp_seo_tag') }}"  name="bp_seo_tag">
                                                                @error('bp_seo_tag')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Seo Title </label>
                                                                <input type="text" class="form-control @error('bp_seo_title') is-invalid @enderror" placeholder="Post Seo Title" value="{{ old('bp_seo_title') }}"  name="bp_seo_title">
                                                                @error('bp_seo_title')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Seo Description</label>
                                                                <textarea class="form-control @error('bp_seo_description') is-invalid @enderror" placeholder="Seo Description" name="bp_seo_description">{{ old('bp_seo_description') }}</textarea>
																@error('bp_seo_description')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        
                                                            
                                                    </div>
                                                    <div class="col d-flex justify-content-end">
                                                    <a href="{{ route('admin.blogcategories')}}" class="mr-2 mt-4 mb-0 btn btn-secondary" >Cancel</a>
                                                    <button type="submit" class="btn btn-primary mt-4 mb-0" >Save</button>
                                                    </div>
                                                </form>
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
@endsection
@section('js')
         <!--INTERNAL Select2 js -->
		<script src="{{URL::asset('admin/assets/plugins/select2/select2.full.min.js')}}"></script>
		<script src="{{URL::asset('admin/assets/js/select2.js')}}"></script>
	<!-- INTERNAL Popover js -->
		<script src="{{URL::asset('admin/admin/assets/js/popover.js')}}"></script>

		<!-- INTERNAL Sweet alert js -->
		<script src="{{URL::asset('admin/assets/plugins/sweet-alert/jquery.sweet-modal.min.js')}}"></script>
		<script src="{{URL::asset('admin/assets/plugins/sweet-alert/sweetalert.min.js')}}"></script>
		<script src="{{URL::asset('admin/assets/js/sweet-alert.js')}}"></script>

        <!-- INTERNAL File-Uploads Js-->
		<script src="{{URL::asset('admin/assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
        <script src="{{URL::asset('admin/assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
        <script src="{{URL::asset('admin/assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
        <script src="{{URL::asset('admin/assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
        <script src="{{URL::asset('admin/assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>

		<!-- INTERNAL File uploads js -->
        <script src="{{URL::asset('admin/assets/plugins/fileupload/js/dropify.js')}}"></script>
		<script src="{{URL::asset('admin/assets/js/filupload.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function () {
            $('#blog_apst').addClass("active");
            $('#blog_pst').addClass("active");
            $('#blog_menu').addClass("is-expanded");
    });
</script>

@endsection
