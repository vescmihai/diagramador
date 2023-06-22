@props(['tipoDeUsuarios' => null,'solicitudes' => null, 'nombreDelId' => null,'evento' => null])

<table class="min-w-full  border-collapse block md:table">
    <thead class="bg-gray-50 block md:table-header-group">
        <tr
            class=" border border-gray-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">

            <th
                class=" p-2 text-gray-900 font-bold md:border-2 md:border-grey-500 text-left block md:table-cell">
                Foto</th>
            <th
                class="p-2 text-gray-900 font-bold md:border-2 md:border-grey-500 text-left block md:table-cell">
                Nombre</th>

            <th
                class="p-2 text-gray-900 font-bold md:border-2 md:border-grey-500 text-left block md:table-cell">
                Action</th>

        </tr>
    </thead>
    <tbody class="block md:table-row-group">
        @foreach ($tipoDeUsuarios as $tipoDeUsuario)
            <tr
                class="bg-gray-100 border-2 hover:bg-gray-300 border-gray-500 rounded-lg m-2 md:border-none block md:table-row">

                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                    <span class="inline-block w-1/3 md:hidden font-bold">Foto:</span>

                    <div class=" flex justify-center">

                        @if ($tipoDeUsuario->user->profile_photo_path)
                            <img class=" h-14 w-14 m-1 rounded-full object-cover object-center  relative "
                                src="{{ $tipoDeUsuario->user->profile_photo_path }}"
                                alt="" />
                        @else
                            <span
                                class=" h-14 w-14 bg-indigo-400 rounded-full border-black border-2 text-slate-700 hover:bg-indigo-500 hover:text-black">
                                <img class="mt-3 ml-2 h-9 w-9 m-1  object-cover object-center  relative "
                                    src="{{ asset('images/imagen.png') }}" alt="" />
                            </span>
                        @endif

                    </div>

                </td>
                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                    <span
                        class="inline-block w-1/3 md:hidden font-bold">Nombre:</span>{{ $tipoDeUsuario->user->name }}
                </td>

                <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                    <span class="inline-block w-1/3 md:hidden font-bold">Nombre:</span>

               
                    
                    @if (!$solicitudes->contains( $nombreDelId, $tipoDeUsuario->id))
                        <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white"
                            wire:click="$emitSelf('{{$evento}}',{{ $tipoDeUsuario->id }})">

                            <svg class="w-4 h-4 fill-current opacity-50 shrink-0"
                                viewBox="0 0 16 16">
                                <path
                                    d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                            </svg>
                            <span class="hidden xs:block ml-2">Agregar Solicitud</span>
                        </button>
                    @else
                        <button class="btn bg-rose-100 border-rose-200 hover:bg-rose-200 text-rose-600"
                            wire:click="$emitSelf('{{$evento}}',{{ $tipoDeUsuario->id }})">

                            <svg class="w-4 h-4 shrink-0 fill-current text-rose-500  mr-1" viewBox="0 0 16 16">
                            <path d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm3.5 10.1l-1.4 1.4L8 9.4l-2.1 2.1-1.4-1.4L6.6 8 4.5 5.9l1.4-1.4L8 6.6l2.1-2.1 1.4 1.4L9.4 8l2.1 2.1z"></path>
                            </svg>

                            <span class="hidden xs:block ml-2">Eliminar Solicitud</span>
                        </button>
                    @endif



                </td>

            </tr>
        @endforeach

    </tbody>
</table>