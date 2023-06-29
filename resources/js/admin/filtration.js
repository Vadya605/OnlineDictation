const selectFilter = document.querySelector('#select-filter')
let selectedIndex

selectFilter.addEventListener('change', function() {
    selectedIndex = selectFilter.selectedIndex
    const selectedOption = selectFilter.options[selectedIndex]
    const columnFilter = selectedOption.getAttribute('data-column')
    const optionFilter = selectedOption.getAttribute('data-option')
    const valueFilter = selectedOption.getAttribute('data-value')

    filter(columnFilter, optionFilter, valueFilter)
    
});

function filter(columnFilter, optionFilter, valueFilter){
    let url = new URL(window.location.href)
    url.searchParams.set('column_filter', columnFilter)
    url.searchParams.set('option_filter', optionFilter)
    url.searchParams.set('value_filter', valueFilter)

    window.location.href = url
}

function isFilterApplied(url){
    return url.searchParams.has('column_filter') && url.searchParams.has('option_filter') && url.searchParams.has('value_filter')
}

window.addEventListener('load', () => {
    const url = new URL(window.location.href)
    
    if(!isFilterApplied(url)){
        return
    }

    const columnFilter = url.searchParams.get('column_filter')
    const optionFilter = url.searchParams.get('option_filter')
    const valueFilter = url.searchParams.get('value_filter')

    selectActiveFilter(columnFilter, optionFilter, valueFilter)

})

function selectActiveFilter(columnFilter, optionFilter, valueFilter){
    const selectFilterOptions = Array.from(selectFilter.options) 

    const selectedOption = selectFilterOptions.find(option => 
        option.dataset.column == columnFilter && 
        option.dataset.option == optionFilter && 
        option.dataset.value == valueFilter
    )

    selectedOption.selected = true
}


