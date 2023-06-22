// Error inesperado al crear un nuevo diagrama
Livewire.on('unexpected_error', () => {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Ha ocurrido un error inesperado, intentalo de nuevo...',
    })
})

// Cambios guardados
Livewire.on('changesSaved', () => {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: 'success',
        title: 'Cambios guardados exitosamente'
    })

})

// Verifica si existen diagramas seleccionados
Livewire.on('isSelectDiagram', () => {
    Livewire.emit('areSelectDiagram')
})

// No hay diagramas seleccionados
Livewire.on('noDiagramSelect', () => {
    Swal.fire({
        title: 'No hay diagramas seleccionados',
        text: 'Primero debes seleccionar algún diagrama...',
        icon: 'error',
    })
})

