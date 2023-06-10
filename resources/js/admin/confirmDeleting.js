document.querySelectorAll('.form-delete').forEach(formDelete => 
    formDelete.addEventListener('submit', (event) => {
        if(!confirm('Вы уверены, что хотите удалить?')){
            return event.preventDefault();
        }
    }
)) 
