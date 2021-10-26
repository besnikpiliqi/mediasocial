@extends('layouts.app')

@section('titre','Historiques')

@section('content')
<div class="row py-5 d-flex justify-content-center">

<div class="col-6 row-history">
<div class="col-12 mb-3 "><b>{{ __('Historiques') }}</b></div>
    @foreach($historys as $history)
        <div class="col-12 mb-3 p-4 border border-info rounded d-flex">
            <div class="col-1 me-1 img-profile"><img src="{{ asset($history->useraction->photo)  }}"></div>
            <div class="col-10"><a href="{{ route('profile',['username'=> $history->useraction->username ]) }}"><b>{{ $history->useraction->name }}</b></a> {{ $history->action_value }}</div>
            <div class="col-1 d-flex justify-content-end" style="font-size: 12px;color: #64646a;">{{ $history->cree_at }}</div>
        </div>
   
    @endforeach
    </div>
</div>
<div class="col-12 text-center" onclick="moreHistory(this);"><button class="btn btn-primary btn-sm">{{ __('Plus') }}</button></div>
@endsection