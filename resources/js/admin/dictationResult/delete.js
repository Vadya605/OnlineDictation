import { routes } from "../../utils/consts"
import { remove } from "../queries"
import { refreshTable } from "../refreshTable"
import { showMessageError } from "../showMessageError"
import { showMessageSuccess } from "../showMessageSuccess"

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
        const response = await remove(routes.dictationResult.delete(selectedDictationResultId))
        
        await refreshTable()
        showMessageSuccess(response)
    }catch(error){
        handleFormSubmitError(error)
    }finally{
        btnResolve.disabled = false
    }
})

function handleFormSubmitError(error){
    if(error.status === 500){
        showMessageError(error.data)
    }
}

