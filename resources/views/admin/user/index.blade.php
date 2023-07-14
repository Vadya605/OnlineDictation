@push('js')
    @vite(['resources/js/admin/sorting.js', 'resources/js/admin/filter.js', 
            'resources/js/admin/pagination.js', 'resources/js/admin/reset.js',
            'resources/js/admin/user/create.js', 'resources/js/admin/user/update.js',
            'resources/js/admin/user/delete.js'
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Добавить пользователя</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <form id="formCreate" action="{{ route('admin.user.store') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Имя *</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" name="email">
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Изменить пользователя</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="d-flex align-items-center gap-2">
            <span class="fs-1">Пользователи</span>
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
        <form id="formFilters" action="{{ route('admin.user.list') }}" method="get">
            <div class="d-flex justify-content-between flex-column flex-md-row gap-2">
                <input type="hidden" name="filter_column" id="filterColumn" value="{{ request()->query('filter_column') }}">
                <input type="hidden" name="filter_option" id="filterOption" value="{{ request()->query('filter_option') }}">
                <input type="hidden" name="filter_value" id="filterValue" value="{{ request()->query('filter_value') }}">
                <div class="d-flex flex-md-nowrap flex-wrap gap-1">
                    <x-search inputPlaceholder="Имя или email" />
                    <div class="filters flex-grow-1">
                        <label for="select-filter" class="form-label">Фильтрация</label>
                        <select class="form-select" name="filter" id="select-filter">
                            <option value="">Все</option>
                            <option value="Администраторы">Администраторы</option>
                            <option value="Пользователи">Пользователи</option>
                        </select>
                    </div>
                    <x-filter.date-filter />
                </div>
                <div class="d-flex align-items-end gap-1">
                    <x-buttons.apply-button />
                    <x-buttons.reset-button :action="route('admin.user.list')" />
                </div>
            </div>
        </form>
    </div>
</div>
<div class="table-records">
    @include('admin.user.table')
</div>
@endsection
