import { OPTIONS_PICKER, ROUTES } from '../../utils/consts'
import { clearForm } from '../clearForm'
import { create, update, getItem } from "../../utils/queries"
import { refreshRecords } from '../refreshRecords'
import { isClickButtonCreate, isClickButtonEdit, isSubmitFormUpdate, changeModalTitle } from '../../utils/domHelpers'
import { showMessageError, showMessageSuccess, showValidationErrors, removeValidationErrors } from '../../utils/messages'

const modal = new bootstrap.Modal(document.querySelector('#modal'))
const formDictation = document.forms['formModal']
const pickrFromDateTime = flatpickr(formDictation.elements.from_date_time, OPTIONS_PICKER)
const pickrToDateTime = flatpickr(formDictation.elements.to_date_time, OPTIONS_PICKER)

document.addEventListener('click', async e => {
    if(isClickButtonEdit(e)){
        handleClickButtonEdit(e)
    }else if(isClickButtonCreate(e)){
        handleClickButtonCreate(e)
    }
})

function handleClickButtonCreate(e){
    clearForm(formDictation)
    changeModalTitle('Добавить диктант')
}

async function handleClickButtonEdit(e){
    try{
        changeModalTitle('Изменить диктант')
        formDictation.elements.btn_submit.disabled = true

        const dictationSlug = e.target.getAttribute('data-record')
        const dictationData = await getItem(ROUTES.dictation.get(dictationSlug))

        removeValidationErrors(formDictation)
        fillForm(dictationData)
        formDictation.setAttribute('data-record', dictationSlug)
    }catch(error){
        modal.hide()
        showMessageError('Не удалось получить запись для изменения')
    }finally{
        formDictation.elements.btn_submit.disabled = false
    }
}

function fillForm(dictationData){
    formDictation.elements.title.value = dictationData.title
    formDictation.elements.video_link.value = dictationData.video_link
    formDictation.elements.description.value = dictationData.description
    formDictation.elements.is_active.checked = dictationData.is_active
    formDictation.elements.answer.value = dictationData.answer
    dictationData.from_date_time && pickrFromDateTime.setDate(dictationData.from_date_time)
    dictationData.to_date_time && pickrToDateTime.setDate(dictationData.to_date_time)
}

formDictation.addEventListener('submit', async (e) => {
    try{
        e.preventDefault()
        formDictation.elements.btn_submit.disabled = true

        const dictationData = getFormData()

        const response = isSubmitFormUpdate(formDictation)
            ? await update(ROUTES.dictation.update(dictationData.slug), dictationData)
            : await create(ROUTES.dictation.store, dictationData)

        modal.hide()
        await refreshRecords()
        showMessageSuccess(response)
    }catch(error){
        handleFormSubmitError(error)
    }finally{
        formDictation.elements.btn_submit.disabled = false
    }
})

function getFormData(){
    const dictationData = Object.fromEntries(new FormData(formDictation))
    dictationData.is_active = formDictation.elements.is_active.checked
    dictationData.slug = formDictation.getAttribute('data-record')

    return dictationData
}

function handleFormSubmitError(error) {
    if(error.status === StatusCodes.UNPROCESSABLE_ENTITY){
        showValidationErrors(formDictation, error.data.errors)
    }else if(error.status === StatusCodes.INTERNAL_SERVER_ERROR){
        modal.hide()
        showMessageError(error.data)
    }
}

