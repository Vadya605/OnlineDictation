@extends('layouts.adminApp')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8 col-sm-12">
        <div class="row">
            <div class="col-12">
                <span class="fs-3">Пользователь {{ $user->name }}</span>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                @if(session('error'))
                    <x-errors.alert-error :error="session('error')"/> 
                @elseif (session('message'))
                    <x-messages.message-success :message="session('message')" />
                @endif
            </div>
        </div>
        <form class="mt-5" action="{{ route('admin.user.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <div class="mb-3">
                <label for="name" class="form-label">Имя *</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                    id="name" name="name" value="{{ old('name')?? $user->name }}"
                >
                <x-errors.validation-error field="name" /> 
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email *</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                    id="email" name="email" value="{{ old('email')?? $user->email }}"
                >
                <x-errors.validation-error field="email" /> 
            </div>
            <button type="submit" class="btn btn-primary mb-3">Сохранить</button>
        </form>
    </div>
</div>
@endsection