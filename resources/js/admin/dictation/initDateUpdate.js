import { Russian } from "flatpickr/dist/l10n/ru.js"

const pickrFromDateTime = flatpickr(document.querySelectorAll('#fromDateTime'), {
    enableTime: true,
    dateFormat: "d.m.Y H:i",
    time_24hr: true,
    locale: Russian,
});

const pickrToDateTime = flatpickr(document.querySelectorAll('#toDateTime'), {
    enableTime: true,
    dateFormat: "d.m.Y H:i",
    time_24hr: true,
    locale: Russian,
});

if(!pickrFromDateTime.selectedDates.length && fromDateTime){
    pickrFromDateTime.setDate(new Date(fromDateTime))
}

if(!pickrToDateTime.selectedDates.length && toDateTime){
    pickrToDateTime.setDate(new Date(toDateTime))
}

