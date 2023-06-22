<div>
    @vite(['resources/js/admin/confirmDeleting.js'])
    <form class="form-delete mb-0" action="{{ $action }}" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn-delete"></button>
    </form>
</div>