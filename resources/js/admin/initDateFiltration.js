import { Russian } from "flatpickr/dist/l10n/ru.js"

flatpickr(document.querySelectorAll('#fromDate, #toDate'), {
    enableTime: true,
    dateFormat: "d.m.Y H:i",
    time_24hr: true,
    locale: Russian
});