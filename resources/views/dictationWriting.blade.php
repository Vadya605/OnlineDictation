@extends('layouts.app')
@section('content')
@vite(['/resources/css/dictationWriting.css', '/resources/js/dictationWriting/sendDictation.js'])
<div class="container">
    <div class="row mt-3">
        <div class="col-12">
            <div class="date">
                <span class="date">Дата</span>
            </div>
        </div>
    </div>
    @if ($activeDictation)
        <div class="row mt-3">
            <div class="col-12">
                <div class="title">
                    <h1>{{ $activeDictation->title }}</h1>
                </div>
            </div>
        </div>
        <div class="row flex-row-reverse justify-content-between">
            <div class="col-lg-4">
                <div class="embed-responsive embed-responsive-16by9 d-flex justify-content-md-start justify-content-lg-end mb-3">
                    <iframe class="embed-responsive-item" src="{{ $activeDictation->video_link }}" allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-lg-8">
                <form class="dictation-form" action="{{ route('saveDictationResult') }}" method="post">
                    @csrf
                    <input type="hidden" id="user_id" name="user_id" value="{{ auth()->id() }}">
                    <input type="hidden" id="dictation_id" name="dictation_id" value="{{ $activeDictation->id }}">
                    <div class="mb-3">
                        <textarea class="form-control" placeholder="Текст диктанта" name="text_result" id="text_result" rows="12"></textarea>
                    </div>
                    <button class="btn btn-lg btn-primary save-dictation-result">Отправить на проверку</button>
                </form>
            </div>
        </div>
    @else
        <h1>В настоящее время для Вас нет активного диктанта</h1>
    @endif
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection