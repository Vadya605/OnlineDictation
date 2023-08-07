import { OPTIONS_PICKER, ROUTES } from "../../utils/consts"
import { clearForm } from "../clearForm"
import { create } from "../../utils/queries"
import { refreshRecords } from "../refreshRecords"
import { showMessageError, showMessageSuccess, showValidationErrors } from '../../utils/messages'

const modalCreate = new bootstrap.Modal(document.querySelector('#modalCreate'))
const formCreate = document.forms['formCreate']
flatpickr(formCreate.elements.date_time_result, OPTIONS_PICKER)

formCreate.addEventListener('submit', async (e) => {
    try{
        e.preventDefault()
        formCreate.elements.btnAdd.disabled = true

        const dictationResultData = new FormData(formCreate)

        const response = await create(ROUTES.dictationResult.create, dictationResultData)
        
        clearForm(formCreate)
        modalCreate.hide()
        await refreshRecords()
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
    }else if(error.status === StatusCodes.INTERNAL_SERVER_ERROR){
        modalCreate.hide()
        showMessageError(error.data)
    }
}


