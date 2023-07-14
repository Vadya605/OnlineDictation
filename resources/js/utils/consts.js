import { Russian } from "flatpickr/dist/l10n/ru.js"

export const OPTIONS_PICKER = {
    enableTime: true,
    dateFormat: "d.m.Y H:i",
    time_24hr: true,
    locale: Russian,
}

export const baseAdminUrl = 'http://localhost:8000/admin'

export const routes = {
  dictation: {
    get: (id) => `${baseAdminUrl}/dictation/edit/${id}`,
    update: (id) => `${baseAdminUrl}/dictation/update/${id}`,
    create: `${baseAdminUrl}/dictation/store`,
    delete: (id) => `${baseAdminUrl}/dictation/delete/${id}`,
  },
  user: {
    get: (id) => `${baseAdminUrl}/user/edit/${id}`,
    update: (id) => `${baseAdminUrl}/user/update/${id}`,
    create: `${baseAdminUrl}/user/store`,
    delete: (id) => `${baseAdminUrl}/user/delete/${id}`,
  },
  dictationResult: {
    get: (id) => `${baseAdminUrl}/dictationResult/edit/${id}`,
    update: (id) => `${baseAdminUrl}/dictationResult/update/${id}`,
    create: `${baseAdminUrl}/dictationResult/store`,
    delete: (id) => `${baseAdminUrl}/dictationResult/delete/${id}`,
  },
}
