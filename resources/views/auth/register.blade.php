@extends('layouts.app')

@section('title','Register')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">
            
            <div class="card">

                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    {!! Form::open(['route' => 'register']) !!}
                        
                        <div class="form-group row p-2">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
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
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}">
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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="{{ __('Ecriver un mail valide!') }}">
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
                                <select class="form-select country" name="country" id="country">
                                    <?php $countrys = App\Http\Controllers\MyFunc\Myfunc::country(); ?>
                                    @foreach($countrys as $country)
                                        <option value="{{$country->id}}">{{ __($country->country) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row p-2">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('Ville') }}</label>
                            <div class="col-md-6">
                                <select class="form-select city @error('city') is-invalid @enderror" name="city" id="city">
                                   <option value="">{{ __("Sélectez d'abord le pays") }}</option>
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
                                    {{ __('Enregistrer') }}
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

