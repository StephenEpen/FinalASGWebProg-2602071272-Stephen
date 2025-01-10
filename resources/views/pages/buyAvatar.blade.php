@extends('layouts.main')

@section('title', 'Buy Avatar')

@section('container')
<div class="container my-5">
    <div class="mb-4">
        <h3>@lang('batu.balance')</h3>
        <p class="fs-4 fw-semibold text-warning">{{ Auth::user()->wallet_balance }} @lang('batu.coins')</p>
    </div>

    <div class="row g-4">
        @foreach ($avatars as $avatar)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card text-center shadow-sm">
                    <img src="{{ $avatar->image_url }}" alt="{{ $avatar->name }}" class="card-img-top" style="height: 300px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $avatar->name }}</h5>
                        <p class="card-text fw-bold fs-5">{{ $avatar->price }} @lang('batu.coins')</p>

                        <form action="{{ route('buyAvatar', $avatar->id) }}" method="POST">
                            @csrf
                            <button 
                                type="submit" 
                                class="btn btn-primary px-4" 
                                {{ Auth::user()->wallet_balance < $avatar->price ? 'disabled' : '' }}>
                                @lang('batu.buy_button')
                            </button>
                        </form>

                        @if (Auth::user()->wallet_balance < $avatar->price)
                            <small class="text-danger d-block mt-2">@lang('batu.insufficient_coins')</small>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
