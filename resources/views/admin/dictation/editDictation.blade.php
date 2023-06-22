@vite(['resources/js/admin/displaySelectedDate.js'])
@extends('layouts.adminApp')
@section('content')
<div class="col-8 col-sm-6 offset-sm-3 offset-2">
    <div class="row">
        <div class="col-12">
            <span class="header-content">Диктант {{ $dictation->title }}</span>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            @if(session('error'))
                <x-errors.alert-error :error="session('error')"/> 
            @elseif ($errors->any())
                @foreach ($errors->all() as $error)
                    <x-errors.alert-error :error="$error"/> 
                @endforeach
            @elseif (session('message'))
                <x-messages.message-success :message="session('message')" />
            @endif
        </div>
    </div>
    <form class="mt-5" action="{{ route('updateDictation', $dictation) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Название диктанта *</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $dictation->title }}">
        </div>
        <div class="mb-3">
            <label for="video_link" class="form-label">Ссылка на видео</label>
            <input type="text" class="form-control" id="video_link" name="video_link" value="{{ $dictation->video_link }}">
        </div>
        <div class="mb-3 form-check">
            <input type="hidden" id="is_active" name="is_active" value="0">
            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value='1' {{ $dictation->is_active!=1?: 'checked' }}>
            <label class="form-check-label" for="is_active">Активен</label>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="5">{{ $dictation->description }}</textarea>
        </div>
        <div class="mb-3 form-check date-time-selection">
            <input value="{{ $dictation->from_date_time }}" type="datetime-local" class="form-check-input" id="from_date_time" name="from_date_time">
            <label class="form-check-label" for="from_date_time">Дата и время начала <span class="value-selection"></span></label>
        </div>
        <div class="mb-3 form-check date-time-selection">
            <input value="{{ $dictation->to_date_time }}" type="datetime-local" class="form-check-input" id="to_date_time" name="to_date_time">
            <label class="form-check-label" for="to_date_time">Дата и время конца <span class="value-selection"></span></label>
        </div> 
        <button type="submit" class="btn btn-primary mb-3">Сохранить</button>
    </form>
</div>
@endsection
