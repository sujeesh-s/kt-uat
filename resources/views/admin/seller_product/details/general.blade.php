    <div class="card-header mb-4""><div class="card-title">General Information</div></div>
    <div class="col-lg-6 fl">
        <div class="form-group">
            {{Form::label('seller_id','Seller',['class'=>''])}} <span class="text-red">*</span>
            {{Form::label('seller',$seller->fname, ['class'=>'form-control'])}} {{Form::hidden('seller_id',$seller->seller_id,['id'=>'seller_id'])}}
            <span class="error"></span>
        </div>
    </div>
    <div class="col-lg-6 fl">
        <div class="form-group">
            {{Form::label('lang_id','Language',['class'=>''])}} <span class="text-red">*</span>
            {{Form::select('lang_id',$languages,$langId,['id'=>'lang_id','class'=>'form-control'])}}
            <span class="error"></span>
        </div>
    </div>
    
    <div id="filter_div" class="col-lg-6 fl @if($id > 0) d-none @endif " >
        <div class="form-group">
            {{Form::label('opt_type','Choose Option',['class'=>''])}} <span class="text-red">*</span>
            <div class="col-12">
            <label class="custom-control custom-radio custom-control-md col-md-6 fl">
                {{Form::radio('prd_option','option1',$sellCkd,['id'=>'option1','class'=>'custom-control-input cus_radio'])}}
                <span class="custom-control-label custom-control-label-md"> Create New </span>
            </label>
            <label class="custom-control custom-radio custom-control-md col-md-6 fl">
                {{Form::radio('prd_option','option2',$adminCkd,['id'=>'option2','class'=>'custom-control-input cus_radio'])}}
                <span class="custom-control-label custom-control-label-md">Select From Admin</span>
            </label>
            </div><div class="clr"></div>
        </div>
    </div>
    <div id="prd_type_div" class="col-lg-6 fl @if($id > 0) d-none @endif ">
        <!--<div class="form-group">-->
        <!--    {{Form::label('prd_type','Product Type',['class'=>''])}} <span class="text-red">*</span>-->
        <!--    {{Form::select('prd_type',$prdTypes,$prdType,['id'=>'prd_type','class'=>'form-control', 'placeholder'=>'Select Product Type'])}}-->
        <!--    <span class="error"></span>-->
        <!--</div>-->
    </div><div class="clr"></div>
    
    <!--<div id="config_attr_div" class="col-12 no-disp">-->
    <!--    <div class="form-group">-->
    <!--        {{Form::label('config_attrs','Select Configurable Attributes',['class'=>'col-12 tal'])}} <span class="text-red">*</span>-->
    <!--        @if($configAttrs && count($configAttrs) > 0) @foreach($configAttrs  as $row)-->
    <!--            <div class="col-lg-3 col-md-4 col-sm-6 fl"><label class="custom-control custom-checkbox">-->
    <!--                {{Form::checkbox('config[]',$row->id,false,['id'=>'config_attr_'.$row->id,'class'=>'custom-control-input ckIn'])}}-->
    <!--                <span class="custom-control-label">{{$row->name}}</span>-->
    <!--            </label></div>-->
    <!--        @endforeach @endif-->
    <!--        <span class="error"></span>-->
    <!--    </div>-->
    <!--</div>-->
    <div id="admin_div" class="col-lg-6 fl no-disp">
        <div class="form-group">
            {{Form::label('admin_prd_id','Select Admin Product',['class'=>''])}} <span class="text-red">*</span>
            {{Form::select('admin_prd_id',$adminProducts,$adminPrd,['id'=>'admin_prd_id','class'=>'form-control', 'placeholder'=>'Select Product'])}}
            <span class="error"></span>
        </div>
    </div>
    <div id="seller_div" class="col-lg-6 fl">
        <div class="form-group">
            {{Form::label('name','Product Name',['class'=>''])}} <span class="text-red">*</span>
            {{Form::text('prd[name]',$prdName,['id'=>'name','class'=>'form-control admin', 'placeholder'=>'Product Name'])}}
            <span class="error"></span>
        </div>
    </div>
    <div class="col-lg-6 fl">
        <div class="form-group">
            {{Form::label('category_id','Category',['class'=>''])}} <span class="text-red">*</span>
            {{Form::select('prd[category_id]',$categories,$catId,['id'=>'category_id','class'=>'form-control admin', 'placeholder'=>'Select Category'])}}
            <span class="error"></span>
        </div>
    </div>
    <div class="col-lg-6 fl">
        <div class="form-group">
            {{Form::label('sub_category_id','Sub Category',['class'=>''])}} <span class="text-red">*</span>
            {{Form::select('prd[sub_category_id]',$sub_cats,$subCatId,['id'=>'sub_category_id','class'=>'form-control admin', 'placeholder'=>'Select Sub Category'])}}
            <span class="error"></span>
        </div>
    </div>
    <div class="col-lg-6 fl">
        <div class="form-group">
            {{Form::label('brand_id','Brand',['class'=>''])}} 
            {{Form::select('prd[brand_id]',$brands,$brandId,['id'=>'brand_id','class'=>'form-control admin', 'placeholder'=>'Select Brand'])}}
            <span class="error"></span>
        </div>
    </div>
    <div class="col-lg-6 fl">
        <div class="form-group">
            {{Form::label('short_desc','Short Description',['class'=>''])}} <span class="text-red">*</span>
            {{Form::textarea('prd[short_desc]',$sDesc,['id'=>'short_desc','class'=>'form-control','rows'=>2])}}
            <span class="error"></span>
        </div>
    </div>
    <div class="col-lg-6 fl">
        <div class="form-group">
            {{Form::label('is_active','Status',['class'=>''])}} 
            {{Form::select('prd[is_active]',[1=>'Active',0=>'Inactive'],$status,['id'=>'is_active','class'=>'form-control'])}}
            <span class="error"></span>
        </div>
    </div><div class="clr"></div>
    <div class="col-lg-6 fl">
        <div class="form-group">
            {{Form::label('desc','Description',['class'=>''])}}
            {{Form::textarea('prd[desc]',$desc,['id'=>'desc','class'=>'form-control content'])}}
        </div>
    </div>
    <div class="col-lg-6 fl">
        <div class="form-group">
            {{Form::label('content','Content',['class'=>''])}} 
            {{Form::textarea('prd[content]',$content,['id'=>'content','class'=>'form-control content'])}}
        </div>
    </div>
     <div class="col-lg-12 fl">
        <div class="form-group" >
            {{Form::label('specification','Specification',['class'=>''])}}
            <div id="quillEditor" ></div>
            {{Form::hidden('prd[specification]',$specification,['id'=>'specification','class'=>'form-control  '])}}
        </div>
    </div>
    
    <div class="col-lg-6 fl">
        <div class="form-group">
            {{Form::label('is_featured','Featured',['class'=>'featured form-label'])}} 
            {{ Form::checkbox('prd[is_featured]',1,$featured, array('id'=>'is_featured')) }} <p>(Include this product under featured products list)</p>
        </div>
    </div>
     <div class="col-lg-6 fl">
        <div class="form-group">
            {{Form::label('daily_deals','Daily Deals',['class'=>'daily_deals form-label'])}} 
            {{ Form::checkbox('prd[daily_deals]',1,$daily_deals, array('id'=>'daily_deals')) }} <p>(Include this product under Daily deals product list)</p>
        </div>
    </div>
              

 <script type="text/javascript">
     
$(function() {
    'use strict'
    var icons = Quill.import('ui/icons');
    icons['bold'] = '<i class="fa fa-bold" aria-hidden="true"><\/i>';
    icons['italic'] = '<i class="fa fa-italic" aria-hidden="true"><\/i>';
    icons['underline'] = '<i class="fa fa-underline" aria-hidden="true"><\/i>';
    icons['strike'] = '<i class="fa fa-strikethrough" aria-hidden="true"><\/i>';
    icons['list']['ordered'] = '<i class="fa fa-list-ol" aria-hidden="true"><\/i>';
    icons['list']['bullet'] = '<i class="fa fa-list-ul" aria-hidden="true"><\/i>';
    icons['link'] = '<i class="fa fa-link" aria-hidden="true"><\/i>';
    icons['image'] = '<i class="fa fa-image" aria-hidden="true"><\/i>';
    icons['video'] = '<i class="fa fa-film" aria-hidden="true"><\/i>';
    icons['code-block'] = '<i class="fa fa-code" aria-hidden="true"><\/i>';
    var toolbarOptions = [
        [{
            'header': [1, 2, 3, 4, 5, 6, false]
        }],
        ['bold', 'italic', 'underline', 'strike'],
        [{
            'list': 'ordered'
        }, {
            'list': 'bullet'
        }],
        ['link', 'image', 'video']
    ];
    const editor = new Quill('#quillEditor', {
      bounds: '#quillEditor',
      modules: {
            toolbar: toolbarOptions
        },
      placeholder: 'Product Specification',
      theme: 'snow'
    });

      /**
       * Step1. select local image
       *
       */
    function selectLocalImage() {
      const input = document.createElement('input');
      input.setAttribute('type', 'file');
      input.click();

      // Listen upload local image and save to server
      input.onchange = () => {
        const file = input.files[0];

        // file type is only image.
        if (/^image\//.test(file.type)) {
          saveToServer(file);
        } else {
          alert('Please select an image.');
        }
      };
    }

    /**
     * Step2. save to server
     *
     * @param {File} file
     */
    function saveToServer(file) {
      const fd = new FormData();
      fd.append('image', file);

      const xhr = new XMLHttpRequest();


      xhr.open('POST', "{{ url('/admin/editor-image') }}", true);
      // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
var csrfToken = "{{ csrf_token() }}";
xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
      xhr.onload = () => {
        if (xhr.status === 200) {
          // this is callback data: url
          // const url = JSON.parse(xhr.responseText).data;
          console.log(xhr.responseText);
          // console.log(url);
          insertToEditor(xhr.responseText);
        }
      };
      xhr.send(fd);
    }

    /**
     * Step3. insert image url to rich editor.
     *
     * @param {string} url
     */
    function insertToEditor(url) {
      // push image url to rich editor.
      const range = editor.getSelection();
      editor.insertEmbed(range.index, 'image', `${url}`);
    }

    // quill editor add image handler
    editor.getModule('toolbar').addHandler('image', () => {
      selectLocalImage();
    });

//     var specification = $('#specification').val();
// editor.setContents( "{{ ($specification) }}" );
editor.setContents(JSON.parse($('#specification').val()), 'api');

});

 </script>
                        