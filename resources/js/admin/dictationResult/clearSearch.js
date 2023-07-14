const url = new URL(window.location.href)

$(searchDictation).on('select2:unselect', () => {
    url.searchParams.delete('dictation')
    history.pushState(null, null, url)
})

$(searchUser).on('select2:unselect', () => {
    url.searchParams.delete('user')
    history.pushState(null, null, url)
})