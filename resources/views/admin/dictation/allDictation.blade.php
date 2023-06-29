@vite(['resources/js/admin/sorting.js', 'resources/js/admin/filtration.js', 'resources/js/admin/dateFiltration.js', 'resources/js/admin/search.js'])
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
@extends('layouts.adminApp')
@section('content')
<x-modal-windows.confirm-deleting /> 

<div class="row">
    <div class="col-12">
        <div class="d-flex align-items-center gap-2">
            <span class="fs-1">Диктанты</span>
            <x-buttons.create-button :action="route('admin.dictation.create')" />
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
            <x-search class="flex-grow-1" inputPlaceholder="Название" />
            <div class="d-flex flex-wrap align-items-end gap-2">
                <div class="filters">
                    <label for="select-filter" class="form-label">Фильтрация</label>
                    <select class="form-select" name="" id="select-filter">
                        <option data-column="" data-option="" data-value="" value=""><a href="{{ route('admin.dictation.list') }}">Все</a></option>
                        <option data-column="is_active" data-option="=" data-value="1" value="">Активные</option>
                        <option data-column="is_active" data-option="=" data-value="0" value="">Не активные</option>
                        <option data-column="video_link" data-option="is not" data-value="null" value="">С видео</option>
                        <option data-column="video_link" data-option="is" data-value="null" value="">Без видео</option>
                        <option data-column="from_date_time" data-option="is not" data-value="null" value="">С датой начала</option>
                        <option data-column="from_date_time" data-option="is" data-value="null" value="">Без даты начала</option>
                        <option data-column="to_date_time" data-option="is not" data-value="null" value="">С датой окончания</option>
                        <option data-column="to_date_time" data-option="is" data-value="null" value="">Без даты окончания</option>
                        <option data-column="description" data-option="is not" data-value="null" value="">С описанием</option>
                        <option data-column="description" data-option="is" data-value="null" value="">Без описания</option>
                    </select>
                </div>
                <x-filter.date-filter />
                <x-buttons.reset-button :action="route('admin.dictation.list')" />
            </div>
        </div>
    </div>
</div>

<div class="table-responsive-sm mt-3">
    <table class="table">
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
                        <span>Название</span>
                        <div class="d-flex gap-1">
                            <span class="sort-item" data-column="title" data-option="asc" >&darr;</span>
                            <span class="sort-item" data-column="title" data-option="desc" >&uarr;</span>
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Ссылка на видео</span>
                        <div class="d-flex gap-1">
                            <span class="sort-item" data-column="video_link" data-option="asc" >&darr;</span>
                            <span class="sort-item" data-column="video_link" data-option="desc" >&uarr;</span>
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Активен</span>
                        <div class="d-flex gap-1">
                            <span class="sort-item" data-column="is_active" data-option="asc" >&darr;</span>
                            <span class="sort-item" data-column="is_active" data-option="desc" >&uarr;</span>
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Описание</span>
                        <div class="d-flex gap-1">
                            <span class="sort-item" data-column="description" data-option="asc">&darr;</span>
                            <span class="sort-item" data-column="description" data-option="desc">&uarr;</span>
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Начало</span>
                        <div class="d-flex gap-1">
                            <span class="sort-item" data-column="from_date_time" data-option="asc" >&darr;</span>
                            <span class="sort-item" data-column="from_date_time" data-option="desc" >&uarr;</span>
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Окончание</span>
                        <div class="d-flex gap-1">
                            <span class="sort-item" data-column="to_date_time" data-option="asc" >&darr;</span>
                            <span class="sort-item" data-column="to_date_time" data-option="desc" >&uarr;</span>
                        </div>
                    </div>
                </th>
                <th scope="col" class="text-center">
                    <div class="d-flex align-items-center gap-1">
                        <span>Дата создания</span>
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
            @foreach ($dictations as $dictation)
                <tr>
                    <td class="align-middle text-center">{{ $dictation->id }}</td>
                    <td class="align-middle">{{ $dictation->title }}</td>
                    <td class="align-middle"><a target="blank" href="{{ $dictation->video_link }}">{{  Str::limit($dictation->video_link, 20) }}</a></td>
                    <td class="align-middle text-center">
                        @if ($dictation->is_active)
                            <span class="badge bg-success text-white">Да</span>
                        @else
                            <span class="badge bg-danger text-white">Нет</span>
                        @endif
                    </td>
                    <td class="align-middle">{{ Str::limit($dictation->description, 30) }}</td>
                    <td class="align-middle">{{ $dictation->from_date_time }}</td>
                    <td class="align-middle">{{ $dictation->to_date_time }}</td>
                    <td class="align-middle">{{ $dictation->created_at }}</td>
                    <td class="align-middle">
                        <div class="d-flex gap-4 w-100">
                            <x-buttons.edit-button :action="route('admin.dictation.edit', $dictation)" />
                            <x-buttons.delete-button :action="route('admin.dictation.delete', $dictation)" />
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center">
    {{ $dictations->links() }}
</div>
@endsection

