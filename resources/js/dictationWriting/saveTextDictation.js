const textResult = document.querySelector('#text_result')
const userId = document.querySelector('#user_id').value
const dictationId = document.querySelector('#dictation_id').value

textResult.addEventListener('input', function(){
    localStorage.setItem(`textResult_${userId}_${dictationId}`, this.value)
})

window.addEventListener('load', function(){
    textResult.value = localStorage.getItem(`textResult_${userId}_${dictationId}`)
})
