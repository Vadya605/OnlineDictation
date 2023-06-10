@extends('layouts.adminApp')
@section('content')
@vite(['resources/css/dictation/allDictation.css'])
<div class="col-md-6">
    <div class="row">
        <div class="col-12">
            <span class="header-content">Создать диктант</span>
        </div>
        <div class="row">
            <div class="col-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <form class="mt-5" action="{{ route('storeDictation') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Название диктанта *</label>
            <input type="text" class="form-control" @error('title') is-invalid @enderror value="{{ old('title') }}" id="title" name="title">
            {{-- @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror --}}
        </div>
        <div class="mb-3">
            <label for="video_link" class="form-label">Ссылка на видео</label>
            <textarea class="form-control" name="video_link" id="video_link" cols="30" rows="5"></textarea>
        </div>
        <div class="mb-3 form-check">
            <input type="hidden" id="is_active" name="is_active" value="0">
            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1">
            <label class="form-check-label" for="is_active">Активен</label>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="5"></textarea>
        </div>
        <div class="mb-3 form-check">
            <input type="datetime-local" class="form-check-input" id="from_date_time" name="from_date_time">
            <label class="form-check-label" for="from_date_time">Дата и время начала</label>
        </div>
        <div class="mb-3 form-check">
            <input type="datetime-local" class="form-check-input" id="to_date_time" name="to_date_time">
            <label class="form-check-label" for="to_date_time">Дата и время конца</label>
        </div>
        <button type="submit" class="btn btn-primary mb-3">Добавить</button>
    </form>
</div>
@endsection
