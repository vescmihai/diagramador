<div x-data="{ tipoUsuario: '', modelOpen: false }">
    <template x-if="tipoUsuario === '3'">
        <div class="mb-3">
            <label class="mb-2" for="">
                Fotos Adicionales <span class="text-rose-500"> *</span>
            </label>
            <x-button class="flex items-center justify-center" type="button" @click="modelOpen =!modelOpen">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>

                <span>Agregar fotos</span>
            </x-button>

            <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                    <div x-cloak @click="modelOpen = false" x-show="modelOpen" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"></div>

                    <div x-cloak x-show="modelOpen" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
                        <div class="flex items-center justify-between space-x-4">
                            <h1 class="text-xl font-medium text-indigo-800 ">Subir Fotos</h1>

                            <button type="button" @click="modelOpen =!modelOpen" class="text-gray-600 focus:outline-none hover:text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                        </div>

                        <p class="mt-2 text-sm text-gray-500 ">
                            Estas tres fotos son obligatorias para poder registrarte como cliente
                            ya que son necesarias para el funcionamiento de la aplicacion
                        </p>

                        <div class="mt-4">
                            <label for="email" class="block text-sm  text-indigo-600 capitalize dark:text-gray-200">foto1</label>
                            <div class="flex items-center justify-center bg-grey-lighter">
                                <label class="w-64 flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-indigo-400 hover:text-white">
                                    <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                    </svg>
                                    <span class="mt-2 text-base leading-normal">Subir una imagen</span>
                                    <input type='file' class="hidden" name="foto1" accept="img/" />
                                </label>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="email" class="block text-sm text-indigo-600 capitalize dark:text-gray-200">foto2</label>
                            <div class="flex items-center justify-center  bg-grey-lighter">
                                <label class="w-64 flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-indigo-400 hover:text-white">
                                    <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                    </svg>
                                    <span class="mt-2 text-base leading-normal">Subir una imagen</span>
                                    <input type='file' class="hidden" name="foto2" accept="img/" />
                                </label>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="email" class="block text-sm  text-indigo-600 capitalize dark:text-gray-200">foto3</label>
                            <div class="flex items-center justify-center bg-grey-lighter">
                                <label class="w-64 flex flex-col items-center px-4 py-6 bg-white text-blue rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-indigo-400 hover:text-white">
                                    <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                    </svg>
                                    <span class="mt-2 text-base leading-normal">Subir una imagen</span>
                                    <input type='file' class="hidden" name="foto3" accept="img/" />
                                </label>
                            </div>
                        </div>


                        <div class="flex justify-end ">
                            <button @click="modelOpen =!modelOpen" type="button" class="px-3 py-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                                Aceptar
                            </button>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </template>
    <div>
        <label class="mb-2" for="">
            Tipo de Usuario<span class="text-rose-500"> *</span>
        </label>

        <select x-model="tipoUsuario" class="flex w-3/4  border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="rol">
            <option class="hover:bg-indigo-400" value=""></option>
            <option class="hover:bg-indigo-400" value="2">Organizador</option>
            <option class="hover:bg-indigo-400" value="3">Cliente</option>
            <option class="hover:bg-indigo-400" value="4">Fotografo</option>

        </select>
        <x-input-error for="rol" />
    </div>

</div>