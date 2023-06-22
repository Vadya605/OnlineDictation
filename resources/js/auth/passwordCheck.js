document.querySelector('#password').addEventListener('input', function() {
    document.querySelector('#password-help').textContent = getPasswordStatus(this.value)
})

function getPasswordStatus(password){
    const hasLowerCase = /[a-zа-я]/.test(password);
    const hasUpperCase = /[A-ZА-Я]/.test(password);
    const hasNumber = /\d/.test(password);
    const hasSpecialChar = /[^\w\s]/.test(password);
    const isMinLength = password.length >= 6;

    if (isMinLength && hasLowerCase && hasUpperCase && hasNumber && hasSpecialChar) {
        return 'Ваш пароль сильный';
    } else if (isMinLength && (hasLowerCase || hasUpperCase || hasNumber || hasSpecialChar)) {
        return 'Ваш пароль средней силы';
    } else {
        return 'Ваш пароль слабый';
    }
}