const textResult = document.querySelector('#text_result');

textResult.addEventListener('input', function(){
    localStorage.setItem('textResult', this.value);
})

window.addEventListener('load', function(){
    textResult.value = localStorage.getItem('textResult')
})