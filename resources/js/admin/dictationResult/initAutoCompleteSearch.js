import select2 from 'select2';
select2()

const searchDictaitonPath = "/admin/dictation/autoCompleteSearch";
const searchUserPath = "/admin/user/autoCompleteSearch";
const url = new URL(window.location.href)

const dictationSearch = $('#dictationSearch')
const userSearch = $('#userSearch')

const selectedDictationId = url.searchParams.get('dictation')
const selectedUserId = url.searchParams.get('user')


dictationSearch.select2({
    placeholder: 'Диктант',
    ajax: {
        url: searchDictaitonPath,
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
});

$.ajax({
    url: searchDictaitonPath,
    dataType: 'json',
    success: function (data) {
        const selectedItem = data.find(item => item.id == selectedDictationId)

        if (selectedItem) {
            const option = new Option(selectedItem.title, selectedItem.id);
            dictationSearch.append(option).trigger('change');
        }
    },
});

userSearch.select2({
    placeholder: 'Пользователь',
    ajax: {
        url: searchUserPath,
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
});  

$.ajax({
    url: searchUserPath,
    dataType: 'json',
    success: function (data) {
        const selectedItem = data.find(item => item.id == selectedUserId)

        if (selectedItem) {
            const option = new Option(selectedItem.name, selectedItem.id);
            userSearch.append(option).trigger('change');
        }
    },
});






