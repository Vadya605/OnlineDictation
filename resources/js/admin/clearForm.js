import { removeValidationErrors } from "./removeValidationErrors"

export function clearForm(form){
    removeValidationErrors(form)
    form.reset()
}