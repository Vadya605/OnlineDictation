@extends('layouts.adminApp')
@section('content')
<div class="row justify-content-between align-items-start">
    <div class="col-lg-3 col-md-4 col-sm-6 mt-3">
        <div class="card">
            <div class="card-header">
                Диктанты
            </div>
            <div class="card-body">
                <h5 class="card-title">В системе доступно {{ $countDictation }} диктантов</h5>
                <p class="card-text">В данном разделе находится информация о каждом диктанте системы</p>
                <a href="{{ route('admin.dictation.list') }}" class="btn btn-primary">Перейти в раздел</a>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 mt-3">
        <div class="card">
            <div class="card-header">
                Пользователи
            </div>
            <div class="card-body">
                <h5 class="card-title">В системе зарегистрировано {{ $countUser }} пользователей</h5>
                <p class="card-text">В данном разделе находится информация о каждом пользователе системы</p>
                <a href="{{ route('admin.user.list') }}" class="btn btn-primary">Перейти в раздел</a>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 mt-3">
        <div class="card">
            <div class="card-header">
                Результаты диктантов
            </div>
            <div class="card-body">
                <h5 class="card-title">В системе имеется {{ $countDictationResult }} результатов диктантов</h5>
                <p class="card-text">В данном разделе находится информация о каждом результате диктанта системы</p>
                <a href="{{ route('admin.dictationResult.list') }}" class="btn btn-primary">Перейти в раздел</a>
            </div>
        </div>
    </div>
</div>
@endsection