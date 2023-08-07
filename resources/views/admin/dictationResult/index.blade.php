@push('js')
    @vite(['resources/js/admin/sorting.js', 'resources/js/admin/filter.js', 
        'resources/js/admin/pagination.js', 'resources/js/admin/reset.js', 
        'resources/js/admin/dictationResult/initAutoCompleteSearch.js', 
        'resources/js/admin/dictationResult/create.js', 'resources/js/admin/dictationResult/update.js',
        'resources/js/admin/dictationResult/delete.js', 'resources/js/admin/dictationResult/clearSearch.js'
    ])
@endpush
@extends('layouts.adminApp')
@section('content')
<x-modal-windows.confirm-deleting /> 
<x-loader />
<div class="modal-create">
    <div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Добавить результат диктанта</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <form id="formCreate" action="" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="dictation_id" class="form-label">Id диктанта *</label>
                                <select class="form-select" name="dictation_id">
                                    @foreach ($dictations as $dictation)
                                        <option value="{{ $dictation->id }}"> 
                                            {{ $dictation->id }} - {{ $dictation->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="user_id" class="form-label">Id пользователя *</label>
                                <select class="form-select" name="user_id">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"> 
                                            {{ $user->id }} - {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="text_result" class="form-label">Текст диктанта *</label>
                                <textarea class="form-control" name="text_result" id="textResult" cols="30" rows="5"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="date_time_result">Дата и время написания * <span class="value-selection"></span></label>
                                <input class="form-control"  type="text" id="dateTimeResult" name="date_time_result">
                            </div>
                            <button type="submit" name="btnAdd" class="btn btn-primary mb-3">Добавить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-update">
    <div class="modal fade" id="modalUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Изменить результат диктанта</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <form id="formUpdate" action="" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id">
                            <div class="mb-3">
                                <label for="dictation_id" class="form-label">Id диктанта *</label>
                                <select class="form-select" name="dictation_id">
                                    @foreach ($dictations as $dictation)
                                        <option value="{{ $dictation->id }}"> 
                                            {{ $dictation->id }} - {{ $dictation->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="user_id" class="form-label">Id пользователя *</label>
                                <select class="form-select" name="user_id">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"> 
                                            {{ $user->id }} - {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="text_result" class="form-label">Текст диктанта *</label>
                                <textarea class="form-control" name="text_result" id="textResult" cols="30" rows="5"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="date_time_result">Дата и время написания * <span class="value-selection"></span></label>
                                <input class="form-control"  type="text" id="dateTimeResult" name="date_time_result">
                            </div>
                            <button type="submit" name="btnUpdate" class="btn btn-primary mb-3">Сохранить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="d-flex flex-md-row flex-column align-items-md-center align-items-start justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <span class="fs-1">Результаты диктантов</span>
                <span class="badge fs-6 bg-primary text-white total-records">{{ $dictationResults->total() }}</span>
            </div>
            <x-buttons.create-button textBtn="Добавить результат" />
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-6 col-sm-12">
        <x-alert-message />
    </div>
</div>
<div class="row mt-3">
    <div class="col-12">
        <form id="formFilters" action="" method="get">
            <div class="d-flex justify-content-between flex-column flex-md-row gap-2">
                <div class="d-flex align-items-end flex-wrap gap-1">
                    <div class="d-flex flex-column flex-sm-row gap-1">
                        <select class="form-control select-2" id="searchDictation" name="dictation"></select>
                        <select class="form-control select-2" id="searchUser" name="user"></select>
                    </div>
                    <x-filter.date-filter />
                </div>
                <div class="d-flex align-items-end gap-1">
                    <x-buttons.apply-button />
                    <x-buttons.reset-button :action="route('admin.dictationResult.list')" />
                </div>
            </div>
        </form>
    </div>
</div>
<div class="table-records">
    @include('admin.dictationResult.table')
</div>
@endsection
