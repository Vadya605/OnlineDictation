{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="/css/main.css">
    <title>Мастер слова</title>
</head>
<body>
    <header>
        <nav class="nav">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="logo">
                            <h1 class="text-white">Мастер слова</h1>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-dark btn-lg" href="/login">Войти</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="offer">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <h1 class="text-center text-black">
                            Добро пожаловать в "Мастер слова": 
                            Онлайн диктанты для совершенствования вашего письменного и 
                            грамматического навыка,
                            перед написанием диктанта Вам необходимо войти в систему или зарегистрироваться
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
</body>
</html> --}}

@extends('layouts.app')
@section('content')
@vite(['resources/css/main.css'])
<div class="offer">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="text-center text-black">
                    Добро пожаловать в "Мастер слова": 
                    Онлайн диктанты для совершенствования вашего письменного и 
                    грамматического навыка,
                    перед написанием диктанта Вам необходимо войти в систему или зарегистрироваться
                </h1>
            </div>
        </div>
    </div>
</div>
@endsection