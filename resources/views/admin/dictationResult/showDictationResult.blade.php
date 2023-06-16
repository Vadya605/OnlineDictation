@extends('layouts.adminApp')
@section('content')
@vite(['resources/js/admin/confirmDeleting.js'])
<div class="col-md-6">
    <div class="row">
        <div class="col-12">
            <span class="header-content">
                Результат диктанта {{ $dictationResult->dictation->title }} 
                пользователя {{ $dictationResult->user->name }}
            </span>
        </div>
    </div>  
    <div class="row mt-3">
        <div class="col-12">
            <x-errors.session-error />
            <x-messages.message-success />
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="field d-flex flex-column">
                <span class="name-field" >Название диктанта</span>
                <span class="value-field" >{{ $dictationResult->dictation->title }}</span>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="field d-flex flex-column">
                <span class="name-field" >Имя пользователя</span>
                <span class="value-field" >{{ $dictationResult->user->name }}</span>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="field d-flex flex-column">
                <span class="name-field" >Email пользователя</span>
                <span class="value-field" >{{ $dictationResult->user->email }}</span>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="field d-flex flex-column">
                <span class="name-field" >Текст диктанта</span>
                <span class="value-field" >{{ $dictationResult->text_result }}</span>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="field d-flex flex-column">
                <span class="name-field" >Дата написания</span>
                <span class="value-field" >{{ $dictationResult->date }}</span>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-3">
            <x-delete-button :action="route('deleteDictationResult', $dictationResult)" />
        </div>
    </div>
</div>
@endsection