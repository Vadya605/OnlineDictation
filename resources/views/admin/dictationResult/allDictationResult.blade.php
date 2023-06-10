@extends('layouts.adminApp')
@section('content')
@vite(['resources/js/admin/confirmDeleting.js'])
@if ($errors->any())
<ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>
@endif
<div class="col-md-6">
    <div class="row justify-content-between">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <span class="header-content">Результаты диктантов</span>
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Сортировка
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?column_sort=id&option_sort=asc">По id &uarr;</a></li>
                        <li><a class="dropdown-item" href="?column_sort=id&option_sort=desc">По id &darr;</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="dictation-results">
        @foreach ($dictationResults as $dictationResult)
            <div class="row mt-3">
                <div class="col-12">
                    <div class="dictation d-flex justify-content-between align-items-center">
                        <a href="{{ route('showDictationResult', ['id' => $dictationResult->id]) }}" class="link">
                            {{ $dictationResult->user->name }}:
                            {{ $dictationResult->dictation->title }}
                        </a>
                        <form class="form-delete" action="{{ route('deleteDictationResult', ['id' => $dictationResult->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger text-white">Удалить</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        <a href="{{ $dictationResults->previousPageUrl() }}"><</a>
        <a href="{{ $dictationResults->nextPageUrl() }}">></a>
    </div>
</div>
@endsection
