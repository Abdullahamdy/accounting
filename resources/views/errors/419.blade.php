@extends('layouts.error')
@section('title-error')
    {{ __('This page has expired !') }}
@endsection

@section('content-error')
    <div class="col-md-8 mb-5">
        <div class="pe-5 pb-5 title-login text-end me-3">
            <h2>{{ __('Excuse me ..') }}</h2>
            <h1 class="text-success">
                {{ __('Error 419') }}
            </h1>
            <p class="h3">{{ __('This page has expired !') }}</p>
        </div>
    </div>
@endsection
