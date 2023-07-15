export function showMessageError(message) {
    const alertError = document.querySelector('.alert-message')
    alertError.classList.add('alert-danger')
    const textMessage = alertError.querySelector('.text-message')
    textMessage.textContent = message
    alertError.style.display = 'block'
    setTimeout(() => alertError.style.display = 'none', 5000)
}