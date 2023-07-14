import { routes } from "../../utils/consts"
import { remove } from "../queries"
import { refreshTable } from "../refreshTable"
import { showMessageError } from "../showMessageError"
import { showMessageSuccess } from "../showMessageSuccess"

const btnResolve = document.querySelector('.resolve')
let selectedDictationId = null
const urlDelete = 'http://localhost:8000/admin/dictation/delete/'

document.addEventListener('click', e => {
    if(isClickButtonDelete(e)){
        selectedDictationId = e.target.id
    }
})

function isClickButtonDelete(e){
    return e.target.classList.contains('btn-delete')
}

btnResolve.addEventListener('click', async () => {
    try{
        btnResolve.disabled = true
        const response = await remove(routes.dictation.delete(selectedDictationId))

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
