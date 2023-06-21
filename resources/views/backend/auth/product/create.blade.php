@extends('backend.layouts.app')

@section('title', __('View User'))

@section('content')
<a href="{{route('admin.auth.showproduct')}}">List</a>
<x-forms.post :action="route('admin.auth.storeproduct')" enctype="multipart/form-data">
    <div class="form-group row">
        <label for="productname" class="col-md-3 col-form-label text-md-right">product Name</label>

        <div class="col-md-9">
            <input type="text" name="name" id="productname" class="form-control" placeholder="Enter Product Name"  required autofocus />
        </div>
    </div><!--form-group-->

    <div class="form-group row">
        <label for="price" class="col-md-3 col-form-label text-md-right">Price</label>

        <div class="col-md-9">
            <input type="number" name="price" id="price" class="form-control" placeholder=" Enter price" />
        </div>
    </div><!--form-group-->
    <div class="form-group row">
        <label for="inStock" class="col-md-3 col-form-label text-md-right">inStock</label>

        <div class="col-md-9">
            <input type="inStock" name="inStock" id="inStock" class="form-control" placeholder="inStock amount"  />
        </div>
    </div>
    <div class="form-group row">
        <label for="category" class="col-md-3 col-form-label text-md-right">Category</label>

        <div class="col-md-9">
            <select name="category_id" required  id="category_id">
                <option value="" selected> Please select Category</option>\
                @foreach($category as $cat)
                <option value="{{$cat->id}}">{{$cat->cat_name}}</option>
                @endforeach
            </select>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="description" class="col-md-3 col-form-label text-md-right">Description</label>

        <div class="col-md-9">
            <textarea name="description" id="description" class="form-control"> Product description</textarea>
        </div>
    </div>

    <div class="form-group row">
        <label for="image" class="col-md-3 col-form-label text-md-right">Image</label>

        <div class="col-md-9">
            <input type="file" name="image" id="image" class="form-control" />
        </div>
    </div>
    <!--form-group-->

    <div class="form-group row mb-0">
        <div class="col-md-12 text-right">
            <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Submit')</button>
        </div>
    </div><!--form-group-->
</x-forms.patch>
@endsection