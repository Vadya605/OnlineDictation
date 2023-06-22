const selectSort = document.getElementById('select-sort');

selectSort.addEventListener('change', function() {
    const selectedOption = selectSort.options[selectSort.selectedIndex]
    const selectedIndex = selectSort.selectedIndex
    const columnSort = selectedOption.getAttribute('data-column')
    const optionSort = selectedOption.getAttribute('data-option')

    sort(columnSort, optionSort, selectedIndex)
    
});

function sort(columnSort, optionSort, selectedIndex){
    let url = new URL(window.location.href)
    url.searchParams.set('column_sort', columnSort)
    url.searchParams.set('option_sort', optionSort)
    url.searchParams.set('selected_sort_index', selectedIndex)
    window.location.href = url
}

window.addEventListener('load', () => {
    const ulrParams = new URLSearchParams(window.location.href)
    selectSort.options[ulrParams.get('selected_sort_index')].selected = true
})