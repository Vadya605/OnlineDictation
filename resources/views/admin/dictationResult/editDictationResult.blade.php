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
            @elseif (session('message'))
                <x-messages.message-success :message="session('message')" />
            @endif
        </div>
    </div>
    <form class="mt-5" action="{{ route('admin.dictationResult.update', $dictationResult) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="dictation_result_id" value="{{ $dictationResult->id }}">
        <div class="mb-3">
            <label for="dictation_id" class="form-label">Id диктанта *</label>
            <select class="form-select @error('dictation_id') is-invalid @enderror" name="dictation_id">
                @foreach ($dictations as $dictation)
                    <option value="{{ $dictation->id }}"
                        @if (!old('dictation_id') && $dictation->id == $dictationResult->dictation->id)
                            selected
                        @elseif (old('dictation_id') == $dictation->id)
                            selected
                        @endif
                    > 
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
                    <option value="{{ $user->id }}"
                        @if (!old('user_id') && $user->id == $dictationResult->user->id)
                            selected
                        @elseif (old('user_id') == $user->id)
                            selected
                        @endif
                    > 
                        {{ $user->id }} - {{ $user->name }}
                    </option>
                @endforeach
            </select>
            <x-errors.validation-error field="user_id" /> 
        </div>
        <div class="mb-3">
            <label for="text_result" class="form-label">Текст  диктанта</label>
            <textarea class="form-control @error('text_result') is-invalid @enderror" 
                name="text_result" id="text_result" cols="30" rows="5">{{ old('text_result')?old('text_result'):$dictationResult->text_result }}
            </textarea>
            <x-errors.validation-error field="text_result" /> 
        </div>
        <div class="mb-3 form-check date-time-selection">
            <label class="form-check-label" for="date_time_result">Дата и время написания * <span class="value-selection"></span></label>
            <input class="form-check-input @error('date_time_result') is-invalid @enderror" 
                value="{{  old('date_time_result')?old('date_time_result'): $dictationResult->date_time_result }}" type="datetime-local" 
                id="date_time_result" name="date_time_result"
            >
        </div>
        <button type="submit" class="btn btn-primary mb-3">Сохранить</button>
    </form>
</div>
@endsection