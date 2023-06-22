@vite(['resources/js/admin/displaySelectedDate.js'])
@extends('layouts.adminApp')
@section('content')
<div class="col-8 col-sm-6 offset-sm-3 offset-2">
    <div class="row">
        <div class="col-12">
            <span class="fs-3">Результат диктанта "{{ $dictationResult->dictation->title }}" пользователя {{ $dictationResult->user->name }}</span>
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
    <form class="mt-5" action="{{ route('updateDictationResult', $dictationResult) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="dictation_id" class="form-label">Id диктанта *</label>
            <input type="text" class="form-control" id="dictation_id" name="dictation_id" value="{{ $dictationResult->dictation->id }}">
        </div>
        <div class="mb-3">
            <label for="user_id" class="form-label">Id пользователя *</label>
            <input type="text" class="form-control" id="user_id" name="user_id" value="{{ $dictationResult->user->id }}">
        </div>
        <div class="mb-3">
            <label for="text_result" class="form-label">Текст  диктанта</label>
            <textarea class="form-control" name="text_result" id="text_result" cols="30" rows="5">{{ $dictationResult->text_result }}</textarea>
        </div>
        <div class="mb-3 form-check date-time-selection">
            <input value="{{ $dictationResult->date_time_result }}" type="datetime-local" class="form-check-input" id="date_time_result" name="date_time_result">
            <label class="form-check-label" for="to_date_time">Дата и время написания * <span class="value-selection"></span></label>
        </div>
        <button type="submit" class="btn btn-primary mb-3">Сохранить</button>
    </form>
</div>
@endsection