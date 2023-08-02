import { showMessageError } from "../utils/messages";
import { refreshTable } from "./refreshTable";

const url = new URL(window.location.href)

document.addEventListener('click', async e => {
    if(isClickSortItem(e)){
        const sortValue = e.target.getAttribute('data-value')
        await sort(sortValue)
        setActiveSortItem(sortValue)
    }
})

function setActiveSortItem(sortValue){
    sortValue && document.querySelector(`[data-value="${sortValue}"]`).classList.add('active-sort-item')
}

function isClickSortItem(e){
    return e.target.classList.contains('sort-item')
}

async function sort(sortValue){
    try{
        url.searchParams.set('sort', sortValue)
        history.pushState(null, null, url)
        await refreshTable()
    }catch(error){
        history.back()
        showMessageError(error.sort[0])
    }
}

window.addEventListener('load', () => {
    const sortValue = url.searchParams.get('sort')
    setActiveSortItem(sortValue)
})
