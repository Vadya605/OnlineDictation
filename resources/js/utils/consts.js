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
    get: (slug) => `${BASE_ADMIN_URL}/dictation/edit/${slug}`,
    update: (slug) => `${BASE_ADMIN_URL}/dictation/update/${slug}`,
    store: `${BASE_ADMIN_URL}/dictation/store`,
    delete: (slug) => `${BASE_ADMIN_URL}/dictation/delete/${slug}`,
    search: `${BASE_ADMIN_URL}/dictation/autoCompleteSearch`,
  },
  user: {
    get: (slug) => `${BASE_ADMIN_URL}/user/edit/${slug}`,
    update: (slug) => `${BASE_ADMIN_URL}/user/update/${slug}`,
    store: `${BASE_ADMIN_URL}/user/store`,
    create: `${BASE_ADMIN_URL}/user/create`,
    delete: (slug) => `${BASE_ADMIN_URL}/user/delete/${slug}`,
    search: `${BASE_ADMIN_URL}/user/autoCompleteSearch`,
  },
  dictationResult: {
    get: (slug) => `${BASE_ADMIN_URL}/dictationResult/edit/${slug}`,
    update: (slug) => `${BASE_ADMIN_URL}/dictationResult/update/${slug}`,
    store: `${BASE_ADMIN_URL}/dictationResult/store`,
    delete: (slug) => `${BASE_ADMIN_URL}/dictationResult/delete/${slug}`,
    save: `${BASE_URL}/saveDictationResult`
  },
}
