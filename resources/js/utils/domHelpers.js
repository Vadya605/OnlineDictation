export function isClickButtonEdit(e){
    return e.target.classList.contains('btn-edit')
}

export function isClickButtonCreate(e){
    return e.target.classList.contains('btn-create')
}

export function isSubmitFormUpdate(form){
    return form.getAttribute('data-record') !== null
}

export function changeModalTitle(textTitle){
    const modalTitle = document.querySelector('.title-modal')
    modalTitle.textContent = textTitle
}