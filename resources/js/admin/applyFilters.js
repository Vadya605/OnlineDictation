const listFilters = document.querySelector('#select-filter')
const intputDateFrom = document.querySelector('#from_date')
const intputDateTo = document.querySelector('#to_date')
const inputSearch = document.querySelector('#search')

document.querySelector('.apply').addEventListener('click', () => {
    const selectedFilter = listFilters.options[listFilters.selectedIndex]

    const filters = {
        filter_column: selectedFilter.getAttribute('data-column'),
        filter_option: selectedFilter.getAttribute('data-option'),
        filter_value: selectedFilter.getAttribute('data-value'),
        date_from: intputDateFrom.value,
        date_to: intputDateTo.value,
        search: inputSearch.value,
    }

    applyFilters(filters)
})

function applyFilters(filters){
    const url = new URL(window.location.href)
    
    for(let key in filters){
        if(filters[key].length){
            url.searchParams.set(key, filters[key])
        }else{
            url.searchParams.delete(key)
        }
    }
    
    window.location.href = url
}

window.addEventListener('load', () => {
    const url = new URL(window.location.href)

    const filterColumn = url.searchParams.get('filter_column')
    const filterOption = url.searchParams.get('filter_option')
    const filterValue = url.searchParams.get('filter_value')

    setSelectedFilter({ filterColumn, filterOption, filterValue })
})

function setSelectedFilter({ filterColumn, filterOption, filterValue }){
    const selectedFilter = document.querySelector(
        `[data-column="${filterColumn}"][data-option="${filterOption}"][data-value="${filterValue}"]`
    )

    if(selectedFilter){
        selectedFilter.selected=true
    }
}


