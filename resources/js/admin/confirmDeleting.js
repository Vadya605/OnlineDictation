const formsDeletion = document.querySelectorAll('.form-delete')
const btnResolve = document.querySelector('.resolve')
let selectedFormDeletion = null;

formsDeletion.forEach( formDeletion => {
    formDeletion.addEventListener('submit', ( event ) => {
        event.preventDefault()
        selectedFormDeletion = event.target
    })
})

btnResolve.addEventListener('click', () => {
    if(selectedFormDeletion){
        selectedFormDeletion.submit()
    }
})

