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

$('#dictationSearch').on('select2:select',  (e) => {
    const columnFilter = 'dictation_id'
    const optionFilter = '='
    const valueFilter = e.params.data.id

    filter(columnFilter, optionFilter, valueFilter)

})

$('#userSearch').on('select2:select',  (e) => {
    const columnFilter = 'user_id'
    const optionFilter = '='
    const valueFilter = e.params.data.id

    filter(columnFilter, optionFilter, valueFilter)

})

function filter(columnFilter, optionFilter, valueFilter){
    let url = new URL(window.location.href)
    url.searchParams.set('column_filter', columnFilter)
    url.searchParams.set('option_filter', optionFilter)
    url.searchParams.set('value_filter', valueFilter)

    window.location.href = url
}
