@extends('backend.layouts.app')

@section('title', __('View User'))

@section('content')
<a href="{{route('admin.auth.showproducts')}}">List</a>
<x-forms.patch :action="route('admin.auth.productupdate')" enctype="multipart/form-data">
    <div class="form-group row">
        <label for="productname" class="col-md-3 col-form-label text-md-right">product Name</label>

        <div class="col-md-9">
            <input type="text" name="name" id="productname" class="form-control" placeholder="Enter Product Name" value="{{$detail->name}}"  required autofocus />
            <input type="hidden" name="id" value="{{$detail->id}}">
        </div>
    </div><!--form-group-->

    <div class="form-group row">
        <label for="price" class="col-md-3 col-form-label text-md-right">Price</label>

        <div class="col-md-9">
            <input type="number" name="price" id="price" class="form-control" value="{{$detail->price}}" placeholder=" Enter price" />
        </div>
    </div><!--form-group-->
    <div class="form-group row">
        <label for="inStock" class="col-md-3 col-form-label text-md-right">inStock</label>

        <div class="col-md-9">
            <input type="inStock" name="inStock" id="inStock" class="form-control" value="{{$detail->inStock}}" placeholder="inStock amount"  />
        </div>
    </div>
    <div class="form-group row">
        <label for="category" class="col-md-3 col-form-label text-md-right">Category</label>

        <div class="col-md-9">
            <select name="category_id" required  id="category_id">
                <option value="" selected> Please select Category</option>
                @foreach($category as $key=>$value)
                <option value="{{$value}}" {{$detail->category->id==$value?'selected':''}}>{{$key}}</option>
                @endforeach
            </select>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="description" class="col-md-3 col-form-label text-md-right">Description</label>

        <div class="col-md-9">
            <textarea name="description" id="description" class="form-control"> {{$detail->description}}</textarea>
        </div>
    </div>

    <div class="form-group row">
        <!-- <label for="image" class="col-md-3 col-form-label text-md-right">Image</label>

        <div class="col-md-9">
            <input type="file" name="image" id="image" class="form-control" />
        </div>
    </div> -->


    <label for="image" class="col-md-3 col-form-label text-md-right">Image</label>

    <div class="col-md-9">
    @if(empty($detail->image))
        <input type="file" name="image" id="image"><br>
    @else
        <div>
            <img src="{{ url('storage/images/'.$detail->image) }}" width="200px" />
        </div>
        <div>
            <input type="file" name="image" class="new" id="imaget" style="display:none"><br>
            <label for="update-image" class="update-image-label">Update Image</label>
         </div>
        <input type="hidden" name="old_image" value="{{ $detail->image }}">
    @endif
    </div>
    </div>
    <!--form-group-->

    <div class="form-group row mb-0">
        <div class="col-md-12 text-right">
            <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Submit')</button>
        </div>
    </div><!--form-group-->
    </x-forms.patch>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function() {
        $('.update-image-label').click(function() {
            // alert("dfs");
            $('#imaget').click();
        });
    });
</script>
@endsection