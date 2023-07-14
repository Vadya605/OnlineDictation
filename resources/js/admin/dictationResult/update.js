import { OPTIONS_PICKER, routes } from '../../utils/consts'
import { getItem, update } from '../queries'
import { showMessageError } from "../showMessageError"
import { showMessageSuccess } from "../showMessageSuccess"
import { showValidationErrors } from "../showValidationErrors"
import { removeValidationErrors } from '../removeValidationErrors'
import { refreshTable } from '../refreshTable'


const formUpdate = document.forms['formUpdate']
const elementsFormUpdate = formUpdate.elements
const modalUpdate = new bootstrap.Modal(document.querySelector('#modalUpdate'))
const pickrDateTimeResult = flatpickr(elementsFormUpdate.date_time_result, OPTIONS_PICKER)


document.addEventListener('click', async e => {
    if(isClickButtonEdit(e)){
        const dictationResultData = await getItem(routes.dictationResult.get(e.target.id))
        removeValidationErrors(formUpdate)
        fillForm(dictationResultData)
    }
})

function isClickButtonEdit(e){
    return e.target.classList.contains('btn-edit')
}

function fillForm(dictationResultData){
    elementsFormUpdate.id.value = dictationResultData.id
    elementsFormUpdate.text_result.value = dictationResultData.text_result
    dictationResultData.date_time_result && pickrDateTimeResult.setDate(new Date(dictationResultData.date_time_result))
    setSelectedDictationId(dictationResultData.dictation.id)
    setSelectedUserId(dictationResultData.user.id)
}

function setSelectedDictationId(dictationId){
    const selectedOption = elementsFormUpdate.dictation_id.querySelector(`option[value="${dictationId}"]`)
    selectedOption.selected = true
}

function setSelectedUserId(userId){
    const selectedOption = elementsFormUpdate.user_id.querySelector(`option[value="${userId}"]`)
    selectedOption.selected = true
}

formUpdate.addEventListener('submit', async e => {
    try{
        e.preventDefault()
        elementsFormUpdate.btnUpdate.disabled = true

        const dictationResultData = new FormData(formUpdate)

        const response = await update(routes.dictationResult.update(dictationResultData.get('id')), dictationResultData)

        modalUpdate.hide()
        await refreshTable()
        showMessageSuccess(response)
    }catch(error){
        handleFormSubmitError(error)
    }finally{
        elementsFormUpdate.btnUpdate.disabled = false
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