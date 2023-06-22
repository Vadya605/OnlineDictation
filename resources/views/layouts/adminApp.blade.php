<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Админ панель</title>
    @vite(['resources/sass/app.scss', 'resources/css/adminApp.css', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container">
            <a class="navbar-brand text-white" href="{{ route('admin') }}">Админ панель</a>
      
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
      
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link link-sections text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Разделы
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a href="{{ route('allUsers') }}" class="dropdown-item link-section">Пользователи</a>  
                            <a href="{{ route('allDictations') }}" class="dropdown-item link-section">Диктанты</a>
                            <a href="{{ route('allDictationResults') }}" class="dropdown-item link-section">Результаты диктантов</a>
                        </div>
                    </li>
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
                <div class="content py-3">
                    @yield('content')
                </div>
            </div>
        </section>
    </main>   
</body>
</html>