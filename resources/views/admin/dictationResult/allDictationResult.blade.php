@extends('layouts.adminApp')
@section('content')
@vite(['resources/js/admin/confirmDeleting.js'])
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
                        <li>
                            <a class="dropdown-item" href="{{ route('allDictationResults', [
                                'column_sort' => 'id', 'option_sort' => 'asc']) }}" >
                                По id &uarr;
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('allDictationResults', [
                                'column_sort' => 'id', 'option_sort' => 'desc']) }}" >
                                По id &darr;
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <x-errors.session-error />
            <x-messages.message-success />
        </div>
    </div>
    <div class="dictation-results">
        @forelse ($dictationResults as $dictationResult)
            <div class="row mt-3">
                <div class="col-12">
                    <div class="dictation d-flex justify-content-between align-items-center">
                        <a href="{{ route('showDictationResult', $dictationResult) }}" class="link">
                            {{ $dictationResult->user->name }}:
                            {{ $dictationResult->dictation->title }}
                        </a>
                        <x-delete-button :action="route('deleteDictationResult', $dictationResult)" />
                    </div>
                </div>
            </div>
        @empty
            <h1 class="mt-3">Нет результатов диктантов</h1> 
        @endforelse
        <div class="d-flex justify-content-center">
            <a href="{{ $dictationResults->previousPageUrl() }}"><</a>
            <a href="{{ $dictationResults->nextPageUrl() }}">></a>
        </div>
    </div>
    
</div>
@endsection
