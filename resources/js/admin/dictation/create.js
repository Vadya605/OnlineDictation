import { OPTIONS_PICKER, ROUTES } from '../../utils/consts'
import { clearForm } from '../clearForm'
import { create } from "../../utils/queries"
import { refreshTable } from '../refreshTable'
import { showMessageError, showMessageSuccess, showValidationErrors } from '../../utils/messages'


const modalCreate = new bootstrap.Modal(document.querySelector('#modalCreate'))
const formCreate = document.forms['formCreate']

flatpickr(formCreate.elements.from_date_time, OPTIONS_PICKER)
flatpickr(formCreate.elements.to_date_time, OPTIONS_PICKER)

formCreate.addEventListener('submit', async (e) => {
    try{
        e.preventDefault()
        formCreate.elements.btnAdd.disabled = true

        const dictationData = new FormData(formCreate)
        dictationData.set('is_active', Number(formCreate.elements.is_active.checked))

        const response = await create(ROUTES.dictation.create, dictationData)

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
    }else if(error.status === StatusCodes.INTERNAL_SERVER_ERROR){
        modalCreate.hide()
        showMessageError(error.data)
    }
}

