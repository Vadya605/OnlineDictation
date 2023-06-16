@extends('layouts.adminApp')
@section('content')
@vite(['resources/js/admin/confirmDeleting.js'])
<div class="col-md-6">
    <div class="row justify-content-between">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <span class="header-content">Пользователи</span>
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Сортировка
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('allUsers', [
                                'column_sort' => 'id', 'option_sort' => 'asc']) }}" >
                                По id &uarr;
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('allUsers', [
                                'column_sort' => 'id', 'option_sort' => 'desc']) }}" >
                                По id &darr;
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <x-errors.session-error />
            <x-messages.message-success />
        </div>
    </div>
    <div class="dictations">
        @forelse ($users as $user)
            <div class="row mt-3">
                <div class="col-12">
                    <div class="user d-flex justify-content-between align-items-center">
                        <a href="{{ route('showUser', $user) }}" class="link">{{ $user->name }}</a>
                        <x-delete-button :action="route('deleteUser', $user)" />
                    </div>
                </div>
            </div>
        @empty
            <h1>Нет пользователей</h1>
        @endforelse
        <div class="d-flex justify-content-center">
            <a href="{{ $users->previousPageUrl() }}"><</a>
            <a href="{{ $users->nextPageUrl() }}">></a>
        </div>
    </div>
</div>
@endsection
