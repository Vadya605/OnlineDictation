@vite(['resources/js/admin/sorting.js'])

@extends('layouts.adminApp')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex align-items-center gap-2">
            <span  class="fs-1">Результаты диктантов</span>
            <x-buttons.create-button :action="route('createDictationResult')" />
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
            <x-search inputPlaceholder="Название, имя или дата" />
            <div class="d-flex flex-wrap align-items-end gap-2">
                <div class="sort">
                    <label for="select-sort" class="form-label">Сортировка</label>
                    <select class="form-select" name="" id="select-sort">
                        <option data-column="dictation_results.id" data-option="asc" value="">По id &uarr;</option>
                        <option value="" data-column="dictation_results.id" data-option="desc">По id &darr;</option>
                        <option value="" data-column="users.name" data-option="asc"> По имени &uarr;</option>
                        <option value="" data-column="users.name" data-option="desc">По имени &darr;</option>
                        <option value="" data-column="dictations.title" data-option="asc">По названию &uarr;</option>
                        <option value="" data-column="dictations.title" data-option="desc">По названию &darr;</option>
                        <option value="" data-column="dictation_results.date_time_result" data-option="asc">По дате написания &uarr;</option>
                        <option value="" data-column="dictation_results.date_time_result" data-option="desc">По дате написания &darr;</option>
                    </select>
                </div>
                <x-buttons.reset-button :action="route('allDictationResults')" />

            </div>
        </div>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-responsive-sm">
        <thead>
            <tr>
                <th>Действия</th>
                <th scope="col">Id</th>
                <th scope="col">Название диктанта</th>
                <th scope="col">Имя пользователя</th>
                <th scope="col">Email пользователя</th>
                <th scope="col">Текст диктанта</th>
                <th scope="col">Дата и время написания</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dictationResults as $dictationResult)
                <tr>
                    <td class="align-middle">
                        <div class="d-flex justify-content-between w-100">
                            <x-buttons.edit-button :action="route('editDictationResult', $dictationResult)" />
                            <x-buttons.delete-button :action="route('deleteDictationResult', $dictationResult)" />
                        </div>
                    </td>
                    <td class="align-middle">{{ $dictationResult->id }}</td>
                    <td class="align-middle"><a href="{{ route('editDictation', $dictationResult->dictation) }}">{{ $dictationResult->dictation->title }}</a></td>
                    <td class="align-middle"><a href="{{ route('editUser', $dictationResult->user) }}">{{ $dictationResult->user->name }}</a></td>
                    <td class="align-middle">{{ $dictationResult->user->email }}</td>
                    <td class="align-middle">{{ Str::limit($dictationResult->text_result, 30) }}</td>
                    <td class="align-middle">{{ $dictationResult->date_time_result }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center">
    {{ $dictationResults->links() }}
</div>
@endsection
