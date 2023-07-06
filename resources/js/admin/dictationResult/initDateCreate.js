import { Russian } from "flatpickr/dist/l10n/ru.js"


flatpickr(document.querySelectorAll('#dateTimeResult'), {
    enableTime: true,
    dateFormat: "d.m.Y H:i",
    time_24hr: true,
    locale: Russian,
})