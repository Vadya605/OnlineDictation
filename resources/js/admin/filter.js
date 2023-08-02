import { OPTIONS_PICKER } from "../utils/consts";
import { refreshTable } from "./refreshTable";
import { showValidationErrors } from "../utils/messages";

flatpickr(document.querySelectorAll('#fromDate, #toDate'), OPTIONS_PICKER)
const formFilters = document.querySelector('#formFilters')

formFilters.addEventListener('submit', async e => {
    try{
        e.preventDefault()
        const formFiltersData = new FormData(e.target)
    
        const url = new URL(window.location.href)
        for(let [key, value] of formFiltersData){
            value ? url.searchParams.set(key, value) : url.searchParams.delete(key)
        }
    
        history.pushState(null, null, url)
        await refreshTable()
    }catch(error){
        showValidationErrors(formFilters, error)
    }
})

window.addEventListener('load', () => {
    const url = new URL(window.location.href)
    const filterValue = url.searchParams.get('filter')
    setActiveFilter(filterValue)  
})

function setActiveFilter(filterValue){
    const selectedFilter = formFilters.querySelector(`option[value="${filterValue}"]`)
    if(selectedFilter) selectedFilter.selected = true
}
