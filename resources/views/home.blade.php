@extends('layouts.app')
@section('content')
@vite(['resources/css/main.css'])
<div class="offer">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 text-center">
                <h1>Добро пожаловать в "Мастер слова"</h1>
                <h2 class="mt-5">Онлайн диктанты для совершенствования вашего письменного и грамматического навыка</h2>
                <h3 class="mt-3">Перед написанием диктанта Вам необходимо войти в систему или зарегистрироваться</h3>
                @auth
                    <a class="btn btn-lg btn-dark mt-3" href="{{ route('dictationWriting') }}">Написать диктант</a>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection