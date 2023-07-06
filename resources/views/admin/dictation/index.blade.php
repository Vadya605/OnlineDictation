@push('js')
    @vite(['resources/js/admin/sorting.js',  'resources/js/admin/setFilter.js',
            'resources/js/admin/initDateFiltration.js', 'resources/js/admin/dictation/initDateCreate.js' ])
@endpush
@extends('layouts.adminApp')
@section('content')
<x-modal-windows.confirm-deleting /> 
<div class="create-modal">
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Добавить диктант</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <form action="{{ route('admin.dictation.store') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Название диктанта *</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                    id="title" name="title" value="{{ old('title') }}"
                                >
                                <x-errors.validation-error field="title" /> 
                            </div>
                            <div class="mb-3">
                                <label for="video_link" class="form-label">Ссылка на видео</label>
                                <input type="text" class="form-control @error('video_link') is-invalid @enderror" 
                                    id="videoLink" name="video_link" value="{{ old('video_link') }}"
                                >
                                <x-errors.validation-error field="video_link" /> 
                            </div>
                            <div class="mb-3 form-check">
                                <label class="form-check-label" for="is_active">Активен</label>
                                <input type="hidden" id="isActive" name="is_active" value="0">
                                <input type="checkbox" class="form-check-input @error('is_active') is-invalid @enderror" 
                                    id="isActive" name="is_active" 
                                    @if (old('is_active') == 1)
                                        checked 
                                    @endif 
                                    value="1"
                                >
                                <x-errors.validation-error field="is_active" /> 
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Описание</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                    name="description" id="description" cols="30" rows="5">{{ old('description') }}</textarea>
                                <x-errors.validation-error field="description" /> 
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="fromDateTime">Дата и время начала</label>
                                <input type="text" class="form-control @error('from_date_time') is-invalid @enderror"
                                    name="from_date_time" id="fromDateTime" value="{{ old('from_date_time') }}"
                                >
                                <x-errors.validation-error field="from_date_time" /> 
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="toDateTime">Дата и время окончания</label>
                                <input type="text" class="form-control @error('to_date_time') is-invalid @enderror"
                                    name="to_date_time" id="toDateTime" value="{{ old('to_date_time') }}"
                                >
                                <x-errors.validation-error field="to_date_time" /> 
                            </div>
                            <button type="submit" class="btn btn-primary mb-3">Добавить</button>
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
            <x-buttons.create-button formId="createModal" />
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-6 col-sm-12">
        @if($errors->has('title') || $errors->has('video_link') || 
            $errors->has('description') || $errors->has('is_active') || 
            $errors->has('from_date_time') || $errors->has('to_date_time'))
            <script type="module">
                const createModal = new bootstrap.Modal(document.querySelector('#createModal'));
                createModal.show();
            </script>
        @else
            @foreach ($errors->all() as $error)
                <x-errors.alert-error :error="$error"/> 
            @endforeach
        @endif
        @if (session('message'))
            <x-messages.message-success :message="session('message')" />
        @endif
    </div>
</div>
<div class="row mt-3">
    <div class="col-12">
        <form action="{{ route('admin.dictation.list') }}" method="get">
            <div class="d-flex justify-content-between flex-column flex-md-row gap-2">
                <input type="hidden" name="filter_column" id="filterColumn" value="{{ request()->query('filter_column') }}">
                <input type="hidden" name="filter_option" id="filterOption" value="{{ request()->query('filter_option') }}">
                <input type="hidden" name="filter_value" id="filterValue" value="{{ request()->query('filter_value') }}">
                <div class="d-flex flex-md-nowrap flex-wrap gap-1">
                    <x-search inputPlaceholder="Название" />
                    <div class="filters flex-grow-1">
                        <label for="select-filter" class="form-label">Фильтрация</label>
                        <select class="form-select" name="" id="select-filter">
                            <option data-column="" data-option="" data-value="" value="">Все</option>
                            <option data-column="is_active" data-option="=" data-value="true" value="">Активные</option>
                            <option data-column="is_active" data-option="=" data-value="false" value="">Не активные</option>
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
                </div>
                <div class="d-flex align-items-end gap-1">
                    <x-buttons.apply-button />
                    <x-buttons.reset-button :action="route('admin.dictation.list')" />
                </div>
            </div>
        </form>
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
                            <x-arrows.arrow-up dataColumn="id" />
                            <x-arrows.arrow-down dataColumn="id" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Название</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up dataColumn="title" />
                            <x-arrows.arrow-down dataColumn="title" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Видео</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up dataColumn="video_link" />
                            <x-arrows.arrow-down dataColumn="video_link" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Активен</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up dataColumn="is_active" />
                            <x-arrows.arrow-down dataColumn="is_active" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Описание</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up dataColumn="description" />
                            <x-arrows.arrow-down dataColumn="description" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Начало</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up dataColumn="from_date_time" />
                            <x-arrows.arrow-down dataColumn="from_date_time" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Окончание</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up dataColumn="to_date_time" />
                            <x-arrows.arrow-down dataColumn="to_date_time" />
                        </div>
                    </div>
                </th>
                <th scope="col" class="text-center">
                    <div class="d-flex align-items-center gap-1">
                        <span>Дата создания</span>
                        <div class="d-flex">
                            <x-arrows.arrow-up dataColumn="created_at" />
                            <x-arrows.arrow-down dataColumn="created_at" />
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
                        <div class="d-flex align-items-center gap-1 w-100">
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

