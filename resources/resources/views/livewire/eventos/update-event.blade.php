<div>
    <x-dialog-modal wire:model="openEdit">

        <x-slot name="title">
            Editar Evento
        </x-slot>


        <x-slot name="content">
            <div class=" overflow-auto max-h-[450px]">

                @if ($foto)
                    <img class="w-full h-96" src="{{ $foto->temporaryUrl() }}" alt="">
                @elseif($evento->photo_path)
                    <img class="w-full h-96" src="{{ $evento->photo_path }}" alt="">
                @endif

                <!-- Input Types -->
                <div class="px-4 py-4">


                    <div class="grid gap-5 md:grid-cols-2 mb-3">

                        <div>
                            <!-- Start -->
                            <div>
                                <label class="block text-sm font-medium mb-1">Titulo<span
                                        class="text-rose-500">*</span></label>
                                <input class="form-input w-full" type="text" wire:model="evento.nombre" />
                            </div>

                            <div class="mb-3">
                                <x-input-error for="evento.nombre" />
                            </div>
                            <!-- End -->
                        </div>


                        <div>
                            <!-- Start -->
                            <div>
                                <label class="block text-sm font-medium mb-1" for="mandatory">Direccion <span
                                        class="text-rose-500">*</span></label>
                                <input class="form-input w-full" type="text" wire:model="evento.direccion" />
                            </div>
                            <div class="mb-3">
                                <x-input-error for="evento.direccion" />
                            </div>
                            <!-- End -->
                        </div>

                        <div class="col-span-2">
                            <!-- Start -->
                            <div>
                                <label class="block text-sm font-medium mb-1" for="mandatory">Descripcion</label>
                                <textarea wire:model="evento.descripcion" rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-indigo-400 focus:border-indigo-400 "
                                    placeholder="..."></textarea>
                            </div>
                            <div class="mb-3">
                                <x-input-error for="evento.descripcion" />
                            </div>
                            <!-- End -->
                        </div>

                        <div>
                            <!-- Start -->
                            <div>
                                <label class="block text-sm font-medium mb-1">fecha<span
                                        class="text-rose-500">*</span></label>
                                <div class="relative">
                                    <input class="form-input w-full" type="date" wire:model="evento.fecha" />
                                    {{-- <div class="absolute inset-0 right-auto flex items-center pointer-events-none">
                                                <span class="text-sm text-slate-400 font-medium px-3">USD</span>
                                            </div> --}}
                                </div>

                            </div>
                            <div class="mb-3">
                                <x-input-error for="evento.fecha" />
                            </div>
                            <!-- End -->
                        </div>

                        <div>
                            <!-- Start -->
                            <div>
                                <label class="block text-sm font-medium mb-1" for="mandatory">hora <span
                                        class="text-rose-500">*</span></label>
                                <input class="form-input w-full" type="time" wire:model="evento.hora" />
                            </div>
                            <!-- End -->
                            <div class="mb-3">
                                <x-input-error for="evento.hora" />
                            </div>
                        </div>



                    </div>

                    <label class="">
                        Agregar Foto
                    </label>
                    <div class="mt-1">
                        <x-input type="file" class="mb-3" {{-- id="{{ $identificador }}" --}} wire:model="foto" />

                    </div>

                    <div class=" mb-2">
                        <label>
                            Agregar Fotografos
                        </label>
                        <div class="mt-1 relative">
                            <x-input wire:model='searchFotografo' type="search" placeholder="buscar fotografos"
                                class="form-input pl-9 w-full  focus:ring-blue-500 focus:border-blue-500" />
                            <span class="absolute pr-3 pt-2.5 inset-0 right-auto  ">
                                <svg class=" w-4 h-4 shrink-0 fill-current text-slate-400 group-hover:text-slate-500 ml-3 mr-2"
                                    viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7 14c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zM7 2C4.243 2 2 4.243 2 7s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5z" />
                                    <path
                                        d="M15.707 14.293L13.314 11.9a8.019 8.019 0 01-1.414 1.414l2.393 2.393a.997.997 0 001.414 0 .999.999 0 000-1.414z" />
                                </svg>
                            </span>
                        </div>

                    </div>

                    @if (!$fotografos->isEmpty())
                        <div class="overflow-auto h-48 mb-2">
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
                                    @foreach ($fotografos as $fotografo)
                                        <tr
                                            class="bg-gray-100 border-2 hover:bg-gray-300 border-gray-500 rounded-lg m-2 md:border-none block md:table-row">

                                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                                <span class="inline-block w-1/3 md:hidden font-bold">Foto:</span>

                                                <div class=" flex justify-center">

                                                    @if ($fotografo->user->profile_photo_path)
                                                        <img class=" h-14 w-14 m-1 rounded-full object-cover object-center  relative "
                                                            src="{{ $fotografo->user->profile_photo_path }}"
                                                            alt="" />
                                                    @else
                                                        <span
                                                            class=" h-14 w-14 bg-indigo-400 rounded-full border-black border-2 text-slate-700 hover:bg-indigo-500 hover:text-black">
                                                            <img class="mt-3 ml-2 h-9 w-9 m-1  object-cover object-center  relative "
                                                                src="{{ asset('images/imagen.png') }}"
                                                                alt="" />
                                                        </span>
                                                    @endif

                                                </div>

                                            </td>
                                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                                <span
                                                    class="inline-block w-1/3 md:hidden font-bold">Nombre:</span>{{ $fotografo->user->name }}
                                            </td>

                                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                                <span class="inline-block w-1/3 md:hidden font-bold">Nombre:</span>

                                                @if (!$solicitudesFotografos->contains('fotografo_id', $fotografo->id))
                                                    <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white"
                                                        wire:click="$emitSelf('enlistarSolicitudFotografo',{{ $fotografo->id }})">

                                                        <svg class="w-4 h-4 fill-current opacity-50 shrink-0"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                                                        </svg>
                                                        <span class="hidden xs:block ml-2">Agregar Solicitud</span>
                                                    </button>
                                                @else
                                                    <button
                                                        class="btn bg-rose-100 border-rose-200 hover:bg-rose-200 text-rose-600"
                                                        wire:click="$emitSelf('enlistarSolicitudFotografo',{{ $fotografo->id }})">

                                                        <svg class="w-4 h-4 shrink-0 fill-current text-rose-500  mr-1"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm3.5 10.1l-1.4 1.4L8 9.4l-2.1 2.1-1.4-1.4L6.6 8 4.5 5.9l1.4-1.4L8 6.6l2.1-2.1 1.4 1.4L9.4 8l2.1 2.1z">
                                                            </path>
                                                        </svg>

                                                        <span class="hidden xs:block ml-2">Eliminar Solicitud</span>
                                                    </button>
                                                @endif



                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    @else
                        <span class="text-rose-500 mb-4">No existe ningun registro coincidente</span>

                    @endif


                    <div class="mb-2">
                        <label for="">
                            Agregar Invitados
                        </label>
                        <div class="mt-1 relative">
                            <x-input wire:model='searchCliente' type="search" placeholder="Buscar invitados…"
                                class="form-input pl-9 w-full  focus:ring-blue-500 focus:border-blue-500" />
                            <span class="absolute pr-3 pt-2.5 inset-0 right-auto  ">
                                <svg class=" w-4 h-4 shrink-0 fill-current text-slate-400 group-hover:text-slate-500 ml-3 mr-2"
                                    viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7 14c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zM7 2C4.243 2 2 4.243 2 7s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5z" />
                                    <path
                                        d="M15.707 14.293L13.314 11.9a8.019 8.019 0 01-1.414 1.414l2.393 2.393a.997.997 0 001.414 0 .999.999 0 000-1.414z" />
                                </svg>
                            </span>
                        </div>

                    </div>

                    @if (!$clientes->isEmpty())
                        <div class="overflow-auto h-48 mb-2">
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
                                    @foreach ($clientes as $invitado)
                                        <tr
                                            class="bg-gray-100 border-2 hover:bg-gray-300 border-gray-500 rounded-lg m-2 md:border-none block md:table-row">

                                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                                <span class="inline-block w-1/3 md:hidden font-bold">Foto:</span>

                                                <div class=" flex justify-center">

                                                    @if ($invitado->user->profile_photo_path)
                                                        <a href="#"
                                                            wire:click="edit({{ $invitado->user->id }})">
                                                            <img class=" h-14 w-14 m-1 rounded-full object-cover object-center  relative "
                                                                src="{{ $invitado->user->profile_photo_path}}"
                                                                alt="" />
                                                        </a>
                                                    @else
                                                        <a class=" h-14 w-14 bg-indigo-400 rounded-full border-black border-2 text-slate-700 hover:bg-indigo-500 hover:text-black"
                                                            href="#"
                                                            wire:click="edit({{ $invitado->user->id }})">
                                                            <img class="mt-3 ml-2 h-9 w-9 m-1  object-cover object-center  relative "
                                                                src="{{ asset('images/imagen.png') }}"
                                                                alt="" />
                                                        </a>
                                                    @endif

                                                </div>

                                            </td>
                                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                                <span
                                                    class="inline-block w-1/3 md:hidden font-bold">Nombre:</span>{{ $invitado->user->name }}
                                            </td>

                                            <td
                                                class=" p-2 md:align-middle md:border md:border-grey-500 text-left block md:table-cell">
                                                <span class="inline-block w-1/3 md:hidden font-bold">Nombre:</span>

                                                @if (!$solicitudesClientes->contains('cliente_id', $invitado->id))
                                                    <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white"
                                                        wire:click="$emitSelf('enlistarSolicitudCliente',{{ $invitado->id }})">

                                                        <svg class="w-4 h-4 fill-current opacity-50 shrink-0"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
                                                        </svg>
                                                        <span class="hidden xs:block ml-2">Agregar Solicitud</span>
                                                    </button>
                                                @else
                                                    <button
                                                        class="btn bg-rose-100 border-rose-200 hover:bg-rose-200 text-rose-600"
                                                        wire:click="$emitSelf('enlistarSolicitudCliente',{{ $invitado->id }})">

                                                        <svg class="w-4 h-4 shrink-0 fill-current text-rose-500  mr-1"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm3.5 10.1l-1.4 1.4L8 9.4l-2.1 2.1-1.4-1.4L6.6 8 4.5 5.9l1.4-1.4L8 6.6l2.1-2.1 1.4 1.4L9.4 8l2.1 2.1z">
                                                            </path>
                                                        </svg>

                                                        <span class="hidden xs:block ml-2">Eliminar Solicitud</span>
                                                    </button>
                                                @endif

                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    @else
                        <span class="text-rose-500 mb-4">No existe ningun registro coincidente</span>

                    @endif

                </div>

            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="mr-4">

                <button class="btn-sm border-slate-200 hover:border-slate-300 text-slate-600"
                    wire:click=$set('openEdit',false)>Cancelar</button>

                <button
                    class="btn-sm bg-indigo-500 hover:bg-indigo-600 text-white disabled:border-slate-200 disabled:bg-slate-100 disabled:text-slate-400 disabled:cursor-not-allowed shadow-none"
                    wire:loading.attr="disabled" wire:target="update,foto" wire:click=update()>
                    <svg wire:loading wire:target="update,foto" class="animate-spin w-4 h-4 fill-current shrink-0"
                        viewBox="0 0 16 16">
                        <path
                            d="M8 16a7.928 7.928 0 01-3.428-.77l.857-1.807A6.006 6.006 0 0014 8c0-3.309-2.691-6-6-6a6.006 6.006 0 00-5.422 8.572l-1.806.859A7.929 7.929 0 010 8c0-4.411 3.589-8 8-8s8 3.589 8 8-3.589 8-8 8z">
                        </path>
                    </svg>
                    <span class="ml-2" wire:loading.remove wire:target="update,foto">Actualizar</span>
                    <span wire:loading wire:target="update,foto"> cargando </span>

                </button>

            </div>

        </x-slot>
    </x-dialog-modal>
</div>
