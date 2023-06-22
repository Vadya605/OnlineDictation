document.querySelector('.btn-search').addEventListener('click', () => {
    let valueSearch = document.querySelector('.search-input').value
    search(valueSearch)
})

function search(valueSearch){
    let url = new URL(window.location.href)
    url.searchParams.set('search_value', valueSearch)

    window.location.href = url
}

