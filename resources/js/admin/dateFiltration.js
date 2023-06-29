document.querySelector('.aplly').addEventListener('click', () => {
    const fromDate = document.querySelector('#from_date').value
    const toDate = document.querySelector('#to_date').value

    dateFilter(fromDate, toDate)
})

function dateFilter(fromDate, toDate){
    let url = new URL(window.location.href)
    url.searchParams.set('from_date', fromDate)
    url.searchParams.set('to_date', toDate)

    window.location.href = url
}