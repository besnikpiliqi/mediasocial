@extends('layouts.app')

@section('content')
<div class="row py-5 d-flex justify-content-center">
    <div class="card mb-3 w-75">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-6 col-md-6">{{ __('Actualités') }}</div>
            <div class="col-6 col-md-6 d-flex flex-row-reverse">
              <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalmakepost">
                {{ __('Créér un post') }}
              </button>
            </div>
          </div>
        </div>
    </div>
    @if($posts->count())
      @foreach($posts as $post)
      <div class="card mb-3 w-75 posts"  id="post-{{ $post->id }}">
            <div class="card-body">
                <div class="card-title body-profile">
                    <div class="row">
                        <div class="col-md-1 col-sm-2 img-profile">
                            <img src="{{ asset($post->user->photo) }}">
                        </div>
                        <div class="col-md-7 col-sm-6">
                            <span class="card-title name-profile">{{ $post->user->name }}</span>
                        </div>
                        @can(['update-post', 'delete-post'], $post)
                        <div class="col-4 d-flex flex-row-reverse">
                              <div class="d-flex">
                                  <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modalmodifiercomment" onclick="editPost({{ $post->id }})"><i class="bi bi-pencil"></i></button>
                                  <button type="button" class="btn" onclick="removePost({{ $post->id }})"><i class="bi bi-trash"></i></button>
                              </div>
                        </div>
                        @endcan
                    </div>
                </div>
                <p class="card-text content">{{ $post->content }}</p>
                <p class="card-text"><small class="text-muted">{{ $post->cree_at }}</small></p>
            </div>
            <div class="card-body photo-post @if(!$post->photo) {{ __('d-none') }} @endif">
              <img src="{{ asset($post->photo) }}" class="card-img-bottom">
            </div>
            <div class="card-body border-top">
                <div class="row">
                    <?php $stars = App\Http\Controllers\MyFunc\Myfunc::avg($post->likes); ?>
                    <div class="col-6" id="btn-vote-post-{{ $post->id }}">
                        <button type="button" class="btn btn-primary btn-sm show-stars" onclick="starsPost({{$post->id}})" data-bs-toggle="modal" data-bs-target="#modaletoilespost">
                            <span class="badge bg-secondary">{{ $stars }}</span>
                            <span class="fa fa-star" @if($stars >= 1) style="color:orange" @endif></span>
                            <span class="fa fa-star" @if($stars >= 2) style="color:orange" @endif></span>
                            <span class="fa fa-star" @if($stars >= 3) style="color:orange" @endif></span>
                            <span class="fa fa-star" @if($stars >= 4) style="color:orange" @endif></span>
                            <span class="fa fa-star" @if($stars == 5) style="color:orange" @endif></span> {{ __('Votes') }} <span class="badge bg-secondary">{{ $post->likes_count }}</span>
                        </button>
                        <?php $voted = App\Http\Controllers\MyFunc\Myfunc::voted($post->likes); ?>
                        <span class="btn-voted" style="color: gray;font-weight: bold;font-size: 12px;">@if($voted) {{ __('Voted') }} @endif</span>
                    </div>
                    <div class="col-6 d-flex flex-row-reverse">
                        <button type="button" class="btn btn-primary btn-sm" onclick="comments({{ $post->id }})" data-bs-toggle="modal" data-bs-target="#modalcommentes"> {{ __('Commentes') }} <span class="badge bg-secondary comment-count">{{ $post->comments_count }}</span> </button>
                    </div>
                </div>
            </div>
        </div>
      @endforeach
    @else
    <div class="d-flex justify-content-center">{{ __('Vous devez faire des abonnements pour voir des publications!') }}</div>
    @endif
    @if($posts->count() > 4)
    <div class="d-flex justify-content-center">
      <style>
        .w-5{
          display:none;
        }
      </style>
    {{ $posts->links() }}
    </div>
    @endif
    </div>
</div>


@include('layouts.modals')
@endsection
