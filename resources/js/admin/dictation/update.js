import { OPTIONS_PICKER, routes } from '../../utils/consts'
import { removeValidationErrors } from '../removeValidationErrors'
import { update, getItem } from '../queries'
import { showMessageError } from '../showMessageError'
import { showMessageSuccess } from '../showMessageSuccess'
import { showValidationErrors } from '../showValidationErrors'
import { refreshTable } from '../refreshTable'


const formUpdate = document.forms['formUpdate']
const elementsFormUpdate = formUpdate.elements
const pickrFromDateTime = flatpickr(elementsFormUpdate.from_date_time, OPTIONS_PICKER)
const pickrToDateTime = flatpickr(elementsFormUpdate.to_date_time, OPTIONS_PICKER)
const modalUpdate = new bootstrap.Modal(document.querySelector('#modalUpdate'))


document.addEventListener('click', async e => {
    if(isClickButtonEdit(e)){
        const dictationData = await getItem(routes.dictation.get(e.target.id))
        removeValidationErrors(formUpdate)
        fillForm(dictationData)
    }
})

function isClickButtonEdit(e){
    return e.target.classList.contains('btn-edit')
}

function fillForm(dictationData){
    elementsFormUpdate.id.value = dictationData.id
    elementsFormUpdate.title.value = dictationData.title
    elementsFormUpdate.video_link.value = dictationData.video_link
    elementsFormUpdate.description.value = dictationData.description
    elementsFormUpdate.is_active.checked = dictationData.is_active
    dictationData.from_date_time && pickrFromDateTime.setDate(new Date(dictationData.from_date_time))
    dictationData.to_date_time && pickrToDateTime.setDate(new Date(dictationData.to_date_time))
}

formUpdate.addEventListener('submit', async e => {
    try{
        e.preventDefault()
        elementsFormUpdate.btnUpdate.disabled = true

        const dictationData = new FormData(formUpdate)
        dictationData.set('is_active', Number(elementsFormUpdate.is_active.checked))

        const response = await update(routes.dictation.update(dictationData.get('id')), dictationData)

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