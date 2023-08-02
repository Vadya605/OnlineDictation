import { ROUTES } from "../../utils/consts"
import { remove } from "../../utils/queries"
import { refreshTable } from "../refreshTable"
import { showMessageError, showMessageSuccess } from '../../utils/messages'


const btnResolve = document.querySelector('.resolve')
let selectedDictationResultId = null

document.addEventListener('click', e => {
    if(isClickButtonDelete(e)){
        selectedDictationResultId = e.target.id
    }
})

function isClickButtonDelete(e){
    return e.target.classList.contains('btn-delete')
}

btnResolve.addEventListener('click', async () => {
    try{
        btnResolve.disabled = true
        const response = await remove(ROUTES.dictationResult.delete(selectedDictationResultId))
        
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

