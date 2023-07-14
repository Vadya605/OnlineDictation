import { routes } from "../../utils/consts"
import { getItem, update } from "../queries"
import { refreshTable } from "../refreshTable"
import { showMessageError } from "../showMessageError"
import { showMessageSuccess } from "../showMessageSuccess"
import { showValidationErrors } from "../showValidationErrors"

const modalUpdate = new bootstrap.Modal(document.querySelector('#modalUpdate'))


document.addEventListener('click', async e => {
    if(isClickButtonEdit(e)){
        const htmlForm = await getItem(routes.user.get(e.target.id))
        createForm(htmlForm)
    }
})

function isClickButtonEdit(e){
    return e.target.classList.contains('btn-edit')
}

function createForm(htmlForm){
    document.querySelector('#modalUpdate .modal-body').innerHTML = htmlForm
    const formUpdate =  document.querySelector('#formUpdate')
    formUpdate.addEventListener('submit', handleSubmitFormUpdate)
}

async function handleSubmitFormUpdate(e){
    const btnUpdate = e.target.elements.btnUpdate
    try{
        e.preventDefault()
        btnUpdate.disabled = true

        const userData = new FormData(e.target)
        const response = await update(routes.user.update(userData.get('user_id')), userData)

        modalUpdate.hide()
        await refreshTable()
        showMessageSuccess(response)
    }catch(error){
        handleFormSubmitError(error)
    }finally{
        btnUpdate.disabled = false
    }
    
}

function handleFormSubmitError(error) {
    const formUpdate =  document.querySelector('#formUpdate')
    if(error.status === 422){
        showValidationErrors(formUpdate, error.data.errors)
    }else if(error.status === 500){
        modalUpdate.hide()
        showMessageError(error.data)
    }
}