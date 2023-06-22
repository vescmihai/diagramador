<div>
    <!-- show event -->
    
    <div>
        <div class="mt-8">
            @if ($diagrams->isEmpty())
                <h2 class="text-xl leading-snug text-slate-800 font-bold mb-5">No existe ningun registro coincidente
                </h2>
            @else
                <h2 class="text-xl leading-snug text-slate-800 font-bold mb-5">Mis diagramas</h2>
            @endif

            <div class="p-5">
                <table class="table-auto w-full text-left whitespace-no-wrap">
                    <thead>
                        <tr class="bg-green-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2 w-36">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($diagrams as $diagram)
                            <tr class="bg-white shadow-lg rounded-sm border border-slate-200">
                                <td class="px-4 py-2">{{ $diagram->diagram_name }}</td>
                                <td class="px-4 py-2 flex justify-around">
                                    <a href="{{route('diagrama.editar.colaboradores',$diagram->id)}}" class="bg-green-500 hover:bg-green-600 text-white rounded-full p-2 transition duration-300 mr-2">
                                        <svg class="w-8 h-8 fill-current text-white" viewBox="0 0 16 16">
                                            <path
                                                d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('diagrama.edit',$diagram->id) }}" class="bg-orange-500 hover:bg-orange-600 text-white rounded-full p-2 transition duration-300 mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="h-8 w-8">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897l12.682-12.682z" />
                                        </svg>
                                    </a>
                                    <a wire:click="$emit('deleteDiagram',{{ $diagram->id }})" class="bg-red-500 hover:bg-red-600 text-white rounded-full p-2 transition duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="h-8 w-8">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                    
                                    </a>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="px-6 py-3">
            {{ $diagrams->links() }}
        </div>
    </div>
</div>
