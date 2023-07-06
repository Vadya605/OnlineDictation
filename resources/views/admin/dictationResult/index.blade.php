@push('js')
    @vite(['resources/js/admin/sorting.js', 'resources/js/admin/dictationResult/initAutoCompleteSearch.js',
    'resources/js/admin/initDateFiltration.js', 'resources/js/admin/dictationResult/initDateCreate.js'])
@endpush
@extends('layouts.adminApp')
@section('content')
<x-modal-windows.confirm-deleting /> 
<div class="create-modal">
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Добавить результат диктанта</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <form action="{{ route('admin.dictationResult.store') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="dictation_id" class="form-label">Id диктанта *</label>
                                <select class="form-select @error('dictation_id') is-invalid @enderror" name="dictation_id">
                                    @foreach ($dictations as $dictation)
                                        <option @if($dictation->id == old('dictation_id')) selected @endif value="{{ $dictation->id }}"> 
                                            {{ $dictation->id }} - {{ $dictation->title }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-errors.validation-error field="dictation_id" /> 
                            </div>
                            <div class="mb-3">
                                <label for="user_id" class="form-label">Id пользователя *</label>
                                <select class="form-select @error('user_id') is-invalid @enderror" name="user_id">
                                    @foreach ($users as $user)
                                        <option @if($user->id == old('user_id')) selected @endif value="{{ $user->id }}"> 
                                            {{ $user->id }} - {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-errors.validation-error field="user_id" /> 
                            </div>
                            <div class="mb-3">
                                <label for="text_result" class="form-label">Текст диктанта *</label>
                                <textarea class="form-control @error('text_result') is-invalid @enderror" name="text_result" 
                                    id="textResult" cols="30" rows="5">{{ old('text_result') }}</textarea>
                                <x-errors.validation-error field="text_result" /> 
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="date_time_result">Дата и время написания * <span class="value-selection"></span></label>
                                <input class="form-control @error('date_time_result') is-invalid @enderror" 
                                    value="{{ old('date_time_result') }}" type="text" 
                                    id="dateTimeResult" name="date_time_result"
                                >
                                <x-errors.validation-error field="date_time_result" /> 
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
            <span class="fs-1">Результаты диктантов</span>
            <x-buttons.create-button formId="createModal" />
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-6 col-sm-12">
        @if($errors->has('user_id') || $errors->has('dictation_id') || 
            $errors->has('text_result') || $errors->has('date_time_result'))
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
        <form action="{{ route('admin.dictationResult.list') }}" method="get">
            <div class="d-flex justify-content-between flex-column flex-md-row gap-2">
                <div class="d-flex align-items-end flex-md-nowrap flex-wrap gap-1">
                    <div class="d-flex flex-column flex-sm-row gap-1">
                        <select class="form-control select-2" id="dictationSearch" name="dictation"></select>
                        <select class="form-control select-2" id="userSearch" name="user"></select>
                    </div>
                    <x-filter.date-filter />
                </div>
                <div class="d-flex align-items-end gap-1">
                    <x-buttons.apply-button />
                    <x-buttons.reset-button :action="route('admin.dictationResult.list')" />
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
                            <x-arrows.arrow-up dataColumn="dictation_results.id" />
                            <x-arrows.arrow-down dataColumn="dictation_results.id" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Пользователь</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up dataColumn="users.name" />
                            <x-arrows.arrow-down dataColumn="users.name" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Диктант</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up dataColumn="dictations.title" />
                            <x-arrows.arrow-down dataColumn="dictations.title" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Email пользователя</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up dataColumn="users.email" />
                            <x-arrows.arrow-down dataColumn="users.email" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Текст диктанта</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up dataColumn="dictation_results.text_result" />
                            <x-arrows.arrow-down dataColumn="dictation_results.text_result" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Дата и время написания</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up dataColumn="dictation_results.date_time_result" />
                            <x-arrows.arrow-down dataColumn="dictation_results.date_time_result" />
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
                        <div class="d-flex align-items-center gap-1 w-100">
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
@endsection
