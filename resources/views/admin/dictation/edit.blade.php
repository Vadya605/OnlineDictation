@push('js')
    <script>
        const fromDateTime =  {!! json_encode($dictation->from_date_time) !!}
        const toDateTime =  {!! json_encode($dictation->to_date_time) !!}
    </script>
    @vite(['resources/js/admin/dictation/initDateUpdate.js'])
@endpush
@extends('layouts.adminApp')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8 col-sm-12">
        <div class="row">
            <div class="col-12">
                <span class="header-content">Диктант {{ $dictation->title }}</span>
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
        <form class="mt-5" action="{{ route('admin.dictation.update', $dictation) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Название диктанта *</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                    id="title" name="title" value="{{ old('title')?? $dictation->title }}"
                >
                <x-errors.validation-error field="title" /> 
            </div>
            <div class="mb-3">
                <label for="video_link" class="form-label @error('video_link') is-invalid @enderror">Ссылка на видео</label>
                <input type="text" class="form-control" 
                    id="videoLink" name="video_link" value="{{ old('video_link')?? $dictation->video_link }}"
                >
                <x-errors.validation-error field="video_link" /> 
            </div>
            <div class="mb-3 form-check">
                <label class="form-check-label" for="is_active">Активен</label>
                <input type="hidden" id="isActive" name="is_active" value="0">
                <input type="checkbox" class="form-check-input @error('is_active') is-invalid @enderror" 
                    id="isActive" name="is_active" 
                    @if (old('is_active') == 1 || $dictation->is_active == 1)
                        checked 
                    @endif 
                    value="1"
                >
                <x-errors.validation-error field="is_active" /> 
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                    name="description" id="description" cols="30" rows="5">{{ old('description')?? $dictation->description }}</textarea>
                <x-errors.validation-error field="description" /> 
            </div>
            <div class="mb-3">
                <label class="form-label" for="from_date_time">Дата и время начала</label>
                <input type="text" class="form-control @error('from_date_time') is-invalid @enderror"
                    name="from_date_time" id="fromDateTime" 
                    value="{{ old('from_date_time') }}"
                >
                <x-errors.validation-error field="from_date_time" /> 
            </div>
            <div class="mb-3">
                <label class="form-label" for="to_date_time">Дата и время окончания</label>
                <input type="text" class="form-control @error('to_date_time') is-invalid @enderror"
                    name="to_date_time" id="toDateTime" 
                    value="{{ old('to_date_time') }}"
                >
                <x-errors.validation-error field="to_date_time" /> 
            </div>
            <button type="submit" class="btn btn-primary mb-3">Сохранить</button>
        </form>
    </div>
</div>
@endsection
