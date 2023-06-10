@extends('layouts.adminApp')
@section('content')
@vite(['resources/css/dictation/allDictation.css'])
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
                <span class="header-content">Диктанты</span>
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Сортировка
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('allDictations', [
                                'column_sort' => 'id', 
                                'option_sort' => 'asc'
                                ]) }}" >
                                По id &uarr;
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('allDictations', [
                                'column_sort' => 'id', 
                                'option_sort' => 'desc'
                                ]) }}">
                                По id &darr;
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('allDictations', [
                                'column_sort' => 'from_date_time', 
                                'option_sort' => 'asc'
                                ]) }}">
                                По дате начала написания
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('allDictations', [
                            'column_sort' => 'to_date_time', 
                            'option_sort' => 'asc']) }}">
                            По дате конца написания
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('allDictations', [
                            'column_sort' => 'created_at', 
                            'option_sort' => 'asc']) }}">
                            По дате создания
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="dictations mb-3">
        @foreach ($dictations as $dictation)
            <div class="row mt-3">
                <div class="col-12">
                    <div class="dictation d-flex justify-content-between align-items-center">
                        <a href="{{ route('editDictation', ['id' => $dictation->id]) }}" class="link">{{ $dictation->title }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        <a href="{{ $dictations->previousPageUrl() }}"><</a>
        <a href="{{ $dictations->nextPageUrl() }}">></a>
    </div>
</div>
@endsection
