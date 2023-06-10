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
            <form class="form-delete row mt-3" action="{{ route('deleteDictationResult', ['id' => $dictationResult->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger text-white">Удалить</button>
            </form>
        </div>
    </div>
</div>
@endsection