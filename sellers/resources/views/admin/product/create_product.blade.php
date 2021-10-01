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


		<!-- INTERNAl WYSIWYG Editor css -->
		<link href="{{URL::asset('admin/assets/plugins/wysiwyag/richtext.css')}}" rel="stylesheet" />
		
		<!---combo tree-->
		<link href="{{URL::asset('admin/assets/css/combo-tree.css')}}" rel="stylesheet" />
        <style>.imageThumb {
            max-height: 75px;
            border: 2px solid;
            padding: 1px;
            cursor: pointer;
          }
          .pip {
            display: inline-block;
            margin: 10px 10px 0 0;
          }
          .remove {
            display: block;
            background: #444;
            border: 1px solid black;
            color: white;
            text-align: center;
            cursor: pointer;
          }
          .remove:hover {
            background: white;
            color: black;
          }</style>
@endsection
@section('page-header')
						<!--Page header-->


						<div class="page-header">
							<div class="page-leftheader">
								<h4 class="page-title mb-0">Add Admin Product</h4>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#"><i class="fe fe-grid mr-2 fs-14"></i>Masters</a></li>
									<li class="breadcrumb-item active" aria-current="page"><a href="#">Admin Product List</a></li>
									<li class="breadcrumb-item active" aria-current="page"><a href="#">Add Admin Product</a></li>
								</ol>
							</div>
							<div class="page-rightheader">
								<!-- <div class="btn btn-list">
									<a href="#" class="btn btn-info"><i class="fe fe-settings mr-1"></i> General Settings </a>
									<a href="#" class="btn btn-danger"><i class="fe fe-printer mr-1"></i> Print </a>
									<a href="#"  data-target="#user-form-modal" data-toggle="modal" class="btn btn-danger addmodule"><i class="fe fe-shopping-cart mr-1"></i> Add New</a>
								</div> -->
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
											<div class="card">
                                                <div class="card-body">
                                                    <form action="{{url('admin/insert-product')}}" method="POST" enctype="multipart/form-data">
													@csrf
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-label">Select Language <span class="text-red">*</span></label>
                                                                <select class="form-control custom-select select2" name="language" required>
                                                                    @foreach ($language as $lang)
                                                                    <option value="{{ $lang->id }}">{{ $lang->glo_lang_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Product Name <span class="text-red">*</span></label>
                                                                <input type="text" class="form-control @error('product_name') is-invalid @enderror" value="{{ old('product_name') }}"  placeholder="Product Name" name="product_name">
                                                                @error('product_name')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Short Description <span class="text-red">*</span></label>
                                                                <textarea rows="1" class="form-control @error('short_description') is-invalid @enderror"  placeholder="Short Description about the product" name="short_description">{{ old('short_description') }}</textarea>
                                                                @error('short_description')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Category <span class="text-red">*</span></label>
                                                                <select class="form-control select2  @error('category') is-invalid @enderror" id="categoryList"  name="category" onchange="loadsubcat()">
                                                                    <option value="">Select</option>
                                                                    @foreach($category as $key )
                                                                    <?php $default_lang =DB::table('glo_lang_lk')->where('is_active', 1)->first();
                                                                    $category_name=DB::table('cms_content')->where('cnt_id', $key->cat_name_cid)->where('lang_id', $default_lang->id)->first();?>
                                                                    <option value="{{ $key->category_id }}">{{ $category_name->content }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('category')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Subcategory<span class="text-red">*</span></label>
                                                                <input type="text" id="sub-category-id" placeholder="Type to filter" class="tagselect" name="subcategory_id" autocomplete="off" hidden/>
																<input type="text" id="sub-category-drop" class="form-control " placeholder="Select Subcategory" readonly style="background-color: #fff !important;">
                                                                <!--<select id="subcategory" class="form-control select2 tagselect @error('subcategory_id') is-invalid @enderror" name="subcategory_id" >-->
                                                                <!--<option value="0">Select</option>-->
                                                                <!--</select>-->
                                                            @error('subcategory_id')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Tag<span class="text-red"></span></label>
                                                                <select id="tag" class="form-control select2" name="tag[]" multiple>

                                                            </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Brand<span class="text-red"></span></label>
                                                                <select id="brand" class="form-control select2" name="brand" >
                                                                <option value="">Select</option>
                                                                    @foreach($brand as $bd )
                                                                    <?php $default_lang =DB::table('glo_lang_lk')->where('is_active', 1)->first();
                                                                    $brand_name=DB::table('cms_content')->where('cnt_id', $bd->brand_name_cid)->where('lang_id', $default_lang->id)->first();?>
                                                                    <option value="{{ $bd->id }}">{{ $brand_name->content }}</option>
                                                                    @endforeach
                                                            </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Product Type <span class="text-red">*</span></label>
                                                                <select class="form-control select2 @error('product_type') is-invalid @enderror" name="product_type">
                                                                <option value="">Select</option>
                                                                @foreach($prod_type as $type )
                                                                    <option value="{{$type->id}}">{{$type->type_name}}</option>
                                                                 @endforeach
                                                                </select>
                                                                @error('product_type')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Status <span class="text-red">*</span></label>
                                                                <select class="form-control select2" name="status">
                                                                    <option value="1">Active</option>
                                                                    <option value="0">Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Long Description <span class="text-red"></span></label>
                                                                <textarea class="content" name="long_description"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Content <span class="text-red"></span></label>
                                                                <textarea class="content2" name="content"></textarea>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="col-sm-6 col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Daily Product <span class="text-red">*</span></label>
                                                                    <div class="row">
                                                                    <div class="col-md-2">
                                                                    <label class="custom-control custom-radio">
                                                                        <input type="radio" class="custom-control-input" name="daily_pro" value="1" checked>
                                                                        <span class="custom-control-label">Yes</span>
                                                                    </label>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                    <label class="custom-control custom-radio">
                                                                        <input type="radio" class="custom-control-input" name="daily_pro" value="0" checked>
                                                                        <span class="custom-control-label">No</span>
                                                                    </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <label class="form-label">Product Image <span class="text-red">*</span></label>
                                                            <div class="form-group mb-0">
                                                                <input id="files" type="file" class="form-control" name="product_image[]" accept=".jpg, .png, image/jpeg, image/png"  multiple>
                                                            </div>
                                                            {{-- <input type="file" class="dropify" data-height="180" name="product_image" /> --}}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col d-flex justify-content-end">
                                                        <a class="btn btn-secondary mt-4 mb-0 mr-2" href="{{route('admin.productlist')}}">Cancel</a>
                                                        <button class="btn btn-primary mt-4 mb-0 " type="submit">Submit</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                                    <!---hhj-->


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

        <!-- INTERNAL WYSIWYG Editor js -->
		<script src="{{URL::asset('admin/assets/plugins/wysiwyag/jquery.richtext.js')}}"></script>
		<script src="{{URL::asset('admin/assets/js/form-editor.js')}}"></script>
		
		<!---combo tree--->
		<script src="{{URL::asset('admin/assets/plugins/combotree/comboTreePlugin.js')}}"></script>


<script type="text/javascript">


var instance = $('#sub-category-drop').comboTree({
collapse:true,
cascadeSelect:true,
isMultiple: false
});

 function loadsubcat(clear='')
    {
        var category_id=$("#categoryList").val();
        
        if(clear!='1')
        {
            $("#sub-category-id").val('');
        }
        
         $.ajax({
            type: "POST",
            url: '{{url("/admin/tags/subcategory")}}',
            data: { "_token": "{{csrf_token()}}", category_id: category_id},
            success: function (data) {
            	var obj = JSON.parse(data);
            
            	console.log(obj);
            	 var obj = JSON.parse(data);
            if(obj.subdata.length >=1)
            {
               $('#sub-category-drop').attr("placeholder", "Select subcategory"); 
            }
            else
            {
                $('#sub-category-drop').attr("placeholder", "No subcategory to display"); 
            }
            instance.setSource(obj.subdata);
            if($("#sub-category-id").val())
            {
                var selectionIdList = new Array($("#sub-category-id").val());
                instance.setSelection(selectionIdList);

            }
            
            }
        });
        
        
        
    }
    $('#sub-category-drop').on('change',function()
        {
            if(instance.getSelectedIds())
            {
                $("#sub-category-id").val(instance.getSelectedIds()[0]);
            }
            
            var cat_id = $('#categoryList').val();
            var subcat_id = $('#sub-category-id').val();
            $.ajax({
            url:"{{ route('taglist_ajax') }}",
            type:"POST",
            data: {
            cat_id: cat_id,subcat_id:subcat_id
            },
            success:function (data) {
            $('#tag').empty();
            $.each(data.tags,function(index,tag){
                //alert(subcategory.subcategory_id);
            
            $('#tag').append('<option value="'+tag.id+'">'+tag.tag_name+'</option>');
            })
            }
            })
        });


</script>
<script type="text/javascript">
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
$(document).ready(function () {
    $('#adminpro').addClass("active");
  $('#adm_pro').addClass("active");
  $('#master').addClass("is-expanded");

    if (window.File && window.FileList && window.FileReader) {
    $("#files").on("change", function(e) {
        $(".pip").remove();
      var files = e.target.files,
        filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          $("<span class=\"pip\">" +
            "<input type=\"file\" id=\"havefil\" hidden name=\"havefil[]\" value=\"" + e.target.result + "\"/>"+
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/>" +
            "</span>").insertAfter("#files");
          $(".remove").click(function(){
            $(this).parent(".pip").remove();
          });

          // <span class=\"remove\">Remove image</span>Old code here
          /*$("<img></img>", {
            class: "imageThumb",
            src: e.target.result,
            title: file.name + " | Click to remove"
          }).insertAfter("#files").click(function(){$(this).remove();});*/

        });
        fileReader.readAsDataURL(f);
      }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
$('#categoryList').on('change',function(e) {
var cat_id = e.target.value;
$.ajax({
url:"{{ route('subcategory_ajax') }}",
type:"POST",
data: {
cat_id: cat_id
},
success:function (data) {
$('#subcategory').empty();
$.each(data.subcategories,function(index,subcategory){
    //alert(subcategory.subcategory_id);

$('#subcategory').append('<option value="'+subcategory.subcategory_id+'">'+subcategory.subname+'</option>');
})
}
})
});

$('.tagselect').on('change',function(e) {
var cat_id = $('#categoryList').val();
var subcat_id = $('#sub-category-id').val();
$.ajax({
url:"{{ route('taglist_ajax') }}",
type:"POST",
data: {
cat_id: cat_id,subcat_id:subcat_id
},
success:function (data) {
$('#tag').empty();
$.each(data.tags,function(index,tag){
    //alert(subcategory.subcategory_id);

$('#tag').append('<option value="'+tag.id+'">'+tag.tag_name+'</option>');
})
}
})
});

});

</script>

@endsection
