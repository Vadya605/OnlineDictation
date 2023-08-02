export function showMessageError(message) {
    const alertError = document.querySelector('.alert-message')
    alertError.classList.add('alert-danger')
    const textMessage = alertError.querySelector('.text-message')
    textMessage.textContent = message
    alertError.style.display = 'block'
    setTimeout(() => alertError.style.display = 'none', 5000)
}

export function showMessageSuccess(message) {
    const alertSuccess = document.querySelector('.alert-message')
    alertSuccess.classList.add('alert-success')
    const textMessage = alertSuccess.querySelector('.text-message')
    textMessage.textContent = message
    alertSuccess.style.display = 'block'
    setTimeout(() => alertSuccess.style.display = 'none', 5000)
}

export function removeValidationErrors(formError){
    formError.querySelectorAll('.is-invalid').forEach( element => {
        element.classList.remove('is-invalid')
        element.nextElementSibling?.remove()
    })
}

export function showValidationErrors(formError, errors){
    removeValidationErrors(formError)
    
    const elementsFormError = formError.elements
    Object.keys(errors).forEach( field => {
        elementsFormError[field].classList.add('is-invalid')
        elementsFormError[field].insertAdjacentHTML(
            'afterend',
            `<span class="invalid-feedback" id="${field}Error" role="alert"><strong>${ errors[field].join(', ') }</strong></span>`
        )
    })
}