import select2 from 'select2';
select2()

const searchDictaitonPath = "/admin/dictation/autoCompleteSearch";
const searchUserPath = "/admin/user/autoCompleteSearch";

const searchDictation = $('#searchDictation')
const searchUser = $('#searchUser')


searchDictation.select2({
    placeholder: 'Диктант',
    allowClear: true,
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

searchUser.select2({
    placeholder: 'Пользователь',
    allowClear: true,
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

// $('#formFilters').on('reset', function() {
//     $(dictationSearch).val(null).trigger('change')
//     $(userSearch).val(null).trigger('change')
// });






