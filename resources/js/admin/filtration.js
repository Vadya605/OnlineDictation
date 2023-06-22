const selectFilter = document.querySelector('#select-filter');

selectFilter.addEventListener('change', function() {
    const selectedIndex = selectFilter.selectedIndex
    const selectedOption = selectFilter.options[selectedIndex]
    const columnFilter = selectedOption.getAttribute('data-column')
    const optionFilter = selectedOption.getAttribute('data-option')
    const valueFilter = selectedOption.getAttribute('data-value')

    sort(columnFilter, optionFilter, valueFilter, selectedIndex)
    
});

function sort(columnFilter, optionFilter, valueFilter, selectedIndex){
    let url = new URL(window.location.href)
    url.searchParams.set('column_filter', columnFilter)
    url.searchParams.set('option_filter', optionFilter)
    url.searchParams.set('value_filter', valueFilter)
    url.searchParams.set('selected_filter_index', selectedIndex)

    window.location.href = url
}

window.addEventListener('load', () => {
    const ulrParams = new URLSearchParams(window.location.href)
    selectFilter.options[ulrParams.get('selected_filter_index')].selected = true
})


