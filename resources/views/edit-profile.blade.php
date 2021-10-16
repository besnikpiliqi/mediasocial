@extends('layouts.app')

@section('title','Profile')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">
            @if(Session('success'))
            <div class="alert alert-info" role="alert">
                {{ __(Session('success')) }}
            </div>
            @endif
            <div class="card">

                <div class="card-header">{{ __('Profile') }}</div>

                <div class="card-body">
                    {!! Form::open(['url'=>'edit-profile','files'=>true]) !!}
                        <div class="form-group row p-2">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-sm-3 col-md-3 image-modal-post">
                                        <img src="{{ asset('storage/'.$profile->photo) }}" class="rounded w-100">
                                    </div>
                                    <div class="col-sm-9 col-md-9">
                                        <label class="input-group-text  @error('file') is-invalid @enderror" for="file-edit-profile">{{ __('Modifier') }}</label>
                                        <input type="file" name="file" class="form-control file-edit-profile" id="file-edit-profile">
                                        @error('file')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row p-2">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $profile->name }}">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row p-2">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>
                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') ?? $profile->username }}">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row p-2">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $profile->email }}" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="{{ __('Ecriver un mail valide!') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row p-2">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Pays') }}</label>
                            <div class="col-md-6">
                                <select class="form-select country" name="country_id" aria-label="Default select example">
                                    @foreach($countrys as $country)
                                        @if($country->id == $profile->city->country->id)
                                            <option selected value="{{$country->id}}">{{ __($country->country) }}</option>
                                        @else
                                            <option value="{{$country->id}}">{{ __($country->country) }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row p-2">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('Ville') }}</label>
                            <div class="col-md-6">
                                <select class="form-select city @error('city') is-invalid @enderror" name="city">
                                    @foreach($countrys as $country)
                                        @if($country->id == $profile->city->country->id)
                                            @foreach($country->citys as $city)
                                                @if($city->id == $profile->city_id)
                                                    <option selected="selected" value="{{$city->id}}">{{ __($city->city) }}</option>
                                                @else
                                                    <option value="{{$city->id}}">{{ __($city->city) }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row p-2">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Nouveau mode de passe') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row p-2">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmer le mode de passe') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row p-2 mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Modifier') }}
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

