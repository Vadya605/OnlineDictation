document.querySelectorAll('.date-time-selection').forEach(dateTimeSelection => {
    const inputSelection = dateTimeSelection.querySelector('input')
    const valueSelection = dateTimeSelection.querySelector('.value-selection')
    
    valueSelection.textContent = inputSelection.value

    inputSelection.addEventListener('change', function() {
        valueSelection.textContent = inputSelection.value
    })
})
