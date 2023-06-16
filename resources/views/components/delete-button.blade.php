<form class="form-delete" action="{{ $action }}" method="POST">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger text-white">Удалить</button>
</form>