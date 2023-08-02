import { Russian } from "flatpickr/dist/l10n/ru.js"

export const OPTIONS_PICKER = {
  enableTime: true,
  dateFormat: "d.m.Y H:i",
  time_24hr: true,
  locale: Russian,
}

export const BASE_URL = 'http://localhost:8000'
export const BASE_ADMIN_URL = `${BASE_URL}/admin`

export const ROUTES = {
  dictation: {
    get: (id) => `${BASE_ADMIN_URL}/dictation/edit/${id}`,
    update: (id) => `${BASE_ADMIN_URL}/dictation/update/${id}`,
    create: `${BASE_ADMIN_URL}/dictation/store`,
    delete: (id) => `${BASE_ADMIN_URL}/dictation/delete/${id}`,
    search: `${BASE_ADMIN_URL}/dictation/autoCompleteSearch`,
  },
  user: {
    get: (id) => `${BASE_ADMIN_URL}/user/edit/${id}`,
    update: (id) => `${BASE_ADMIN_URL}/user/update/${id}`,
    create: `${BASE_ADMIN_URL}/user/store`,
    delete: (id) => `${BASE_ADMIN_URL}/user/delete/${id}`,
    search: `${BASE_ADMIN_URL}/user/autoCompleteSearch`,
  },
  dictationResult: {
    get: (id) => `${BASE_ADMIN_URL}/dictationResult/edit/${id}`,
    update: (id) => `${BASE_ADMIN_URL}/dictationResult/update/${id}`,
    create: `${BASE_ADMIN_URL}/dictationResult/store`,
    delete: (id) => `${BASE_ADMIN_URL}/dictationResult/delete/${id}`,
    save: `${BASE_URL}/saveDictationResult`
  },
}
