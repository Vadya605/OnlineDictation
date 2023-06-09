import axios from 'https://cdn.jsdelivr.net/npm/axios@1.3.5/+esm';

const userId = document.querySelector('#user_id').value
const dictationId = document.querySelector('#dictation_id').value

document.querySelector('.date').textContent = new Date().toLocaleDateString()

document.querySelector('.dictation-form').addEventListener('submit', (event) => {    
    event.preventDefault()
    
    const dictationResultData = {
        _token: document.querySelector('meta[name="csrf-token"]').content,
        user_id: userId,
        dictation_id: dictationId,
        text_result: document.querySelector('#text_result').value,
        date_time_result: new Date().toLocaleString().replace(',','')
    }

    saveDictationResult(dictationResultData)
        .then(result => {
            disabledForm(event.target)
            showMessage({status: 'success', text: result})
            localStorage.removeItem(`textResult_${userId}_${dictationId}`)
        })
        .catch(error => showMessage({status: 'error', text: error}))
})



function saveDictationResult(dictationResultData){
    return new Promise((resolve, reject) => {
        axios.post('/saveDictationResult', dictationResultData)
            .then(response => {
                if(response.status === 201){
                    resolve(response.data)
                }
                reject('Результат не удалось сохранить')
            })
            .catch(error => {
                reject(error.response.data)
            });
    }) 
}


function disabledForm(form){
    form.querySelectorAll('*').forEach(element => {
        element.disabled = true
    })
}

function showMessage(message){
    let messageBox = document.querySelector('.message')
    
    messageBox.classList.remove('d-none')
    
    if(message.status == 'error'){
        messageBox.classList.add('alert-danger')
    }else{
        messageBox.classList.add('alert-success')
    }
    
    console.log(messageBox)
    messageBox.innerHTML += `<div>${message.text}</div>`
}