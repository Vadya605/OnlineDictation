import { removeValidationErrors } from "./removeValidationErrors"

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