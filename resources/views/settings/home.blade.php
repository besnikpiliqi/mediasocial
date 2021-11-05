@extends('layouts.app')

@section('titre','Réglages')

@section('content')
<div class="row py-5 d-flex justify-content-center">
    <div class="col-6">
        <div class="col-12 mb-3 p-4 border border-info rounded"><a href="{{ route('settings.history') }}" class="text-decoration-none">{{ __('Histoirique') }}</a></div>
        <div class="col-12 mb-3 p-4 border border-info rounded"><a href="{{ route('settings.request') }}" class="text-decoration-none">{{ __('Requests') }}</a></div>
    </div>
</div>
@endsection