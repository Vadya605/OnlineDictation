import { OPTIONS_PICKER, ROUTES } from '../../utils/consts'
import { refreshTable } from '../refreshTable'
import { showMessageError, showMessageSuccess, showValidationErrors, removeValidationErrors } from '../../utils/messages'
import { update, getItem } from '../../utils/queries'



const formUpdate = document.forms['formUpdate']
const modalUpdate = new bootstrap.Modal(document.querySelector('#modalUpdate'))
const pickrFromDateTime = flatpickr(formUpdate.elements.from_date_time, OPTIONS_PICKER)
const pickrToDateTime = flatpickr(formUpdate.elements.to_date_time, OPTIONS_PICKER)


document.addEventListener('click', async e => {
    if(!isClickButtonEdit(e)){
        return 
    }

    try{
        formUpdate.elements.btnUpdate.disabled = true

        const dictationSlug = e.target.getAttribute('data-record')
        const dictationData = await getItem(ROUTES.dictation.get(dictationSlug))

        removeValidationErrors(formUpdate)
        fillForm(dictationData)
        formUpdate.setAttribute('data-record', dictationSlug)
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

function fillForm(dictationData){
    formUpdate.elements.title.value = dictationData.title
    formUpdate.elements.video_link.value = dictationData.video_link
    formUpdate.elements.description.value = dictationData.description
    formUpdate.elements.is_active.checked = dictationData.is_active
    dictationData.from_date_time && pickrFromDateTime.setDate(new Date(dictationData.from_date_time))
    dictationData.to_date_time && pickrToDateTime.setDate(new Date(dictationData.to_date_time))
}

formUpdate.addEventListener('submit', async e => {
    try{
        e.preventDefault()
        formUpdate.elements.btnUpdate.disabled = true

        const dictationData = new FormData(formUpdate)
        dictationData.set('is_active', Number(formUpdate.elements.is_active.checked))
        const dictationSlug = formUpdate.getAttribute('data-record')

        const response = await update(ROUTES.dictation.update(dictationSlug), dictationData)

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