import axios from 'https://cdn.jsdelivr.net/npm/axios@1.3.5/+esm';

document.querySelector('.date').textContent = new Date().toLocaleDateString()

document.querySelector('.dictation-form').addEventListener('submit', (event) => {    
    event.preventDefault()

    const dictationResultData = {
        _token: document.querySelector('meta[name="csrf-token"]').content,
        user_id: document.querySelector('#user_id').value,
        dictation_id: document.querySelector('#dictation_id').value,
        text_result: document.querySelector('#text_result').value,
        date: new Date()
    }

    saveDictationResult(dictationResultData)
        .then(result => {
            disabledForm(event.target)
            alert(result)

        })
        .catch(alert)
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
                reject('Результат не удалось сохранить')
            });
    }) 
}


function disabledForm(form){
    form.querySelectorAll('*').forEach(element => {
        element.disabled = true
    })
}