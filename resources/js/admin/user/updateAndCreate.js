import { OPTIONS_PICKER, ROUTES } from '../../utils/consts'
import { clearForm } from '../clearForm'
import { create, update, getItem } from "../../utils/queries"
import { refreshRecords } from '../refreshRecords'
import { showMessageError, showMessageSuccess, showValidationErrors, removeValidationErrors } from '../../utils/messages'

const modal = new bootstrap.Modal(document.querySelector('#modal'))

function isClickButtonEdit(e){
    return e.target.classList.contains('btn-edit')
}

function isClickButtonCreate(e){
    return e.target.classList.contains('btn-create')
}

function isSubmitFormUpdate(form){
    return form.getAttribute('data-record') !== null
}

document.addEventListener('click', async e => {
    if(isClickButtonEdit(e)){
        handleClickButtonEdit(e)
    }else if(isClickButtonCreate(e)){
        handleClickButtonCreate(e)
    }
})


function changeModalTitle(textTitle){
    const modalTitle = document.querySelector('.title-modal')
    modalTitle.textContent = textTitle
}

async function handleClickButtonCreate(e){
    try{
        changeModalTitle('Добавить пользователя')
        const htmlForm = await getItem(ROUTES.user.create)
        createForm(htmlForm)
    }catch(error){
        console.log(error)
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
        console.log(error)
        modal.hide()
        showMessageError('Не удалось получить запись для изменения')
    }
}

async function handleSubmitFormUser(e){
    try{
        e.preventDefault()
        formUser.elements.btn_submit.disabled = true

        const userData = new FormData(formUser)

        let response = null
        if(isSubmitFormUpdate(formUser)){
            const userSlug = formUser.getAttribute('data-record')
            userData.set('id', userSlug)
            response = await update(ROUTES.user.update(userSlug), conversionDataUpdating(userData))
            console.log(response)
        }else{
            response = await create(ROUTES.user.store, userData)
            clearForm(formUser)
        }

        modal.hide()
        await refreshRecords()
        showMessageSuccess(response)
    }catch(error){
        handleFormSubmitError(error)
    }finally{
        formUser.elements.btn_submit.disabled = false
    }
}

function conversionDataUpdating(data){
    return Object.fromEntries(data)
}

function handleFormSubmitError(error) {
    console.log(error)
    if(error.status === StatusCodes.UNPROCESSABLE_ENTITY){
        showValidationErrors(formUser, error.data.errors)
    }else if(error.status === StatusCodes.INTERNAL_SERVER_ERROR){
        modal.hide()
        showMessageError(error.data)
    }
}

