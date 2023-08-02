import { ROUTES } from "../../utils/consts"
import { create } from "../../utils/queries"
import { clearForm } from "../clearForm"
import { refreshTable } from "../refreshTable"
import { showMessageError, showMessageSuccess, showValidationErrors } from '../../utils/messages'


const modalCreate = new bootstrap.Modal(document.querySelector('#modalCreate'))
const formCreate = document.forms['formCreate']

formCreate.addEventListener('submit', async (e) => {
    try{
        e.preventDefault()
        formCreate.elements.btnAdd.disabled = true

        const userData = new FormData(formCreate)
        const response = await create(ROUTES.user.create, userData)
        
        clearForm(formCreate)
        modalCreate.hide()
        await refreshTable()
        showMessageSuccess(response)
    }catch(error){
        handleFormSubmitError(error)
    }finally{
        formCreate.elements.btnAdd.disabled = false
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

