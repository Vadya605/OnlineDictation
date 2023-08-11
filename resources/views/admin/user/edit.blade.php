<form id="formUser" action="" method="POST" data-record="{{ $user->slug }}">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Имя *</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email *</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
    </div>
    <button name="btn_submit" type="submit" class="btn btn-primary mb-3">Сохранить</button>
</form>