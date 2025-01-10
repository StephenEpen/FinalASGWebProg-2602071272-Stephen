@extends('layouts.main')

@section('title', 'Top Up')

@section('container')
<div class="container my-5">
    <div class="mb-4">
        <h3>@lang('batu.balance')</h3>
        <p class="fs-4 fw-semibold text-warning">{{ Auth::user()->wallet_balance }} @lang('batu.coins')</p>
    </div>

    <form action="{{ route('topup') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary btn-lg">@lang('batu.topup_button')</button>
    </form>
</div>
@endsection
