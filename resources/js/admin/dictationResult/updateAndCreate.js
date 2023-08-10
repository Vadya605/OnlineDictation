import { OPTIONS_PICKER, ROUTES } from '../../utils/consts'
import { clearForm } from '../clearForm'
import { create, update, getItem } from "../../utils/queries"
import { refreshRecords } from '../refreshRecords'
import { showMessageError, showMessageSuccess, showValidationErrors, removeValidationErrors } from '../../utils/messages'

const modal = new bootstrap.Modal(document.querySelector('#modal'))
const formDictationResult = document.forms['formDictationResult']
const pickrDateTimeResult = flatpickr(formDictationResult.elements.date_time_result, OPTIONS_PICKER)

function isClickButtonEdit(e){
    return e.target.classList.contains('btn-edit')
}

function isClickButtonCreate(e){
    return e.target.classList.contains('btn-create')
}

function isSubmitFormUpdate(form){
    return form.getAttribute('data-record') !== null
}

function setSelectedDictationId(dictationId){
    const selectedOption = formDictationResult.elements.dictation_id.querySelector(`option[value="${dictationId}"]`)
    selectedOption.selected = true
}

function setSelectedUserId(userId){
    const selectedOption = formDictationResult.elements.user_id.querySelector(`option[value="${userId}"]`)
    selectedOption.selected = true
}

function setVisibilityMark(visibility){
    document.querySelector('.mark-field').classList.toggle('d-none', !visibility)
}

document.addEventListener('click', async e => {
    if(isClickButtonEdit(e)){
        handleClickButtonEdit(e)
    }else if(isClickButtonCreate(e)){
        handleClickButtonCreate(e)
    }
})

formDictationResult.elements.is_checked.addEventListener('change', function() {
    setVisibilityMark(this.checked)
})

function changeModalTitle(textTitle){
    const modalTitle = document.querySelector('.title-modal')
    modalTitle.textContent = textTitle
}

function handleClickButtonCreate(e){
    setVisibilityMark(false)
    clearForm(formDictationResult)
    changeModalTitle('Добавить результат диктанта')
}

async function handleClickButtonEdit(e){
    try{
        changeModalTitle('Изменить результат диктанта')
        formDictationResult.elements.btn_submit.disabled = true

        const dictationResultSlug = e.target.getAttribute('data-record')
        const dictationResultData = await getItem(ROUTES.dictationResult.get(dictationResultSlug))

        removeValidationErrors(formDictationResult)
        fillForm(dictationResultData)
        formDictationResult.setAttribute('data-record', dictationResultSlug)
    }catch(error){
        modal.hide()
        showMessageError('Не удалось получить запись для изменения')
    }finally{
        formDictationResult.elements.btn_submit.disabled = false
    }
}

function fillForm(dictationResultData){
    formDictationResult.elements.text_result.value = dictationResultData.text_result
    formDictationResult.elements.is_checked.checked = dictationResultData.is_checked
    formDictationResult.elements.mark.value = dictationResultData.mark
    dictationResultData.date_time_result && pickrDateTimeResult.setDate(new Date(dictationResultData.date_time_result))
    
    setVisibilityMark(dictationResultData.is_checked)
    setSelectedDictationId(dictationResultData.dictation.id)
    setSelectedUserId(dictationResultData.user.id)
}

formDictationResult.addEventListener('submit', async (e) => {
    try{
        e.preventDefault()
        formDictationResult.elements.btn_submit.disabled = true

        const dictationData = new FormData(formDictationResult)
        dictationData.set('is_checked', Number(formDictationResult.elements.is_checked.checked))

        let response = null
        if(isSubmitFormUpdate(formDictationResult)){
            const dictationSlug = formDictationResult.getAttribute('data-record')
            response = await update(ROUTES.dictationResult.update(dictationSlug), conversionDataUpdating(dictationData))
        }else{
            response = await create(ROUTES.dictationResult.create, dictationData)
            clearForm(formDictationResult)
        }

        modal.hide()
        await refreshRecords()
        showMessageSuccess(response)
    }catch(error){
        handleFormSubmitError(error)
    }finally{
        formDictationResult.elements.btn_submit.disabled = false
    }
})

function conversionDataUpdating(data){
    return Object.fromEntries(data)
}

function handleFormSubmitError(error) {
    if(error.status === StatusCodes.UNPROCESSABLE_ENTITY){
        showValidationErrors(formDictationResult, error.data.errors)
    }else if(error.status === StatusCodes.INTERNAL_SERVER_ERROR){
        modal.hide()
        showMessageError(error.data)
    }
}

