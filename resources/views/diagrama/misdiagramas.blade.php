<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

        {{-- Page header --}}
        <div class="sm:flex sm:justify-between sm:items-center mb-8">
    
            <!-- Right: Actions -->
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
    
                <!-- Search form -->
           
    
                <!-- Filter button -->
                
    
                <!-- Create events modal -->
                    @livewire('diagrama.diagram-create')
    
            </div>
    
        </div>

        @livewire('diagrama.mis-diagramas')
    
    
        @push('js')
             
            <script>
                Livewire.on('deleteDiagram', diagramId => {
                    Swal.fire({
                        title: 'Estas seguro?',
                        text: "¡No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#93c47d',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Eliminiar!',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
    
                            Livewire.emitTo('mis-diagramas', 'delete', diagramId);
                            Swal.fire(
                                'Eliminado!',
                                'El Diagrama ha sido eliminado.',
                                'success'
                            )
                        }
                    })
                })
            </script>
    
        @endpush
    
   
    
    </div>
    
</x-app-layout>