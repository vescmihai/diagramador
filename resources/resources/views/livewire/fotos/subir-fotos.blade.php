<div class="mb-4">

    {{-- <a  wire:click=$set('open',true)
        class="flex flex-row justify-center gap-2 btn-sm w-full bg-indigo-500 hover:bg-indigo-600 text-white" href="#">
        <svg class="w-4 h-4 fill-current opacity-50 shrink-0" viewBox="0 0 16 16">
            <path
                d="M15 7H9V1c0-.6-.4-1-1-1S7 .4 7 1v6H1c-.6 0-1 .4-1 1s.4 1 1 1h6v6c0 .6.4 1 1 1s1-.4 1-1V9h6c.6 0 1-.4 1-1s-.4-1-1-1z" />
        </svg>
            Añadir Foto
    </a> --}}
    
    <x-dialog-modal wire:model=open>

        <x-slot name="title">
           Subir Foto
        </x-slot>

        <x-slot name="content">
            <div class="px-4 ">

                <label for="">
                    Foto 
                </label>

          
                    <div class="m-3">

                       @if ($foto)
                    <img class="w-full h-96" src="{{ $foto->temporaryUrl() }}" alt="">
               
                    @endif
                    </div>

                    <x-input type="file" id="imagen" class="w-full" wire:model="foto" />
                    {{-- <form wire:submit.prevent="save" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="imagen[]" id="imagen" wire:model="foto">
                        <button type="submit" class="px-2 py-1 bg-red-600" wire:click=''>Guardar</button>
                    </form> --}}

               
                <div class="mb-3">
                    <x-input-error for="foto" />
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

    <button hidden id="btnNotificaciones" class="">
        <i class="fa-solid fa-bell"></i> Notificar </button>

    @push('js')
        
    
        <script src="{{ asset('js/face-api.min.js') }}" type="text/javascript"></script>
    
    <script>
        Livewire.on('face-api', (usuarios) => {

            console.log(usuarios);
            const imageUpload = document.getElementById('imagen')
            const btnNotificaciones = document.getElementById('btnNotificaciones')


            //cargo los modelos de FACEAPI cuanndo la funcion start comience
            Promise.all([
                faceapi.nets.faceRecognitionNet.loadFromUri('/models'),
                faceapi.nets.faceLandmark68Net.loadFromUri('/models'),
                faceapi.nets.ssdMobilenetv1.loadFromUri('/models'),
            ]).then(start)

            function loadLabeledImages() {
                //nombre de las carpetas(usuarios)
                const labels = usuarios;
                return Promise.all(
                    labels.map(async label => {
                        const descriptions = [];
                        for (let i = 1; i <= 3; i++) {
                            //console.log(label)
                            const img = await faceapi.fetchImage(`/storage/usuarios/${label}/${i}.jpg`);
                            const detections = await faceapi.detectSingleFace(img).withFaceLandmarks()
                                .withFaceDescriptor();
                            descriptions.push(detections.descriptor);
                            //console.log(label, descriptions)
                        }

                        return new faceapi.LabeledFaceDescriptors(label, descriptions);
                    })
                )
            }



            async function start() {

                //obtengo los nombres de las caras de las imagenes del servidor
                const labeledFaceDescriptors = await loadLabeledImages();
                console.log(labeledFaceDescriptors);
                //console.log(labeledFaceDescriptors)

                //que tenga una presicion arriba de 60%
                const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors, 0.6);
                console.log(faceMatcher);

                console.log('Listo');
                btnNotificaciones.addEventListener('click', async () => {

                    //obtengo la imagen subida en el input
                    resultados = [];
                    for (i = 0; i < imageUpload.files.length; i++) {
                        image = await faceapi.bufferToImage(imageUpload.files[i]);
                        const displaySize = {
                            width: image.width,
                            height: image.height
                        };
                        //detecta todas las caras de la imagagen del input
                        const detections = await faceapi.detectAllFaces(image).withFaceLandmarks()
                            .withFaceDescriptors();

                        const resizedDetections = faceapi.resizeResults(detections, displaySize);

                        //las coincidencias
                        const results = resizedDetections.map(d => faceMatcher.findBestMatch(d
                            .descriptor));

                        resultados.push(results);
                    }
                    console.log(resultados);
                    idusuarios = []
                    for (i = 0; i < resultados.length; i++) {
                        let result = resultados[i];
                        for (j = 0; j < result.length; j++) {
                            //console.log(result[j].label)
                            idusuarios.push(result[j].label);
                        };
                    }
                    console.log(idusuarios);
                    Livewire.emitTo('fotos.subir-fotos','notiAparecesFoto', idusuarios);
                })
                btnNotificaciones.click()


            }


        });
    </script>
    @endpush
</div>
