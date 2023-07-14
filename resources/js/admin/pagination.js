import { refreshTable } from "./refreshTable";

document.addEventListener('click', async e => {
    if(isClickPaginationLink(e)){
        e.preventDefault()
        history.pushState(null, null, e.target.href)
        await refreshTable()
    }
})

function isClickPaginationLink(e){
    return e.target.classList.contains('page-link')
}