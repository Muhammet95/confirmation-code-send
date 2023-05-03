@extends('layouts.auth-master')

@section('content')
    <form method="post" action="{{ route('login.perform') }}">

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <img class="mb-4" src="{!! url('images/logo.jpeg') !!}" alt="" width="72" height="57">

        <h1 class="h3 mb-3 fw-normal">Вход</h1>

        @include('layouts.partials.messages')

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="name" required="required" autofocus>
            <label for="floatingName">Пользователь</label>
            @if ($errors->has('name'))
                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
            @endif
        </div>

        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
            <label for="floatingPassword">Пароль</label>
            @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <button class="w-100 btn btn-lg btn-primary mb-4" type="submit">Войти</button>
        <a href="{{route('register')}}" class="w-100 btn btn-sm btn-info" type="submit">или регистрация нового пользователя</a>

        @include('auth.partials.copy')
    </form>
@endsection
