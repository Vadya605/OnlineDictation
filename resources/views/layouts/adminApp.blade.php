<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/sass/app.scss', 'resources/css/adminApp.css', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container">
            <a class="navbar-brand text-white" href="#">Админ панель</a>
      
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
      
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('home') }}">Открыть сайт</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Выйти</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <section class="main-section">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-4">
                        <div class="table-list pb-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-list-header text-center bg-primary">
                                        <span class="text-white">Список таблиц</span>
                                    </div>
                                </div>
                            </div>
    
                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="item-list-table d-flex justify-content-between align-items-center">
                                        <a href="{{ route('allDictations') }}" class="link">Диктанты</a>
                                        <a href="{{ route('createDictation') }}" class="btn btn-primary text-white">Добавить</a>
                                    </div>
                                </div>
                            </div>
    
                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="item-list-table d-flex justify-content-between align-items-center">
                                        <a href="{{ route('allUsers') }}" class="link">Пользователи</a>
                                    </div>
                                </div>
                            </div>
    
                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="item-list-table d-flex justify-content-between align-items-center">
                                        <a href="{{ route('allDictationResults') }}" class="link">Результаты диктантов</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @yield('content')
                    
                </div>
            </div>
        </section>
    </main>
      
      
</body>
</html>