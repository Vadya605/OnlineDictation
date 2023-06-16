@extends('layouts.adminApp')
@section('content')
@vite(['resources/js/admin/confirmDeleting.js'])
<div class="col-md-6">
    <div class="row">
        <div class="col-12">
            <span class="header-content">Пользователь {{ $user->name }}</span>
        </div>
    </div> 
    
    <div class="row mt-3">
        <div class="col-12">
            <x-errors.session-error />
            <x-messages.message-success />
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="field d-flex flex-column">
                <span class="name-field">Имя</span>
                <span class="value-field">{{ $user->name }}</span>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="field d-flex flex-column">
                <span class="name-field">Email</span>
                <span class="value-field">{{ $user->email }}</span>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="field d-flex flex-column">
                <span class="name-field">Дата регистрации в системе</span>
                <span class="value-field">{{ $user->created_at }}</span>
            </div>
        </div>
    </div>
    <div class="row mt-3 mb-3">
        <div class="col-3">
            <x-delete-button :action="route('deleteUser', $user)" />
        </div>
    </div>
</div>
@endsection