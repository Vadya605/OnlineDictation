@vite(['resources/js/admin/search.js'])
<div class="search d-flex align-items-end gap-2">
    <div>
        <label for="select-sort" class="form-label">Поиск</label>
        <input type="text" id="search" placeholder="{{ $inputPlaceholder }}" class="form-control search-input" data-column="name" value="{{ request()->query('search_value') }}">
    </div>
    <button class="btn btn-primary btn-search">Найти</button>
</div>