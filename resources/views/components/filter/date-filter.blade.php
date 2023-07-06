<div class="filters-date flex-grow-1">
    <label for="" class="form-label">Промежуток даты</label>
    <div class="d-flex flex-row align-items-center gap-1">
        <input type="text" placeholder="От" class="form-control flex-grow-1 @error('date_from') is-invalid @enderror" id="fromDate" 
            name="date_from" value="{{ old('date_from')??request()->query('date_from') }}">
        <input type="text" placeholder="До" class="form-control flex-grow-1 @error('date_to') is-invalid @enderror" id="toDate" 
            name="date_to" value="{{ old('date_to')??request()->query('date_to') }}">
    </div>
</div>