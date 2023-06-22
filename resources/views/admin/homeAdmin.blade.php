@extends('layouts.adminApp')
@section('content')
<div class="row justify-content-md-start justify-content-sm-center">
    <div class="col-md-5 col-sm-8">
        <div class="table-list pb-5">
            <div class="row">
                <div class="col-12">
                    <div class="table-list-header text-center bg-primary">
                        <span class="text-white">Разделы</span>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                    <div class="item-list-table">
                        <a href="{{ route('allDictations') }}" class="link link-section">Диктанты</a>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                    <div class="item-list-table">
                        <a href="{{ route('allUsers') }}" class="link link-section">Пользователи</a>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                    <div class="item-list-table">
                        <a href="{{ route('allDictationResults') }}" class="link link-section">Результаты диктантов</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection