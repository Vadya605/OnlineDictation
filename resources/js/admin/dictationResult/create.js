import { OPTIONS_PICKER, routes } from "../../utils/consts"
import { clearForm } from "../clearForm"
import { create } from "../../queries"
import { refreshTable } from "../refreshTable"
import { showMessageError } from '../../showMessageError'
import { showMessageSuccess } from '../../showMessageSuccess'
import { showValidationErrors } from "../showValidationErrors"


const modalCreate = new bootstrap.Modal(document.querySelector('#modalCreate'))
const formCreate = document.forms['formCreate']
const elementsFormCreate = formCreate.elements
flatpickr(elementsFormCreate.date_time_result, OPTIONS_PICKER)

formCreate.addEventListener('submit', async (e) => {
    try{
        e.preventDefault()
        elementsFormCreate.btnAdd.disabled = true

        const dictationResultData = new FormData(formCreate)

        const response = await create(routes.dictationResult.create, dictationResultData)
        
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
    }else if(error.status === StatusCodes.INTERNAL_SERVER_ERROR){
        modalCreate.hide()
        showMessageError(error.data)
    }
}


