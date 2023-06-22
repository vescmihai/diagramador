window.addEventListener('beforeunload', (evt) => {
    
    if (txt_original_bd.value != txt_original.value) {
        if (true) {
            evt.preventDefault()
            evt.returnValue = ""
            return ""
        }
    }

})