import { clearForm } from "./clearForm"
import { refreshTable } from "./refreshTable"

document.querySelector('.btn-reset').addEventListener('click', async e => {
    e.preventDefault()
    history.pushState(null, null, e.target.href)

    const formFilters = document.querySelector('#formFilters')
    formFilters && clearForm(formFilters)
    await refreshTable()
    
    $('#searchDictation').val(null).trigger('change')
    $('#searchUser').val(null).trigger('change')
})