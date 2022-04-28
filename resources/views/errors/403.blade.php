@extends('layouts.error')
@section('title-error')
{{ __('You do not have permission !') }}
@endsection

@section('content-error')
    <div class="col-md-8 mb-5">
        <div class="pe-5 pb-5 title-login text-end me-3">
            <h2>{{ __('Excuse me ..') }}</h2>
            <h1 class="text-success">
                {{ __('Error 403') }}
            </h1>
            <p class="h3">{{ __('You do not have permission !') }}</p>
        </div>
    </div>
@endsection
