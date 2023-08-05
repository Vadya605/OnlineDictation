@push('js')
    @vite(['resources/js/admin/sorting.js', 'resources/js/admin/filter.js', 
            'resources/js/admin/pagination.js', 'resources/js/admin/reset.js',
            'resources/js/admin/dictation/update.js', 'resources/js/admin/dictation/create.js',
            'resources/js/admin/dictation/delete.js' 
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Добавить диктант</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <form id="formCreate" action="{{ route('admin.dictation.store') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Название диктанта *</label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                            <div class="mb-3">
                                <label for="video_link" class="form-label">Ссылка на видео *</label>
                                <input type="text" class="form-control" id="videoLink" name="video_link">
                            </div>
                            <div class="mb-3 form-check">
                                <label class="form-check-label" for="is_active">Активен</label>
                                <input type="checkbox" class="form-check-input" id="isActive" name="is_active" >
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Описание</label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="5"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="fromDateTime">Дата и время начала *</label>
                                <input type="text" class="form-control" name="from_date_time" id="fromDateTime">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="toDateTime">Дата и время окончания *</label>
                                <input type="text" class="form-control" name="to_date_time" id="toDateTime">
                            </div>
                            <button type="submit" class="btn btn-primary mb-3" name="btnAdd">Добавить</button>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Изменить диктант</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <form id="formUpdate" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="title" class="form-label">Название диктанта *</label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                            <div class="mb-3">
                                <label for="video_link" class="form-label">Ссылка на видео *</label>
                                <input type="text" class="form-control" id="videoLink" name="video_link">
                            </div>
                            <div class="mb-3 form-check">
                                <label class="form-check-label" for="is_active">Активен</label>
                                <input type="checkbox" class="form-check-input" id="isActive" name="is_active" >
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Описание</label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="5"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="fromDateTime">Дата и время начала *</label>
                                <input type="text" class="form-control" name="from_date_time" id="fromDateTime">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="toDateTime">Дата и время окончания *</label>
                                <input type="text" class="form-control" name="to_date_time" id="toDateTime">
                            </div>
                            <button type="submit" class="btn btn-primary mb-3" name="btnUpdate">Сохранить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="d-flex align-items-center gap-2">
            <span class="fs-1">Диктанты</span>
            <x-buttons.create-button formId="modalCreate" />
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
        <form id="formFilters" action="{{ route('admin.dictation.list') }}" method="get">
            <div class="d-flex justify-content-between flex-column flex-md-row gap-2">
                <div class="d-flex flex-md-nowrap flex-wrap gap-1">
                    <x-search inputPlaceholder="Название" />
                    <div class="filters flex-grow-1">
                        <label for="select-filter" class="form-label">Фильтрация</label>
                        <select class="form-select" name="filter" id="select-filter">
                            <option value="">Все</option>
                            <option value="Активные">Активные</option>
                            <option value="Не активные">Не активные</option>
                            <option value="С видео">С видео</option>
                            <option value="Без видео">Без видео</option>
                            <option value="С датой начала">С датой начала</option>
                            <option value="Без даты начала">Без даты начала</option>
                            <option value="С датой окончания">С датой окончания</option>
                            <option value="Без даты окончания">Без даты окончания</option>
                            <option value="С описанием">С описанием</option>
                            <option value="Без описания">Без описания</option>
                        </select>
                    </div>
                    <x-filter.date-filter />
                </div>
                <div class="d-flex align-items-end gap-1">
                    <x-buttons.apply-button />
                    <x-buttons.reset-button :action="route('admin.dictation.list')" />
                </div>
            </div>
        </form>
    </div>
</div>
<div class="table-records">
    @include('admin.dictation.table')
</div>
@endsection

