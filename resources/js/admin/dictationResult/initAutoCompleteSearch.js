import select2 from 'select2';
select2()

const searchDictaitonPath = "/admin/dictation/autoCompleteSearch";
const searchUserPath = "/admin/user/autoCompleteSearch";


$('#dictationSearch').select2({
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
        };
        },
        cache: true
    }
});

$('#userSearch').select2({
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
        };
        },
        cache: true
    }
});  






