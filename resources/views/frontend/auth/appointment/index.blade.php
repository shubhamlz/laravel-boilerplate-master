@extends('frontend.layouts.app')
@section('content')
<div class="my-4">
<x-forms.patch :action="route('frontend.auth.appointment.create')">
    <div class="form-group row">
        <label for="username" class="col-md-3 col-form-label text-md-right">User Name</label>

        <div class="col-md-9">
            <input type="text" name="username" class="form-control" placeholder="Enter Your Name"  required autofocus />
        </div>
    </div><!--form-group-->

    <div class="form-group row">
        <label for="issue" class="col-md-3 col-form-label text-md-right">Issue</label>

        <div class="col-md-9">
            <input type="text" name="password" class="form-control" placeholder="Your issues" />
        </div>
    </div><!--form-group-->

    <div class="form-group row">
        <label for="appointmentwith" class="col-md-3 col-form-label text-md-right">@lang('New Password Confirmation')</label>

        <div class="col-md-9">
            <select name="appointmentwith" required >
                <option value="" selected> Please select your appointment with</option>
                <option value="admin">Admin</option>
            </select>
        </div>
    </div><!--form-group-->

    <div class="form-group row mb-0">
        <div class="col-md-12 text-right">
            <button class="btn btn-sm btn-primary float-right" type="submit">@lang('book Appointment')</button>
        </div>
    </div><!--form-group-->
</x-forms.patch>
</div>
@endsection