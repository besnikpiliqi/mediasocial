@extends('layouts.app')

@section('titre','Requests')

@section('content')
<div class="row py-5 d-flex justify-content-center">

<div class="col-6 row-history">
    <div class="col-12 mb-3 "><b>{{ __('Requests') }}</b></div>
        <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">{{ __('Requests envoyés non acceptés') }}</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">{{ __('Requests reçu non acceptés') }}</button>
    </li>
    </ul>
    <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    @if($followingNotAcceptedByOthers->count())
        @foreach($followingNotAcceptedByOthers as $request)
            <div class="col-12 mb-3 p-4 border border-info rounded d-flex">
                <div class="col-1 me-1 img-profile"><img src="{{ asset($request->userFollowing->photo)  }}"></div>
                <div class="col-8"><a href="{{ route('profile',['username'=>$request->userFollowing->username]) }}"><b>{{ $request->userFollowing->name  }}</b></a></div>
                <div class="col-3 m-auto" id="btn-{{ $request->userFollowing->id }}">
                    <button type="button" class="btn btn-primary btn-sm pull-right" id="btn-cancel-follow" onclick="cancelfollowingReq({{ $request->userFollowing->id }})">{{ __('Retirer') }}</button>
                </div>
            </div>
        @endforeach
        @else
        <div class="col-12 text-center">{{ __("Vouz n'avez pas des requestes envoyées non acceptées") }}</div>
        @endif
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        @if($followedNotAcceptedByMe->count())
            @foreach($followedNotAcceptedByMe as $request)
                <div class="col-12 mb-3 p-4 border border-info rounded d-flex">
                    <div class="col-1 me-1 img-profile"><img src="{{ asset($request->userFollowed->photo)  }}"></div>
                    <div class="col-7"><a href="{{ route('profile',['username'=>$request->userFollowed->username]) }}"><b>{{ $request->userFollowed->name  }}</b></a></div>
                    <div class="col-4 m-auto" id="btn-{{ $request->userFollowed->id }}">
                        <button type="button" class="btn btn-primary btn-sm pull-right" id="btn-cancel-follow" onclick="cancelfollowedReq({{ $request->userFollowed->id }})">{{ __('Retirer') }}</button>
                        <button type="button" class="btn btn-primary btn-sm" id="btn-back-follow" onclick="acceptfollowedReq({{ $request->userFollowed->id }})">{{ __('Retour abonner') }}</button>    
                    </div>
                </div>
            @endforeach
        @else
        <div class="col-12 text-center">{{ __("Vouz n'avez pas des requestes non acceptées") }}</div>
        @endif
    </div>
    </div>

    
    </div>
</div>
@endsection