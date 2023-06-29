@vite(['resources/js/admin/sorting.js', 'resources/js/admin/filtration.js', 'resources/js/admin/dateFiltration.js'])
@extends('layouts.adminApp')
@section('content')
<x-modal-windows.confirm-deleting /> 

<div class="row">
    <div class="col-12">
        <div class="d-flex align-items-center gap-2">
            <span class="fs-1">Пользователи</span>
            <x-buttons.create-button :action="route('admin.user.create')" />
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-6 col-sm-12">
        @if(session('error'))
            <x-errors.alert-error :error="session('error')"/> 
        @elseif ($errors->any())
            @foreach ($errors->all() as $error)
                <x-errors.alert-error :error="$error"/> 
            @endforeach
        @elseif (session('message'))
            <x-messages.message-success :message="session('message')" />
        @endif
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <div class="d-flex flex-column flex-md-row align-items-md-end align-imems-sm-start justify-content-between gap-2">
            <x-search inputPlaceholder="Имя или email" />
            <div class="d-flex flex-wrap align-items-end gap-2">
                <div class="filters">
                    <label for="select-filter" class="form-label">Фильтрация</label>
                    <select class="form-select" name="" id="select-filter">
                        <option data-column="" data-option="" data-value="" value="">Все</option>
                        <option data-column="role" data-option="=" data-value="'admin'" value="">Администраторы</option>
                        <option value="" data-column="role" data-option="=" data-value="'user'">Пользователи</option>
                    </select>
                </div>
                <x-filter.date-filter />
                <x-buttons.reset-button :action="route('admin.user.list')" />
            </div>
        </div>
    </div>
</div>
<div class="table-responsive mt-4">
    <table class="table table-responsive-sm">
        <thead>
            <tr>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Id</span>
                        <div class="d-flex gap-1">
                            <span class="sort-item" data-column="id" data-option="asc">&darr;</span>
                            <span class="sort-item" data-column="id" data-option="desc">&uarr;</span>
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Имя</span>
                        <div class="d-flex gap-1">
                            <span class="sort-item" data-column="name" data-option="asc" >&darr;</span>
                            <span class="sort-item" data-column="name" data-option="desc" >&uarr;</span>
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Email</span>
                        <div class="d-flex gap-1">
                            <span class="sort-item" data-column="email" data-option="asc" >&darr;</span>
                            <span class="sort-item" data-column="email" data-option="desc" >&uarr;</span>
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Роль</span>
                        <div class="d-flex gap-1">
                            <span class="sort-item" data-column="role" data-option="asc" >&darr;</span>
                            <span class="sort-item" data-column="role" data-option="desc" >&uarr;</span>
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Дата регистрации</span>
                        <div class="d-flex gap-1">
                            <span class="sort-item" data-column="created_at" data-option="asc">&darr;</span>
                            <span class="sort-item" data-column="created_at" data-option="desc">&uarr;</span>
                        </div>
                    </div>
                </th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td class="align-middle">{{ $user->id }}</td>
                    <td class="align-middle">{{ $user->name }}</td>
                    <td class="align-middle">{{ $user->email }}</td>
                    <td class="align-middle">{{ $user->role }}</td>
                    <td class="align-middle">{{ $user->created_at }}</td>
                    <td class="align-middle">
                        <div class="d-flex gap-1 justify-content-center align-items-center">
                            <x-buttons.edit-button :action="route('admin.user.edit', $user)" />
                            <x-buttons.delete-button :action="route('admin.user.delete', $user)" />
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center">
    {{ $users->links() }}
</div>
@endsection
