@section('title', 'Colaboradores')
<x-app-layout>
    <div class="flex justify-center items-center w-15/16 mx-auto p-4 lg:p-8">
        

        @livewire('diagrama.diagram-edit-colaboradores', ['diagram' => $diagram])

    </div>
</x-app-layout>
