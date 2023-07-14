export function removeValidationErrors(formError){
    formError.querySelectorAll('.is-invalid').forEach( element => {
        element.classList.remove('is-invalid')
        element.nextElementSibling?.remove()
    })
}