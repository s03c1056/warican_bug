@extends('layouts.app')
@section('content')
<!--{{url ('/login')}}-->

<main>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="tereka">
                <div class="card-header">{{ __('新規会員登録') }}</div>

                <div class="loginbox-registaer">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('氏名') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="typebox @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="typebox @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('パスワード') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="typebox @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('パスワード確認') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="typebox" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                            <div class="register">
                                <button type="submit" value="登録" class="btn-gradient-radius-registaer1">
                                    {{ __('登録') }}
                                </button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

                        <div class="register py-3">
                            <a href="{{url ('/login')}}" class="btn-gradient-radius-registaer1">ログイン</a>
                        </div>
                        <div class="register pb-4">
                            <a href="#" class="btn-gradient-radius-registaer1 font14">キャンセル</a>
                        </div>

</main>

@endsection
