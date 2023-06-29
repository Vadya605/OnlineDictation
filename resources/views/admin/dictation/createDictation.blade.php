@vite(['resources/js/admin/displaySelectedDate.js'])
@extends('layouts.adminApp')
@section('content')
<div class="col-8 col-sm-6 offset-sm-3 offset-2">
    <div class="row">
        <div class="col-12">
            <span class="header-content">Добавение диктанта</span>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                @if(session('error'))
                    <x-errors.alert-error :error="session('error')"/> 
                @elseif (session('message'))
                    <x-messages.message-success :message="session('message')" />
                @endif
            </div>
        </div>
    </div>
    <form class="mt-5" action="{{ route('admin.dictation.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Название диктанта *</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                id="title" name="title" value="{{ old('title') }}"
            >
            <x-errors.validation-error field="title" /> 
        </div>
        <div class="mb-3">
            <label for="video_link" class="form-label @error('video_link') is-invalid @enderror">Ссылка на видео</label>
            <input type="text" class="form-control" 
                id="video_link" name="video_link" value="{{ old('video_link') }}"
            >
            <x-errors.validation-error field="video_link" /> 
        </div>
        <div class="mb-3 form-check">
            <label class="form-check-label" for="is_active">Активен</label>
            <input type="hidden" id="is_active" name="is_active" value="0">
            <input type="checkbox" class="form-check-input @error('is_active') is-invalid @enderror" 
                id="is_active" name="is_active" 
                @if (old('is_active') == 1)
                    checked 
                @endif 
                value="1"
            >
            <x-errors.validation-error field="is_active" /> 
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Описание</label>
            <textarea class="form-control @error('description') is-invalid @enderror" 
                name="description" id="description" cols="30" rows="5">{{ old('description') }}</textarea>
            <x-errors.validation-error field="description" /> 
        </div>
        <div class="mb-3 form-check date-time-selection">
            <label class="form-check-label" for="from_date_time" id="label_from_date_time">Дата и время начала <span class="value-selection"></span></label>
            <input type="datetime-local" class="form-check-input @error('from_date_time') is-invalid @enderror" 
                id="from_date_time" name="from_date_time" value="{{ old('from_date_time') }}"
            >
            <x-errors.validation-error field="from_date_time" /> 
        </div>
        <div class="mb-3 form-check date-time-selection">
            <label class="form-check-label" for="to_date_time">Дата и время конца <span class="value-selection"></span></label>
            <input type="datetime-local" class="form-check-input @error('to_date_time') is-invalid @enderror" 
                id="to_date_time" name="to_date_time" value="{{ old('to_date_time') }}"
            >
            <x-errors.validation-error field="to_date_time" /> 
        </div>
        <button type="submit" class="btn btn-primary mb-3">Добавить</button>
    </form>
</div>
@endsection
