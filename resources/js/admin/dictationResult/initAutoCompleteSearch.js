import select2 from 'select2'
import { ROUTES } from '../../utils/consts'
select2()

const url = new URL(window.location.href)

const searchDictation = $('#searchDictation')
const searchUser = $('#searchUser')


searchDictation.select2({
    placeholder: 'Диктант',
    allowClear: true,
    ajax: {
        url: ROUTES.dictation.search,
        dataType: 'json',
        processResults: function (data) {
            return {
                results:  $.map(data, function (item) {
                    return {
                        text: item.title,
                        id: item.id,
                    }
                })
            }
        },
        cache: true
    }
})

$.ajax({
    url: ROUTES.dictation.search,
    dataType: 'json',
    success: function (data) {
        const selectedDictationId = url.searchParams.get('dictation')
        const selectedItem = data.find(item => item.id == selectedDictationId)

        if (selectedItem) {
            const option = new Option(selectedItem.title, selectedItem.id)
            searchDictation.append(option).trigger('change')
        }
    },
})

searchUser.select2({
    placeholder: 'Пользователь',
    allowClear: true,
    ajax: {
        url: ROUTES.user.search,
        dataType: 'json',
        processResults: function (data) {
            return {
                results:  $.map(data, function (item) {
                    return {
                        text: item.name,
                        id: item.id,
                    }
                })
            }
        },
        cache: true
    }
}) 

$.ajax({
    url: ROUTES.user.search,
    dataType: 'json',
    success: function (data) {
        const selectedUserId = url.searchParams.get('user')
        const selectedItem = data.find(item => item.id == selectedUserId)

        if (selectedItem) {
            const option = new Option(selectedItem.name, selectedItem.id)
            searchUser.append(option).trigger('change')
        }
    },
})






