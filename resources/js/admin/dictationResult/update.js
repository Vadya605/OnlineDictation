import { OPTIONS_PICKER, ROUTES } from '../../utils/consts'
import { getItem, update } from "../../utils/queries"
import { refreshTable } from '../refreshTable'
import { showMessageError, showMessageSuccess, showValidationErrors, removeValidationErrors } from '../../utils/messages'

const formUpdate = document.forms['formUpdate']
const modalUpdate = new bootstrap.Modal(document.querySelector('#modalUpdate'))
const pickrDateTimeResult = flatpickr(formUpdate.elements.date_time_result, OPTIONS_PICKER)

document.addEventListener('click', async e => {
    if(!isClickButtonEdit(e)){
        return 
    }

    try{
        formUpdate.elements.btnUpdate.disabled = true

        const dictationResultId = e.target.getAttribute('data-id')
        const dictationResultData = await getItem(ROUTES.dictationResult.get(dictationResultId))

        removeValidationErrors(formUpdate)
        fillForm(dictationResultData)
    }catch(error){
        modalUpdate.hide()
        showMessageError('Не удалось получить запись для изменения')
    }finally{
        formUpdate.elements.btnUpdate.disabled = false
    }
})

function isClickButtonEdit(e){
    return e.target.classList.contains('btn-edit')
}

function fillForm(dictationResultData){
    formUpdate.elements.id.value = dictationResultData.id
    formUpdate.elements.text_result.value = dictationResultData.text_result
    dictationResultData.date_time_result && pickrDateTimeResult.setDate(new Date(dictationResultData.date_time_result))
    setSelectedDictationId(dictationResultData.dictation.id)
    setSelectedUserId(dictationResultData.user.id)
}

function setSelectedDictationId(dictationId){
    const selectedOption = formUpdate.elements.dictation_id.querySelector(`option[value="${dictationId}"]`)
    selectedOption.selected = true
}

function setSelectedUserId(userId){
    const selectedOption = formUpdate.elements.user_id.querySelector(`option[value="${userId}"]`)
    selectedOption.selected = true
}

formUpdate.addEventListener('submit', async e => {
    try{
        e.preventDefault()
        formUpdate.elements.btnUpdate.disabled = true

        const dictationResultData = new FormData(formUpdate)

        const response = await update(ROUTES.dictationResult.update(dictationResultData.get('id')), dictationResultData)

        modalUpdate.hide()
        await refreshTable()
        showMessageSuccess(response)
    }catch(error){
        handleFormSubmitError(error)
    }finally{
        formUpdate.elements.btnUpdate.disabled = false
    }

})

function handleFormSubmitError(error) {
    if(error.status === StatusCodes.UNPROCESSABLE_ENTITY){
        showValidationErrors(formUpdate, error.data.errors)
    }else if(error.status === StatusCodes.INTERNAL_SERVER_ERROR){
        modalUpdate.hide()
        showMessageError(error.data)
    }
}