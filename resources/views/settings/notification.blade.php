@extends('layouts.app')

@section('titre','Notification')

@section('content')
<div class="row py-5 d-flex justify-content-center">

<div class="col-6 row-notification">
<div class="col-12 mb-3 "><b>{{ __('Notifications') }}</b></div>
    @foreach($notifications as $notification)
        <div class="col-12 mb-3 p-4 border border-info rounded d-flex">
            <div class="col-1 me-1 img-profile"><img src="{{ asset($notification->useraction->photo)  }}"></div>
            <div class="col-10"><a href="{{ route('profile',['username'=> $notification->useraction->username ]) }}"><b>{{ $notification->useraction->name }}</b></a> {{ $notification->action_value }}</div>
            <div class="col-1 d-flex justify-content-end" style="font-size: 12px;color: #64646a;">{{ $notification->cree_at }}</div>
        </div>
   
    @endforeach
    </div>
</div>
@if($notificationCount > 10)
<div class="col-12 text-center" onclick="moreNotification(this);"><button class="btn btn-primary btn-sm">{{ __('Plus') }}</button></div>
@endif
@endsection