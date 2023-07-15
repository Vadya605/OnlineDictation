import { create } from "../queries";
import { showMessageError } from "../showMessageError";
import { showMessageSuccess } from "../showMessageSuccess";
import { routes } from "../utils/consts";

document.querySelector('.date').textContent = moment(new Date()).format('DD.MM.YYYY')

const formDictation = document.querySelector('#formDictation')

formDictation.addEventListener('submit', async e => {    
    try{
        e.preventDefault()
        formDictation.elements.btn_send.disabled = true

        const dictationResultData = new FormData(formDictation)
        dictationResultData.set('date_time_result', moment(new Date()).format('DD.MM.YYYY H:mm:ss'))
        
        const response = await create(routes.dictationResult.save, dictationResultData)
        showMessageSuccess(response)
        disabledForm(e.target)
        localStorage.removeItem(`textResult_${dictationResultData.get('user_id')}_${dictationResultData.get('dictation_id')}`)
    }catch(error){
        formDictation.elements.btn_send.disabled = false
        handleFormSubmitError(error)
    }
})

function disabledForm(){
    formDictation.querySelectorAll('*').forEach(element => {
        element.disabled = true
    })
}

function handleFormSubmitError(error) {
    if(error.status === StatusCodes.UNPROCESSABLE_ENTITY){
        showMessageError(error.data.message)
    }else if(error.status === StatusCodes.INTERNAL_SERVER_ERROR){
        showMessageError(error.data)
    }
}