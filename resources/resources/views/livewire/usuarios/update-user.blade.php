<div>
    

    <x-dialog-modal wire:model="open">

        <x-slot name="title">
            Actualizar Usuario
        </x-slot>

        <x-slot name="content">
            <div class="px-4 ">

                <label for="">
                    Foto de Perfil<span class="text-rose-500">*</span>
                </label>

                <div class="flex items-center">
                    <div class="m-3">

                        @if ($foto)

                            <img class="h-24 w-24 rounded-full" src="{{ $foto->temporaryUrl() }}" alt="">

                        @else
                            
                            <img class="h-24 w-24 rounded-full"
                                src="{{ asset('storage/' . $usuario->profile_photo_path) }}" alt="">

                        @endif
                    </div>

                    <x-input type="file" class="w-full" wire:model="foto" />

                </div>
                <div class="mb-3">
                    <x-input-error for="foto" />
                </div>



                <div class="mb-4">
                    <label class="" for="">
                        Nombre <span class="text-rose-500">*</span>
                    </label>

                    <x-input type="text" class=" w-full " wire:model="usuario.name" />
                    <x-input-error for="usuario.name" />

                </div>


                <div class="mb-4">
                    <label for="">
                        email <span class="text-rose-500">*</span>
                    </label>
                    <x-input type="email" class="w-full" wire:model="usuario.email" />
                    <x-input-error for="usuario.email" />

                </div>

                <div class="mb-4">
                    <label for="">
                        password<span class="text-rose-500">*</span>
                    </label>
                    <x-input type="password" class="w-full" wire:model="pass" />
                    <x-input-error for="pass" />

                </div>

                <div class="mb-4">
                    <label class="mr4" for="">
                         Tipo de Usuario<span class="text-rose-500">*</span>
                    </label>

                    <select class="form-select w-full" wire:model="rol">
                        <option value="{{ $rol }}"></option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name}}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="rol" />

                </div>


            </div>

        </x-slot>

        <x-slot name="footer">
            <div class="mr-4">

                <button class="btn-sm border-slate-200 hover:border-slate-300 text-slate-600"
                    wire:click=open()>Cancelar</button>

                <button
                    class="btn-sm bg-indigo-500 hover:bg-indigo-600 text-white disabled:border-slate-200 disabled:bg-slate-100 disabled:text-slate-400 disabled:cursor-not-allowed shadow-none"
                    wire:loading.attr="disabled" wire:target="save,foto" wire:click=save()>
                    <svg wire:loading wire:target="save,foto" class="animate-spin w-4 h-4 fill-current shrink-0"
                        viewBox="0 0 16 16">
                        <path
                            d="M8 16a7.928 7.928 0 01-3.428-.77l.857-1.807A6.006 6.006 0 0014 8c0-3.309-2.691-6-6-6a6.006 6.006 0 00-5.422 8.572l-1.806.859A7.929 7.929 0 010 8c0-4.411 3.589-8 8-8s8 3.589 8 8-3.589 8-8 8z">
                        </path>
                    </svg>
                    <span class="ml-2" wire:loading.remove wire:target="save,foto">Actualizar</span>
                    <span wire:loading wire:target="save,foto"> cargando </span>

                </button>

            </div>

        </x-slot>
    </x-dialog-modal>

</div>
