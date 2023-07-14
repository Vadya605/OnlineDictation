export function showMessageSuccess(message) {
    const alertSuccess = document.querySelector('.alert-message')
    alertSuccess.classList.add('alert-success')
    const textMessage = alertSuccess.querySelector('.text-message')
    textMessage.textContent = message
    alertSuccess.style.display = 'block'
    setTimeout(() => alertSuccess.style.display = 'none', 5000)
}