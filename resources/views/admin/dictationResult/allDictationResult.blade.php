@vite(['resources/js/admin/sorting.js', 'resources/js/admin/dictationAndUserFiltration.js'])
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
@extends('layouts.adminApp')
@section('content')
<x-modal-windows.confirm-deleting /> 
<div class="row">
    <div class="col-12">
        <div class="d-flex align-items-center gap-2">
            <span class="fs-1">Результаты диктантов</span>
            <x-buttons.create-button :action="route('admin.dictationResult.create')" />
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
        <div class="d-flex flex-column flex-md-row align-items-md-end align-imems-sm-start justify-content-between gap-5">
            <div class="selects">
                <select class="form-control" id="dictationSearch" style="width:200px;" name="dictation"></select>
                <select class="form-control" id="userSearch" style="width:200px;" name="user"></select>
            </div>
            <div class="d-flex flex-wrap align-items-end gap-2">
                <x-filter.date-filter />
                <x-buttons.reset-button :action="route('admin.dictationResult.list')" />
            </div>
        </div>
    </div>
</div>
<div class="table-responsive mt-3">
    <table class="table table-responsive-sm">
        <thead>
            <tr>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Id</span>
                        <div class="d-flex gap-1">
                            <span class="sort-item" data-column="dictation_results.id" data-option="asc">&darr;</span>
                            <span class="sort-item" data-column="dictation_results.id" data-option="desc">&uarr;</span>
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Пользователь</span>
                        <div class="d-flex gap-1">
                            <span class="sort-item" data-column="users.name" data-option="asc" >&darr;</span>
                            <span class="sort-item" data-column="users.name" data-option="desc" >&uarr;</span>
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Диктант</span>
                        <div class="d-flex gap-1">
                            <span class="sort-item" data-column="dictations.title" data-option="asc" >&darr;</span>
                            <span class="sort-item" data-column="dictations.title" data-option="desc" >&uarr;</span>
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Email пользователя</span>
                        <div class="d-flex gap-1">
                            <span class="sort-item" data-column="users.email" data-option="asc" >&darr;</span>
                            <span class="sort-item" data-column="users.email" data-option="desc" >&uarr;</span>
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Текст диктанта</span>
                        <div class="d-flex gap-1">
                            <span class="sort-item" data-column="dictation_results.text_result" data-option="asc">&darr;</span>
                            <span class="sort-item" data-column="dictation_results.text_result" data-option="desc">&uarr;</span>
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Дата и время написания</span>
                        <div class="d-flex gap-1">
                            <span class="sort-item" data-column="dictation_results.date_time_result" data-option="asc" >&darr;</span>
                            <span class="sort-item" data-column="dictation_results.date_time_result" data-option="desc" >&uarr;</span>
                        </div>
                    </div>
                </th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dictationResults as $dictationResult)
                <tr>
                    <td class="align-middle">{{ $dictationResult->id }}</td>
                    <td class="align-middle"><a href="{{ route('admin.user.edit', $dictationResult->user) }}">{{ $dictationResult->user->name }}</a></td>
                    <td class="align-middle"><a href="{{ route('admin.dictation.edit', $dictationResult->dictation) }}">{{ $dictationResult->dictation->title }}</a></td>
                    <td class="align-middle">{{ $dictationResult->user->email }}</td>
                    <td class="align-middle">{{ Str::limit($dictationResult->text_result, 30) }}</td>
                    <td class="align-middle">{{ $dictationResult->date_time_result }}</td>
                    <td class="align-middle">
                        <div class="d-flex justify-content-between w-100">
                            <x-buttons.edit-button :action="route('admin.dictationResult.edit', $dictationResult)" />
                            <x-buttons.delete-button :action="route('admin.dictationResult.delete', $dictationResult)" />
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center">
    {{ $dictationResults->links() }}
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
