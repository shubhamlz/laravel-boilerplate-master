@extends('backend.layouts.app')

@section('title', __('View User'))

@section('content')
<ul>
  @foreach($team as $value)
    <li>
      <p>Team Name: {{ $value->name }}
        <a href="{{ route('admin.edit', ['id' => $value->id]) }}">Edit</a> &nbsp;|&nbsp;
        <a href="{{ route('admin.remove', $value->id) }}"
               onclick="event.preventDefault(); if (confirm('Are you sure you want to delete this row?')) document.getElementById('delete-form-{{ $value->id }}').submit();">
               Delete
            </a>
            <form id="delete-form-{{ $value->id }}" action="{{ route('admin.remove', $value->id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        <!-- <a href="{{ route('admin.remove', ['id' => $value->id]) }}" class="delete-btn" data-del=''>Delete</a> -->
      </p>
    </li>
  @endforeach
</ul>
@endsection