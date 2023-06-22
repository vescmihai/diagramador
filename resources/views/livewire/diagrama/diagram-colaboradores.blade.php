<div>
    <!-- show event -->
    <div>
        <div class="mt-8">
            @if ($diagram_has_users->isEmpty())
                <h2 class="text-xl leading-snug text-slate-800 font-bold mb-5">No existe ningún registro coincidente</h2>
            @else
                <h2 class="text-xl leading-snug text-slate-800 font-bold mb-5">Diagramas invitados</h2>
            @endif

            <div class="p-5">
                <table class="table-auto w-full text-left whitespace-no-wrap">
                    <thead>
                        <tr class="bg-green-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="px-4 py-2">Nombre del Diagrama</th>
                            <th class="px-4 py-2">Propietario</th>
                            <th class="px-4 py-2 w-36">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($diagram_has_users as $diagram_has_user)
                            <tr class="bg-white shadow-lg rounded-sm border border-slate-200">
                                <td class="px-4 py-2">{{ $diagram_has_user->diagram_name }}</td>
                                <td class="px-4 py-2">{{ $diagram_has_user->user_id }}</td>
                                <td class="px-4 py-2 flex justify-around">
           
                                    <a href="{{ route('diagrama.edit', $diagram_has_user->diagram_id) }}" class="bg-orange-500 hover:bg-orange-600 text-white rounded-full p-2 transition duration-300 mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="h-8 w-8">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897l12.682-12.682z" />
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
            {{ $diagram_has_users->links() }}
        </div>
    </div>
</div>
