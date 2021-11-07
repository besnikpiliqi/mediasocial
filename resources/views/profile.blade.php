@extends('layouts.app')
@section('titre','Profile')

@section('content')
<div class="row py-5 d-flex justify-content-center">
<div class="mb-3 w-75">
        <div class="card-body p-0">
            <h4><b>{{ __('Profile') }}</b></h4>
        </div>
    </div>
    <div class="card mb-3 w-75">
        <div class="card-body">
            <div class="row">
            <div class="col-sm-3 col-md-3">
                <img src="{{ asset($profile->photo) }}" class="rounded w-100">
            </div>
                <div class="col-9 col-md-9">
                    <div class="col-12 p-1"><small class="text-muted">Nom: </small>{{ $profile->name }}</div>
                    <div class="col-12 p-1"><small class="text-muted">Mail: </small>{{ $profile->email }}</div>
                    <div class="col-12 p-1"><small class="text-muted">Ville: </small>{{ $profile->city->city }}</div>
                    <div class="col-12 p-1"><small class="text-muted">Pays: </small>{{ $profile->city->country->country }}</div>
                    <div class="col-12 p-1"><small class="text-muted">Abonnés: </small><button onclick="followed({{ $profile->id }})" data-bs-toggle="modal" data-bs-target="#modalabonnes" type="button" class="btn btn-primary btn-sm" id="followed" style="min-width: 10%;">{{ $profile->followed_count }}</button></div>
                    <div class="col-12 p-1"><small class="text-muted">Abonnement: </small> <button onclick="following({{ $profile->id }})" data-bs-toggle="modal" data-bs-target="#modalabonnes" type="button" class="btn btn-primary btn-sm" id="following" style="min-width: 10%;"> {{ $profile->following_count }}</button></div>
                    @if($profile->id == auth()->id())
                    <div class="col-12 p-1"><a href="{{ route('edit-profile') }}" class="btn btn-primary btn-sm">{{ __('Modifier le profile') }}</a></div>
                    @elseif(App\Http\Controllers\MyFunc\Myfunc::following($profile))
                        <div class="col-12 p-1"><button type="button" class="btn btn-primary btn-sm" onclick="unfollow(this,{{ $profile->id }})">{{ __('Abonné') }}</button></div>
                    @elseif(App\Http\Controllers\MyFunc\Myfunc::followed($profile))
                        <div class="col-12 p-1">
                            <button type="button" class="btn btn-primary btn-sm" id="btn-back-follow" onclick="follow(this,{{ $profile->id }})" style="margin-right: 10px;">{{ __('Retour abonner') }}</button>
                            <button type="button" class="btn btn-primary btn-sm" id="btn-cancel-follow" onclick="cancelfollProf({{ $profile->id }})">{{ __('Retirer') }}</button>
                        </div>
                    @else
                        <div class="col-12 p-1"><button type="button" class="btn btn-primary btn-sm" onclick="follow(this,{{ $profile->id }})">{{ __('Abonner') }}</button></div>
                    @endif               
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3 w-75">
        <div class="card-body p-0">
          <div class="row">
            <div class="col-6">
                <div class="col-12">{{ __('Ses votes dans des publications: ') }}</div>
                <div class="col-12">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalcomportement" onclick="openComportStars({{ $profile->id }},'Ses votes dans des publications')">
                        <span class="badge bg-secondary">{{ number_format($profile->likes_post_avg_stars) }}</span>
                        <span class="fa fa-star" @if(number_format($profile->likes_post_avg_stars) >= 1) style="color:orange" @endif></span>
                        <span class="fa fa-star" @if(number_format($profile->likes_post_avg_stars) >= 2) style="color:orange" @endif></span>
                        <span class="fa fa-star" @if(number_format($profile->likes_post_avg_stars) >= 3) style="color:orange" @endif></span>
                        <span class="fa fa-star" @if(number_format($profile->likes_post_avg_stars) >= 4) style="color:orange" @endif></span>
                        <span class="fa fa-star" @if(number_format($profile->likes_post_avg_stars) == 5) style="color:orange" @endif></span> {{ __('Votes') }} <span class="badge bg-secondary">{{ $profile->likes_post_count }}</span>
                    </button>
                </div>
            </div>
            <div class="col-6">
            <div class="col-12 d-flex flex-row-reverse">{{ __('Ses votes dans des commentaires: ') }}</div>
                <div class="col-12 d-flex flex-row-reverse">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalcomportement" onclick="openComportStars({{ $profile->id }},'Ses votes dans des commentaires')">
                        <span class="badge bg-secondary">{{ number_format($profile->likes_comment_avg_stars) }}</span>
                        <span class="fa fa-star" @if(number_format($profile->likes_comment_avg_stars) >= 1) style="color:orange" @endif></span>
                        <span class="fa fa-star" @if(number_format($profile->likes_comment_avg_stars) >= 2) style="color:orange" @endif></span>
                        <span class="fa fa-star" @if(number_format($profile->likes_comment_avg_stars) >= 3) style="color:orange" @endif></span>
                        <span class="fa fa-star" @if(number_format($profile->likes_comment_avg_stars) >= 4) style="color:orange" @endif></span>
                        <span class="fa fa-star" @if(number_format($profile->likes_comment_avg_stars) == 5) style="color:orange" @endif></span> {{ __('Votes') }} <span class="badge bg-secondary">{{ $profile->likes_comment_count }}</span>
                    </button>
                </div>
            </div>
          </div>
        </div>
    </div>
    <div class="mb-3 w-75">
        <div class="card-body p-0">
          <div class="row">
            <div class="col-6">
                <div class="col-12">{{ __('Des votes dans ses publicatioons: ') }}</div>
                <div class="col-12">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalcomportement" onclick="openComportStars({{ $profile->id }},'Des votes dans ses publicatioons')">
                        <span class="badge bg-secondary">{{ number_format($profile->have_liked_post_avg_stars) }}</span>
                        <span class="fa fa-star" @if(number_format($profile->have_liked_post_avg_stars) >= 1) style="color:orange" @endif></span>
                        <span class="fa fa-star" @if(number_format($profile->have_liked_post_avg_stars) >= 2) style="color:orange" @endif></span>
                        <span class="fa fa-star" @if(number_format($profile->have_liked_post_avg_stars) >= 3) style="color:orange" @endif></span>
                        <span class="fa fa-star" @if(number_format($profile->have_liked_post_avg_stars) >= 4) style="color:orange" @endif></span>
                        <span class="fa fa-star" @if(number_format($profile->have_liked_post_avg_stars) == 5) style="color:orange" @endif></span> {{ __('Votes') }} <span class="badge bg-secondary">{{ $profile->have_liked_post_count }}</span>
                    </button>
                </div>
            </div>
            <div class="col-6">
            <div class="col-12 d-flex flex-row-reverse">{{ __('Des votes dans ses commentaires: ') }}</div>
                <div class="col-12 d-flex flex-row-reverse">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalcomportement" onclick="openComportStars({{ $profile->id }},'Des votes dans ses commentaires')">
                        <span class="badge bg-secondary">{{ number_format($profile->have_liked_comment_avg_stars) }}</span>
                        <span class="fa fa-star" @if(number_format($profile->have_liked_comment_avg_stars) >= 1) style="color:orange" @endif></span>
                        <span class="fa fa-star" @if(number_format($profile->have_liked_comment_avg_stars) >= 2) style="color:orange" @endif></span>
                        <span class="fa fa-star" @if(number_format($profile->have_liked_comment_avg_stars) >= 3) style="color:orange" @endif></span>
                        <span class="fa fa-star" @if(number_format($profile->have_liked_comment_avg_stars) >= 4) style="color:orange" @endif></span>
                        <span class="fa fa-star" @if(number_format($profile->have_liked_comment_avg_stars) == 5) style="color:orange" @endif></span> {{ __('Votes') }} <span class="badge bg-secondary">{{ $profile->have_liked_comment_count }}</span>
                    </button>
                </div>
            </div>
          </div>
        </div>
    </div>
    <div class="mb-3 w-75">
        <div class="card-body p-0">
          <div class="row">
            <div class="col-6"><h6>{{ __('Les postes') }} <span class="badge bg-secondary">{{ $profile->posts_count }}</span></h6></div>
            @if($profile->id == auth()->id())
            <div class="col-6 d-flex flex-row-reverse">
              <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalmakepost">
                {{ __('Créér un post') }}
              </button>
            </div>
            @endif
          </div>
        </div>
    </div>
    @foreach($posts as $post)
      <div class="card mb-3 w-75 posts"  id="post-{{ $post->id }}">
          <div class="card-body">
              <div class="card-title body-profile">
                  <div class="row">
                      <div class="col-md-1 col-sm-2 img-profile">
                          <img src="{{ asset($profile->photo) }}">
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
            @if($post->photo)
                <img src="{{ asset($post->photo) }}" class="card-img-bottom" alt="...">
            @endif
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