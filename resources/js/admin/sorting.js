document.querySelectorAll('.sort-item').forEach(sortItem => {
    sortItem.addEventListener('click', () => {
        const columnSort = sortItem.getAttribute('data-column')
        const optionSort = sortItem.getAttribute('data-option')

        sort(columnSort, optionSort)
    })
})

function sort(columnSort, optionSort){
    let url = new URL(window.location.href)
    url.searchParams.set('sort_column', columnSort)
    url.searchParams.set('sort_option', optionSort)
    window.location.href = url
}

window.addEventListener('load', () => {
    const url = new URL(window.location.href)
    
    const sortColumn = url.searchParams.get('sort_column')
    const sortOption = url.searchParams.get('sort_option')

    const activeSortItem = document.querySelector(`[data-column="${sortColumn}"][data-option="${sortOption}"]`)

    if(activeSortItem){
        activeSortItem.classList.add('text-primary')
    }
})
