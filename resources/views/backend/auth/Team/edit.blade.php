@extends('backend.layouts.app')

@section('title', __('View User'))

@section('content')
<x-forms.patch :action="route('admin.tupdate')"  enctype="multipart/form-data">
    <div class="form-group row">
        <label for="username" class="col-md-3 col-form-label text-md-right">User Name</label>

        <div class="col-md-9">    
        <input type="text" name="name" id="username" class="form-control" placeholder="Enter Your Name" value ="{{$detail->name}}" required autofocus />
        </div>
    </div><!--form-group-->
    <input type="hidden" name="id" value="{{$detail->id}}">
    <div class="form-group row">
        <label for="mobile" class="col-md-3 col-form-label text-md-right">Mobile</label>

        <div class="col-md-9">
            <input type="text" name="mobile" id="mobile" class="form-control" value ="{{$detail->mobile}}" placeholder="mobile number" />
        </div>
    </div><!--form-group-->
    <div class="form-group row">
        <label for="email" class="col-md-3 col-form-label text-md-right">Email</label>

        <div class="col-md-9">
            <input type="email" name="email" id="email" class="form-control" placeholder="Email" value ="{{$detail->email}}" />
        </div>
    </div>
    <div class="form-group row">
        <label for="designation" class="col-md-3 col-form-label text-md-right">Designation</label>

        <div class="col-md-9">
            <select name="designation" required  id="designation">
                <option value="" {{isset($detail->designation)?"selected":''}} > Please select Designation</option>
                <option value="admin" {{isset($detail->designation)&& $detail->designation!=''?"selected":''}}>Admin</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="available_from" class="col-md-3 col-form-label text-md-right">Email</label>

        <div class="col-md-9">
            <input type="datetime-local" name="available_from" value="{{$detail->available_from}}" id="available_from" class="form-control" />
        </div>
    </div>

    <div class="form-group row">
        <label for="image" class="col-md-3 col-form-label text-md-right">Image</label>

        <div class="col-md-9">
        @if(empty($detail->img))
            <input type="file" name="image" id="image"><br>
        @else
            <div>
                <img src="{{ url('storage/images/'.$detail->img) }}" width="200px" />
                <span>Old Image</span>
            </div>
            <div>
                <input type="file" name="image" class="new" id="imaget" style="display:none"><br>
                <label for="update-image" class="update-image-label">Update Image</label>
                <span>New Image</span>
            </div>
            <input type="hidden" name="old_image" value="{{ $detail->img }}">
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