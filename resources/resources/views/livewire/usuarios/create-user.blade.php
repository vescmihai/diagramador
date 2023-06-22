<div>
    {{-- <x-button class="ml-auto" wire:click=openCLose()>
        Crear nuevo usuario
    </x-button> --}}
    <button class=" btn bg-indigo-500 hover:bg-indigo-600 text-white" wire:click=$set('open',true)>
        <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
            <path
                d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
        </svg>
        <span class="hidden xs:block ml-2">Add Usuario</span>
    </button>
    {{--  <button class="bg-blue-500 text-white font-bold py-2 px-4  ml-auto">
        Botón a la derecha
      </button> --}}

    <x-dialog-modal wire:model="open">

        <x-slot name="title">
            Crear Nuevo Usuario
        </x-slot>

        <x-slot name="content">
            <div class="px-4 ">

                <label for="">
                    Foto de Perfil<span class="text-rose-500">*</span>
                </label>

                <div class="flex items-center">
                    <div class="m-3">

                        @if ($foto)
                            <img  class="h-24 w-24 rounded-full" src="{{ $foto->temporaryUrl() }}" alt="">
                        @else
                            <span class="btn-sm bg-indigo-400 rounded-lg text-slate-700"
                                >
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0"
                                    y="0" width="40" height="40" viewBox="0 0 134 134"
                                    xml:space="preserve">
                                    <circle cx="67" cy="67" r="65" fill="#d2d2d2">
                                    </circle>
                                    <path
                                        d="M67 2c35.841 0 65 29.159 65 65s-29.159 65-65 65S2 102.841 2 67 31.159 2 67 2m0-1C30.55 1 1 30.55 1 67s29.55 66 66 66 66-29.55 66-66S103.45 1 67 1z"
                                        fill="#0c0d0d" opacity=".2"></path>
                                    <path class="st3"
                                        d="M65.92 66.34h2.16c14.802.421 30.928 6.062 29.283 20.349l-1.618 13.322c-.844 6.814-5.208 7.827-13.972 7.865H52.23c-8.765-.038-13.13-1.05-13.974-7.865l-1.62-13.322C34.994 72.402 51.12 66.761 65.92 66.341zM49.432 43.934c0-9.819 7.989-17.81 17.807-17.81 9.822 0 17.81 7.991 17.81 17.81 0 9.819-7.988 17.807-17.81 17.807-9.818 0-17.807-7.988-17.807-17.807z">
                                    </path>
                                </svg>
                            </span>
                        @endif

                    </div>

                    <x-input type="file" class="w-full" id="{{ $identificador }}" wire:model="foto" />

                </div>
                <div class="mb-3">
                    <x-input-error for="foto" />
                </div>



                <div class="mb-4">
                    <label class="" for="">
                        Nombre <span class="text-rose-500">*</span>
                    </label>

                    <x-input type="text" class=" w-full " wire:model="name" />
                    <x-input-error for="name" />

                </div>


                <div class="mb-4">
                    <label for="">
                        email <span class="text-rose-500">*</span>
                    </label>
                    <x-input type="email" class="w-full" wire:model="email" />
                    <x-input-error for="email" />

                </div>

                <div class="mb-4">
                    <label for="">
                        password<span class="text-rose-500">*</span>
                    </label>
                    <x-input type="password" class="w-full" wire:model="password" />
                    <x-input-error for="password" />

                </div>

                <div class="mb-4">
                    <label class="mr4" for="">
                        Tipo de Usuario<span class="text-rose-500">*</span>
                    </label>

                    <select class="form-select w-full" wire:model="rol">
                        <option value=""></option>
                        @foreach ($roles as $rol)
                            <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="rol" />

                </div>


            </div>

        </x-slot>

        <x-slot name="footer">
            <div class="mr-4">

                <button class="btn-sm border-slate-200 hover:border-slate-300 text-slate-600"
                    wire:click=$set('open',false)>Cancelar</button>

                <button
                    class="btn-sm bg-indigo-500 hover:bg-indigo-600 text-white disabled:border-slate-200 disabled:bg-slate-100 disabled:text-slate-400 disabled:cursor-not-allowed shadow-none"
                    wire:loading.attr="disabled" wire:target="save,foto" wire:click=save()>
                    <svg wire:loading wire:target="save,foto" class="animate-spin w-4 h-4 fill-current shrink-0"
                        viewBox="0 0 16 16">
                        <path
                            d="M8 16a7.928 7.928 0 01-3.428-.77l.857-1.807A6.006 6.006 0 0014 8c0-3.309-2.691-6-6-6a6.006 6.006 0 00-5.422 8.572l-1.806.859A7.929 7.929 0 010 8c0-4.411 3.589-8 8-8s8 3.589 8 8-3.589 8-8 8z">
                        </path>
                    </svg>
                    <span class="ml-2" wire:loading.remove wire:target="save,foto">Guardar</span>
                    <span wire:loading wire:target="save,foto"> cargando </span>

                </button>

            </div>

        </x-slot>
    </x-dialog-modal>


</div>
