<div class="flex-grow-1">
    <label for="select-sort" class="form-label">Поиск</label>
    <input type="text" id="search" placeholder="{{ $inputPlaceholder }}" name="search"
        class="form-control search-input @error('search') is-invalid @enderror"
        value="{{ old('search')??request()->query('search') }}">
</div>