<form id="formUpdate"action="" method="POST">
    @csrf
    @method('PUT')
    <input type="hidden" name="user_id" value="{{ old('user_id')?? $user->id }}">
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
    <button name="btnUpdate" type="submit" class="btn btn-primary mb-3">Сохранить</button>
</form>