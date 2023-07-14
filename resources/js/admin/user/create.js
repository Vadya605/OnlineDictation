import { routes } from "../../utils/consts"
import { create } from "../queries"
import { showMessageError } from "../showMessageError"
import { showMessageSuccess } from "../showMessageSuccess"
import { showValidationErrors } from "../showValidationErrors"
import { clearForm } from "../clearForm"
import { refreshTable } from "../refreshTable"

const modalCreate = new bootstrap.Modal(document.querySelector('#modalCreate'))
const formCreate = document.forms['formCreate']
const elementsFormCreate = formCreate.elements

formCreate.addEventListener('submit', async (e) => {
    try{
        e.preventDefault()
        elementsFormCreate.btnAdd.disabled = true

        const userData = new FormData(formCreate)
        const response = await create(routes.user.create, userData)
        
        clearForm(formCreate)
        modalCreate.hide()
        await refreshTable()
        showMessageSuccess(response)
    }catch(error){
        handleFormSubmitError(error)
    }finally{
        elementsFormCreate.btnAdd.disabled = false
    }
})

function handleFormSubmitError(error) {
    if(error.status === StatusCodes.UNPROCESSABLE_ENTITY){
        showValidationErrors(formCreate, error.data.errors)
    }else if(error.status ===  StatusCodes.INTERNAL_SERVER_ERROR){
        modalCreate.hide()
        showMessageError(error.data)
    }
}

