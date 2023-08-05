import { ROUTES } from "../../utils/consts"
import { refreshTable } from "../refreshTable"
import { showMessageError, showMessageSuccess } from '../../utils/messages'
import { remove } from "../../utils/queries"


const btnResolve = document.querySelector('.resolve')

document.addEventListener('click', e => {
    if(isClickButtonDelete(e)){
        btnResolve.setAttribute('data-record', e.target.getAttribute('data-record'))
    }
})

function isClickButtonDelete(e){
    return e.target.classList.contains('btn-delete')
}

btnResolve.addEventListener('click', async () => {
    try{
        btnResolve.disabled = true
        const dictationId = btnResolve.getAttribute('data-record')
        const response = await remove(ROUTES.dictation.delete(dictationId))

        await refreshTable()
        showMessageSuccess(response)
    }catch(error){
        handleFormSubmitError(error)
    }finally{
        btnResolve.disabled = false
    }
})

function handleFormSubmitError(error){
    if(error.status === StatusCodes.INTERNAL_SERVER_ERROR){
        showMessageError(error.data)
    }
}
