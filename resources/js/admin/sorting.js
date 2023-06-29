document.querySelectorAll('.sort-item').forEach(sortItem => {
    sortItem.addEventListener('click', () => {
        const columnSort = sortItem.getAttribute('data-column')
        const optionSort = sortItem.getAttribute('data-option')

        sort(columnSort, optionSort)
    })
})

function sort(columnSort, optionSort){
    let url = new URL(window.location.href)
    url.searchParams.set('column_sort', columnSort)
    url.searchParams.set('option_sort', optionSort)
    window.location.href = url
}
