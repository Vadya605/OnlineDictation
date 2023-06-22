@extends('layouts.adminApp')
@section('content')
@vite(['resources/js/admin/confirmDeleting.js'])
<div class="col-8 col-sm-6 offset-sm-3 offset-2">
    <div class="row">
        <div class="col-12">
            <span class="fs-3">Пользователь {{ $user->name }}</span>
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
    <form class="mt-5" action="{{ route('updateUser', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Имя *</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
        </div>
        <button type="submit" class="btn btn-primary mb-3">Сохранить</button>
    </form>
</div>
@endsection