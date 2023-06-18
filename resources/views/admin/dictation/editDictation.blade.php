@extends('layouts.adminApp')
@section('content')
@vite(['resources/css/dictation/allDictation.css'])
<div class="col-md-6">
    <div class="row">
        <div class="col-12">
            <span class="header-content">Диктант {{ $dictation->title }}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <x-errors.validation-errors />
            <x-errors.session-error />
            <x-messages.message-success />
        </div>
    </div>
    <form class="mt-5" action="{{ route('updateDictation', $dictation) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="id" class="form-label">Id *</label>
            <input type="text" class="form-control" id="id" name="id" value="{{ $dictation->id }}" disabled>
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Название диктанта *</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $dictation->title }}">
        </div>
        <div class="mb-3">
            <label for="video_link" class="form-label">Ссылка на видео</label>
            <textarea value="{{ $dictation->video_link }}" class="form-control" name="video_link" id="video_link" cols="30" rows="5">{{$dictation->video_link}}</textarea>
        </div>
        <div class="mb-3 form-check">
            <input type="hidden" id="is_active" name="is_active" value="0">
            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value='1' {{ $dictation->is_active!=1?: 'checked' }}>
            <label class="form-check-label" for="is_active">Активен</label>
        </div>
        <div class="mb-3 form-check">
            <input value="{{ $dictation->from_date_time }}" type="datetime-local" class="form-check-input" id="from_date_time" name="from_date_time">
            <label class="form-check-label" for="from_date_time">Дата и время начала</label>
        </div>
        <div class="mb-3 form-check">
            <input value="{{ $dictation->to_date_time }}" type="datetime-local" class="form-check-input" id="to_date_time" name="to_date_time">
            <label class="form-check-label" for="to_date_time">Дата и время конца</label>
        </div>
        <div class="mb-3 form-check">
            <input value="{{ $dictation->created_at }}" type="date" class="form-check-input" id="created_at" name="created_at">
            <label class="form-check-label" for="created_at">Дата создания диктанта</label>
        </div>
        
        <button type="submit" class="btn btn-primary mb-3">Сохранить</button>
    </form>
</div>
@endsection
