@extends('backend.layouts.app')

@section('title', __('View User'))

@section('content')
<x-forms.post :action="route('admin.tink')" enctype="multipart/form-data">
    <div class="form-group row">
        <label for="username" class="col-md-3 col-form-label text-md-right">User Name</label>

        <div class="col-md-9">
            <input type="text" name="name" id="username" class="form-control" placeholder="Enter Your Name"  required autofocus />
        </div>
    </div><!--form-group-->

    <div class="form-group row">
        <label for="mobile" class="col-md-3 col-form-label text-md-right">Mobile</label>

        <div class="col-md-9">
            <input type="text" name="mobile" id="mobile" class="form-control" placeholder="mobile number" />
        </div>
    </div><!--form-group-->
    <div class="form-group row">
        <label for="email" class="col-md-3 col-form-label text-md-right">Email</label>

        <div class="col-md-9">
            <input type="email" name="email" id="email" class="form-control" placeholder="Email" />
        </div>
    </div>
    <div class="form-group row">
        <label for="designation" class="col-md-3 col-form-label text-md-right">Designation</label>

        <div class="col-md-9">
            <select name="category_id" required  id="categogry_id">
                <option value="" selected> Please select Designation</option>
                @foreach($category as $cat)
                <option value="{{$cat->id}}">{{$cat->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="available_from" class="col-md-3 col-form-label text-md-right">Email</label>

        <div class="col-md-9">
            <input type="date" name="available_from" id="available_from" class="form-control" />
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