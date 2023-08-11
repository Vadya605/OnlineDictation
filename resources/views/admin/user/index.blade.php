@push('js')
    @vite(['resources/js/admin/sorting.js', 'resources/js/admin/filter.js', 
            'resources/js/admin/pagination.js', 'resources/js/admin/reset.js',
            'resources/js/admin/user/delete.js', 'resources/js/admin/user/updateAndCreate.js'
    ])
@endpush
@extends('layouts.adminApp')
@section('content')
<x-modal-windows.confirm-deleting /> 
<div class="modal-create">
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="title-modal fs-5" id="exampleModalLabel">Добавить пользователя</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <form id="formUser" action="" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Имя *</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <button type="submit" name="btn_submit" class="btn btn-primary mb-3">Сохранить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="d-flex flex-sm-row flex-column align-items-sm-center align-items-start justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <span class="fs-1">Пользователи</span>
                <span class="badge fs-6 bg-primary text-white total-records">{{ $users->total() }}</span>
            </div>
            <x-buttons.create-button textBtn="Добавить пользователя" />
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
                <div class="d-flex flex-md-nowrap flex-wrap gap-1">
                    <x-search inputPlaceholder="Имя или email" />
                    <div class="filters flex-grow-1">
                        <label for="select-filter" class="form-label">Фильтрация</label>
                        <select class="form-select" name="filter" id="select-filter">
                            <option value="">Все</option>
                            <option value="Administrators">Администраторы</option>
                            <option value="Users">Пользователи</option>
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
<div class="wrapper-table">
    <x-loader />
    @include('admin.user.table')
</div>
@endsection
