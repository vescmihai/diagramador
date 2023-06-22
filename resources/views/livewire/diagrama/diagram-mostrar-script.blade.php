<div>
    {{-- <button id='btn-pgsql' class=" btn bg-indigo-500 hover:bg-indigo-600 text-white" wire:click=$set('open',true)>
        <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
            <path
                d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
        </svg>
        <span class="xs:block ml-2">Add Diagrama</span>
    </button> --}}

    <x-dialog-modal wire:model="open">

        <x-slot name="title">
           SQL
        </x-slot>

        <x-slot name="content">
                <div class="mb-4">
                 
                    <textarea class="w-full" wire:model="contenido" name="" id="" cols="30" rows="15" v></textarea>

                </div>

        </x-slot>

        <x-slot name="footer">
            <div class="mr-4">

                <button class="btn-sm border-green-200 hover:border-green-300 text-green-600"
                    wire:click=$set('open',false)>Cancelar</button>



            </div>

        </x-slot>
    </x-dialog-modal>


</div>