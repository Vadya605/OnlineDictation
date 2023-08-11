import { ROUTES } from '../../utils/consts'
import { create, update, getItem } from "../../utils/queries"
import { refreshRecords } from '../refreshRecords'
import { isClickButtonCreate, isClickButtonEdit, isSubmitFormUpdate, changeModalTitle } from '../../utils/domHelpers'
import { showMessageError, showMessageSuccess, showValidationErrors, removeValidationErrors } from '../../utils/messages'

const modal = new bootstrap.Modal(document.querySelector('#modal'))

document.addEventListener('click', async e => {
    if(isClickButtonEdit(e)){
        handleClickButtonEdit(e)
    }else if(isClickButtonCreate(e)){
        handleClickButtonCreate(e)
    }
})

async function handleClickButtonCreate(e){
    try{
        changeModalTitle('Добавить пользователя')
        const htmlForm = await getItem(ROUTES.user.create)
        createForm(htmlForm)
    }catch(error){
        modal.hide()
        showMessageError('Ошибка')
    }
}

function createForm(htmlForm){
    document.querySelector('#modal .modal-body').innerHTML = htmlForm
    const formUser = document.forms['formUser']
    formUser.addEventListener('submit', handleSubmitFormUser)
}

async function handleClickButtonEdit(e){
    try{
        changeModalTitle('Изменить пользователя')
        const userSlug = e.target.getAttribute('data-record')
        const htmlForm = await getItem(ROUTES.user.get(userSlug))
        createForm(htmlForm)
    }catch(error){
        modal.hide()
        showMessageError('Не удалось получить запись для изменения')
    }
}

async function handleSubmitFormUser(e){
    try{
        e.preventDefault()
        formUser.elements.btn_submit.disabled = true

        const userData = getFormData()

        const response = isSubmitFormUpdate(formUser)
            ? await update(ROUTES.user.update(userData.slug), userData)
            : await create(ROUTES.user.store, userData)

        modal.hide()
        await refreshRecords()
        showMessageSuccess(response)
    }catch(error){
        handleFormSubmitError(error)
    }finally{
        formUser.elements.btn_submit.disabled = false
    }
}

function getFormData(){
    const userData = Object.fromEntries(new FormData(formUser))
    userData.slug = formUser.getAttribute('data-record')

    return userData
}

function handleFormSubmitError(error) {
    if(error.status === StatusCodes.UNPROCESSABLE_ENTITY){
        showValidationErrors(formUser, error.data.errors)
    }else if(error.status === StatusCodes.INTERNAL_SERVER_ERROR){
        modal.hide()
        showMessageError(error.data)
    }
}

