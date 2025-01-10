@extends('layouts.main')

@section('title', 'Top Up')

@section('container')
<div class="container my-5">
    <h3 class="mb-4">@lang('home.friend_list')</h3>
    <div class="list-group">
        @foreach($friends as $friend)
        <div class="list-group-item d-flex align-items-center">
            <img src="{{ $friend->profile_picture }}" 
                 alt="Profile Picture" 
                 class="rounded-circle me-3" 
                 style="width: 50px; height: 50px; object-fit: cover;">
            <span class="fw-bold">{{ $friend->name }}</span>
        </div>
        @endforeach
    </div>
</div>
@endsection
