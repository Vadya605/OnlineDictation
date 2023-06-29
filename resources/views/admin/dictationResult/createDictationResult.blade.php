@vite(['resources/js/admin/displaySelectedDate.js'])
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
@extends('layouts.adminApp')
@section('content')
<div class="col-8 col-sm-6 offset-sm-3 offset-2">
    <div class="row">
        <div class="col-12">
            <span class="fs-3">Добавение результата диктанта</span>
        </div>
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
    <form class="mt-5" action="{{ route('admin.dictationResult.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="dictation_id" class="form-label">Id диктанта *</label>
            <select class="form-select @error('dictation_id') is-invalid @enderror" name="dictation_id">
                @foreach ($dictations as $dictation)
                    <option @if($dictation->id == old('dictation_id')) selected @endif value="{{ $dictation->id }}"> 
                        {{ $dictation->id }} - {{ $dictation->title }}
                    </option>
                @endforeach
            </select>
            <x-errors.validation-error field="dictation_id" /> 
        </div>
        <div class="mb-3">
            <label for="user_id" class="form-label">Id пользователя *</label>
            <select class="form-select @error('user_id') is-invalid @enderror" name="user_id">
                @foreach ($users as $user)
                    <option @if($user->id == old('user_id')) selected @endif value="{{ $user->id }}"> 
                        {{ $user->id }} - {{ $user->name }}
                    </option>
                @endforeach
            </select>
            <x-errors.validation-error field="user_id" /> 
        </div>
        <div class="mb-3">
            <label for="text_result" class="form-label">Текст  диктанта *</label>
            <textarea class="form-control @error('text_result') is-invalid @enderror" name="text_result" 
                id="text_result" cols="30" rows="5">{{ old('text_result') }}</textarea>
            <x-errors.validation-error field="text_result" /> 
        </div>
        <div class="mb-3 form-check date-time-selection">
            <label class="form-check-label" for="date_time_result">Дата и время написания * <span class="value-selection"></span></label>
            <input class="form-check-input @error('date_time_result') is-invalid @enderror" 
                value="{{ old('date_time_result') }}" type="datetime-local" 
                id="date_time_result" name="date_time_result"
            >
            <x-errors.validation-error field="date_time_result" /> 
        </div>
        <button type="submit" class="btn btn-primary mb-3">Сохранить</button>
    </form>
</div>
@endsection