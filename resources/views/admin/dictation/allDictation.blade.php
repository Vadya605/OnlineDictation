@vite(['resources/js/admin/sorting.js', 'resources/js/admin/filtration.js'])
@extends('layouts.adminApp')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex align-items-center gap-2">
            <span class="fs-1">Диктанты</span>
            <x-buttons.create-button :action="route('createDictation')" />
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
            <x-search class="flex-grow-1" :inputPlaceholder="'Название или дата'" />
            <div class="d-flex flex-wrap align-items-end gap-2">
                <div class="sort">
                    <label for="select-sort" class="form-label">Сортировка</label>
                    <select class="form-select" name="" id="select-sort">
                        <option value="" data-column="id" data-option="asc">По id &uarr;</option>
                        <option value="" data-column="id" data-option="desc">По id &darr;</option>
                        <option value="" data-column="title" data-option="asc">По названию &uarr;</option>
                        <option value="" data-column="title" data-option="desc">По названию &darr;</option>
                        <option value="" data-column="is_active" data-option="asc">По активности &uarr;</option>
                        <option value="" data-column="is_active" data-option="desc">По активности &darr;</option>
                        <option value="" data-column="from_date_time" data-option="asc">По дате начала написания &uarr;</option>
                        <option value="" data-column="from_date_time" data-option="desc">По дате начала написания &darr;</option>
                        <option value="" data-column="to_date_time" data-option="asc">По дате окончания написания &uarr;</option>
                        <option value="" data-column="to_date_time" data-option="desc">По дате окончания написания &darr;</option>
                        <option value="" data-column="created_at" data-option="asc">По дате создания &uarr;</option>
                        <option value="" data-column="created_at" data-option="asc">По дате создания &darr;</option>
                    </select>
                </div>
                <div class="filters">
                    <label for="select-filter" class="form-label">Фильтрация</label>
                    <select class="form-select" name="" id="select-filter">
                        <option data-column="" data-option="" data-value="" value="">Все</option>
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
                <x-buttons.reset-button :action="route('allDictations')" />
            </div>
        </div>
    </div>
</div>

<div class="table-responsive mt-3">
    <table class="table table-responsive-sm">
        <thead>
            <tr>
                <th>Действия</th>
                <th scope="col">Id</th>
                <th scope="col">Название</th>
                <th scope="col">Ссылка на видео</th>
                <th scope="col">Активен</th>
                <th scope="col">Описание</th>
                <th scope="col">Дата и время начала</th>
                <th scope="col">Дата и время окончания</th>
                <th scope="col">Дата создания</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dictations as $dictation)
                <tr>
                    <td class="align-middle">
                        <div class="d-flex gap-4 w-100">
                            <x-buttons.edit-button :action="route('editDictation', $dictation)" />
                            <x-buttons.delete-button :action="route('deleteDictation', $dictation)" />
                        </div>
                    </td>
                    <td class="align-middle">{{ $dictation->id }}</td>
                    <td class="align-middle">{{ $dictation->title }}</td>
                    <td class="align-middle"><a target="blank" href="{{ $dictation->video_link }}">{{  Str::limit($dictation->video_link, 20) }}</a></td>
                    <td class="align-middle">{{ $dictation->is_active }}</td>
                    <td class="align-middle">{{ Str::limit($dictation->description, 30) }}</td>
                    <td class="align-middle">{{ $dictation->from_date_time }}</td>
                    <td class="align-middle">{{ $dictation->to_date_time }}</td>
                    <td class="align-middle">{{ $dictation->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center">
    {{ $dictations->links() }}
</div>
@endsection

