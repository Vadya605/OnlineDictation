@push('js')
    @vite(['resources/js/admin/sorting.js', 'resources/js/admin/filter.js', 
            'resources/js/admin/pagination.js', 'resources/js/admin/reset.js',
            // 'resources/js/admin/dictation/update.js', 'resources/js/admin/dictation/create.js',
            'resources/js/admin/dictation/delete.js', 'resources/js/admin/dictation/updateAndCreate.js'
            ])
@endpush
@extends('layouts.adminApp')
@section('content')
<x-modal-windows.confirm-deleting /> 
<x-loader />
<div>
    <div class="modal fade" id="modal" tabindex="-1"  aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="title-modal fs-5 mb-0">Добавить диктант</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <form id="formModal" action="{{ route('admin.dictation.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="slug">
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
                                <label for="answer" class="form-label">Ответ</label>
                                <textarea class="form-control" name="answer" id="answer" cols="30" rows="5"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="fromDateTime">Дата и время начала *</label>
                                <input type="text" class="form-control" name="from_date_time" id="fromDateTime">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="toDateTime">Дата и время окончания *</label>
                                <input type="text" class="form-control" name="to_date_time" id="toDateTime">
                            </div>
                            <button type="submit" class="btn btn-primary mb-3" name="btn_submit">Сохранить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <span class="fs-1">Диктанты</span>
                <span class="badge fs-6 bg-primary text-white total-records">{{ $dictations->total() }}</span>
            </div>
            <x-buttons.create-button textBtn="Добавить диктант" />
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
                            <option value="Active">Активные</option>
                            <option value="Not active">Не активные</option>
                            <option value="With description">С описанием</option>
                            <option value="Without description">Без описания</option>
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

