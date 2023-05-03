@extends('layouts.app-master')

<?php
    $user = auth()->user();
?>

@section('content')
    <div class="bg-light p-5 rounded">
        <h3>Настройки пользователя {{$user->name}}</h3>
        <form>
            <div class="form-group">
                <label for="name">Пользователь</label>
                <input type="text" class="form-control" id="name" aria-describedby="nameHelp" value="{{$user->name}}" required>
                <small id="nameHelp" class="form-text text-muted">Название пользователя для входа в аккаунт</small>
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" id="password" class="form-control" aria-describedby="passwordHelp" placeholder="Введите новый пароль для изменения">
                <small id="passwordHelp" class="form-text text-muted">Пароль для входа в аккаунт</small>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" value="{{$user->email}}" placeholder="Введите электронный адрес" required>
                <small id="emailHelp" class="form-text text-muted">Обязательное поле</small>
            </div>
            <div class="form-group">
                <label for="phone_number">Номер телефона</label>
                <input type="text" class="form-control" id="phone_number" aria-describedby="phoneNumberHelp" placeholder="Введите номер телефона" value="{{$user->phone_number}}">
                <small id="phoneNumberHelp" class="form-text text-muted">Не обязательное поле</small>
            </div>
            <div class="form-group">
                <label for="telegram_id">Телеграм username</label>
                <input type="text" class="form-control" id="telegram_id" aria-describedby="telegramIdHelp" placeholder="Введите телеграм никнейм" value="{{$user->telegram_id}}">
                <small id="telegramIdHelp" class="form-text text-muted">Не обязательное поле.</small>
            </div>
            <div class="form-group">
                <label for="about">Обо мне</label>
                <textarea class="form-control" id="about" aria-describedby="aboutHelp" placeholder="Введите информацию о себе">{{$user->about}}</textarea>
                <small id="aboutHelp" class="form-text text-muted">Не обязательное поле.</small>
            </div>
            <button type="button" data-toggle="modal" data-target="#staticBackdrop" class="btn btn-primary" id="prepare-to-save">Сохранить изменения</button>
        </form>
    </div>
@endsection
