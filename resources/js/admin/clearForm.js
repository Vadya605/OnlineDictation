import { removeValidationErrors } from "../utils/messages"

export function clearForm(form){
    removeValidationErrors(form)
    form.reset()
}