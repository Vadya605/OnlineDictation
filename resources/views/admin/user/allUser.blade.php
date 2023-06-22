@vite(['resources/js/admin/sorting.js', 'resources/js/admin/filtration.js'])
@extends('layouts.adminApp')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex align-items-center gap-2">
            <span class="fs-1">Пользователи</span>
            <x-buttons.create-button :action="route('createUser')" />
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-12">
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
        <div class="d-flex flex-column flex-md-row align-items-start justify-content-between gap-2">
            <x-search inputPlaceholder="Имя, email или дата" />
            <div class="d-flex flex-wrap align-items-end gap-2">
                <div class="sort">
                    <label for="select-sort" class="form-label">Сортировка</label>
                    <select class="form-select" name="" id="select-sort">
                        <option data-column="id" data-option="asc" value="">По id &uarr;</option>
                        <option value="" data-column="id" data-option="desc">По id &darr;</option>
                        <option value="" data-column="name" data-option="asc">По имени &uarr;</option>
                        <option value="" data-column="name" data-option="desc">По имени &darr;</option>
                        <option value="" data-column="created_at" data-option="asc">По дате регистрации &uarr;</option>
                        <option value="" data-column="created_at" data-option="desc">По дате регистрации &darr;</option>
                        <option value="" data-column="role" data-option="asc">По ролям</option>
                    </select>
                </div>
                <div class="filters">
                    <label for="select-filter" class="form-label">Фильтрация</label>
                    <select class="form-select" name="" id="select-filter">
                        <option data-column="" data-option="" data-value="" value="">Все</option>
                        <option data-column="role" data-option="=" data-value="'admin'" value="">Администраторы</option>
                        <option value="" data-column="role" data-option="=" data-value="'user'">Пользователи</option>
                        <option value="" data-column="vk_id" data-option=">" data-value="0">Авторизованные по vk</option>
                        <option value="" data-column="vk_id" data-option="is" data-value="null">Авторизованные не по vk</option>
                    </select>
                </div>
                <x-buttons.reset-button :action="route('allUsers')" />
            </div>
        </div>
    </div>
</div>
<div class="table-responsive mt-4">
    <table class="table table-responsive-sm">
        <thead>
            <tr>
                <th>Действия</th>
                <th scope="col">Id</th>
                <th scope="col">Имя</th>
                <th scope="col">Email</th>
                <th scope="col">Роль</th>
                <th scope="col">Авторизован по VK</th>
                <th scope="col">Дата регистрации</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td class="align-middle">
                        <div class="d-flex gap-1 justify-content-center align-items-center">
                            <x-buttons.edit-button :action="route('editUser', $user)" />
                            <x-buttons.delete-button :action="route('deleteUser', $user)" />
                        </div>
                    </td>
                    <td class="align-middle">{{ $user->id }}</td>
                    <td class="align-middle">{{ $user->name }}</td>
                    <td class="align-middle">{{ $user->email }}</td>
                    <td class="align-middle">{{ $user->role }}</td>
                    <td class="align-middle">
                        @if ($user->vk_id) Да @else Нет @endif
                    </td>
                    <td class="align-middle">{{ $user->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center">
    {{ $users->links() }}
</div>
@endsection
