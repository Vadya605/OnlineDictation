import { ROUTES } from "../../utils/consts"
import { getItem, update } from "../../utils/queries"
import { refreshTable } from "../refreshTable"
import { showMessageError, showMessageSuccess, showValidationErrors } from '../../utils/messages'


const modalUpdate = new bootstrap.Modal(document.querySelector('#modalUpdate'))


document.addEventListener('click', async e => {
    if(!isClickButtonEdit(e)){
        return 
    }

    try{
        const userId = e.target.getAttribute('data-record')
        const htmlForm = await getItem(ROUTES.user.get(userId))
        createForm(htmlForm)
    }catch(error){
        modalUpdate.hide()
        showMessageError('Не удалось получить запись для изменения')
    }
})

function isClickButtonEdit(e){
    return e.target.classList.contains('btn-edit')
}

function createForm(htmlForm){
    document.querySelector('#modalUpdate .modal-body').innerHTML = htmlForm
    const formUpdate =  document.querySelector('#formUpdate')
    formUpdate.addEventListener('submit', handleSubmitFormUpdate)
}

async function handleSubmitFormUpdate(e){
    const btnUpdate = e.target.elements.btnUpdate
    try{
        e.preventDefault()
        btnUpdate.disabled = true

        const userData = new FormData(e.target)
        const response = await update(ROUTES.user.update(userData.get('user_id')), userData)

        modalUpdate.hide()
        await refreshTable()
        showMessageSuccess(response)
    }catch(error){
        handleFormSubmitError(error)
    }finally{
        btnUpdate.disabled = false
    }
    
}

function handleFormSubmitError(error) {
    if(error.status === StatusCodes.UNPROCESSABLE_ENTITY){
        const formUpdate =  document.querySelector('#formUpdate')
        showValidationErrors(formUpdate, error.data.errors)
    }else if(error.status === StatusCodes.INTERNAL_SERVER_ERROR){
        modalUpdate.hide()
        showMessageError(error.data)
    }
}