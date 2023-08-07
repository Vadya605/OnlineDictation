import { refreshRecords } from "./refreshRecords";

document.addEventListener('click', async e => {
    if(isClickPaginationLink(e)){
        e.preventDefault()
        history.pushState(null, null, e.target.href)
        await refreshRecords()
    }
})

function isClickPaginationLink(e){
    return e.target.classList.contains('page-link')
}