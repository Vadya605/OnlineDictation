@vite(['resources/js/admin/dateFiltration.js'])
<div class="filters-date">
    <label for="" class="form-label">Промежуток даты</label>
    <div class="d-flex align-items-center gap-1">
        <input type="text" placeholder="От" class="form-control" id="from_date" 
            name="from_date" value="{{ request()->query('from_date') }}" @required(true)>
        <span>-</span>
        <input type="text" placeholder="До" class="form-control" id="to_date" 
            name="to_date" value="{{ request()->query('to_date') }}" @required(true)>
        <button class="btn btn-primary aplly">Применить</button>
    </div>
</div>