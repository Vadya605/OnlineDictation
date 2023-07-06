const selectFilter = document.querySelector('#select-filter')

selectFilter.addEventListener('change', (e) => {
    const selectedOption = selectFilter.options[selectFilter.selectedIndex]

    const filterColumn = selectedOption.getAttribute('data-column')
    const filterOption = selectedOption.getAttribute('data-option')
    const filterValue = selectedOption.getAttribute('data-value')

    setFilter({ filterColumn, filterValue, filterOption })
})

function setFilter({ filterColumn, filterOption, filterValue }){
    document.querySelector('#filterColumn').value = filterColumn
    document.querySelector('#filterOption').value = filterOption
    document.querySelector('#filterValue').value = filterValue
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