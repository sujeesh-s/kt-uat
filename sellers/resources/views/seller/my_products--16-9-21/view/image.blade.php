@php $n_img = 0 @endphp
<div class="tab-pane" id="tab3">
    <div class="card-header mb-4"><div class="card-title">Product Images</div></div>
    <div id="prd_imgs">
        <div id="img_row_0" class="col-12 fl img_row">
           <ul class="prod_imgs">
            @if(count($images) >0)
            @foreach ($images as $img)
             <li class="prod_img">
           <img src="{{ url('storage/'.$img->image) }}" alt="Product Image"  >
        </li> 

            @endforeach
            @endif
            
           </ul>
        </div>
            <div class="clr"></div>

    </div>

    
</div>