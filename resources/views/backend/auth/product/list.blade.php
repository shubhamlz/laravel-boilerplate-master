@extends('backend.layouts.app')

@section('title', __('View User'))

@section('content')
<H1>List Of Products</H1>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Category</th>
            <th scope="col">Price</th>
            <th scope="col">InStock</th>
            <th scope="col">Product Image</th>
            <th scope="col">Action</th>
            
        </tr>
        @foreach($products as $value)
        <tr scope="row">
            <td> {{ $value->name }}</td>
            <td> {{ $value->category->cat_name }}</td>
            <td> {{ $value->price }}</td>
            <td> {{ $value->inStock }}</td>
            <td>  <img src="{{ url('storage/images/'.$value->image) }}" width="70px" /></td>
            <td> <a href="{{ route('admin.auth.productedit', ['id' => $value->id]) }}">Edit</a> &nbsp;|&nbsp;
                <a href="{{ route('admin.remove', $value->id) }}" onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this row?')) document.getElementById('delete-form-{{ $value->id }}').submit();">
                    Delete
                </a>
                <form id="delete-form-{{ $value->id }}" action="{{ route('admin.auth.productremove', $value->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
                <!-- <a href="{{ route('admin.remove', ['id' => $value->id]) }}" class="delete-btn" data-del=''>Delete</a> -->
            </td>
        </tr>
        @endforeach
    </thead>
</table>
        @endsection