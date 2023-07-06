@push('js')
    @vite(['resources/js/admin/sorting.js', 'resources/js/admin/initDateFiltration.js', 'resources/js/admin/setFilter.js'])
@endpush
@extends('layouts.adminApp')
@section('content')
<x-modal-windows.confirm-deleting /> 
<div class="create-modal">
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Добавить пользователя</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12">
                        <form action="{{ route('admin.user.store') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Имя *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                    id="name" name="name" value="{{ old('name') }}"
                                >
                                <x-errors.validation-error field="name" /> 
                    
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                    id="email" name="email" value="{{ old('email') }}"
                                >
                                <x-errors.validation-error field="email" /> 
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
            <span class="fs-1">Пользователи</span>
            <x-buttons.create-button formId="createModal" />
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-6 col-sm-12">
        @if($errors->has('name') || $errors->has('email'))
            <script type="module">
                const createModal = new bootstrap.Modal(document.querySelector('#createModal'));
                createModal.show();
            </script>
        @else
            @foreach ($errors->all() as $error)
                <x-errors.alert-error :error="$error"/> 
            @endforeach
        @endif
        @if(session('message'))
            <x-messages.message-success :message="session('message')" />
        @endif
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <form action="{{ route('admin.user.list') }}" method="get">
            <div class="d-flex justify-content-between flex-column flex-md-row gap-2">
                <input type="hidden" name="filter_column" id="filterColumn" value="{{ request()->query('filter_column') }}">
                <input type="hidden" name="filter_option" id="filterOption" value="{{ request()->query('filter_option') }}">
                <input type="hidden" name="filter_value" id="filterValue" value="{{ request()->query('filter_value') }}">
                <div class="d-flex flex-md-nowrap flex-wrap gap-1">
                    <x-search inputPlaceholder="Имя или email" />
                    <div class="filters flex-grow-1">
                        <label for="select-filter" class="form-label">Фильтрация</label>
                        <select class="form-select" name="" id="select-filter">
                            <option data-column="" data-option="" data-value="" value="">Все</option>
                            <option data-column="role" data-option="=" data-value="'admin'" value="">Администраторы</option>
                            <option value="" data-column="role" data-option="=" data-value="'user'">Пользователи</option>
                        </select>
                    </div>
                    <x-filter.date-filter />
                </div>
                <div class="d-flex flex-wrap align-items-end gap-1">
                    <x-buttons.apply-button />
                    <x-buttons.reset-button :action="route('admin.user.list')" />
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
                        <span>Имя</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up dataColumn="name" />
                            <x-arrows.arrow-down dataColumn="name" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Email</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up dataColumn="email" />
                            <x-arrows.arrow-down dataColumn="email" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Роль</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up dataColumn="role" />
                            <x-arrows.arrow-down dataColumn="role" />
                        </div>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex align-items-center gap-1">
                        <span>Дата регистрации</span>
                        <div class="d-flex gap-1">
                            <x-arrows.arrow-up dataColumn="created_at" />
                            <x-arrows.arrow-down dataColumn="created_at" />
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
