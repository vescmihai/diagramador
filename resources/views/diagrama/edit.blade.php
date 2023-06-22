@section('title', 'Diagramas')
@section('script-css')

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="{{ asset('buildjs/package/rappid.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/Js/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/Js/css/theme-picker.css') }}">

    <!-- theme-specific application CSS  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/Js/css/style.dark.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/Js/css/style.material.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/Js/css/style.modern.css') }}">

    {{-- <link rel="stylesheet" href="{{ asset('css/loader-page.css') }}"> --}}
    <script defer src="{{ asset('js/prueba.js') }}" type="text/javascript"></script>



    {{-- Socket IO --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.5.1/socket.io.js"
        integrity="sha512-9mpsATI0KClwt+xVZfbcf2lJ8IFBAwsubJ6mI3rtULwyM3fBmQFzj0It4tGqxLOGQwGfJdk/G+fANnxfq9/cew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="importmap">
            {
              "imports": {
                "socket.io-client": "https://cdn.socket.io/4.4.1/socket.io.esm.min.js"
              }
            }
    </script>
    <script type="module">
        import { io } from "socket.io-client";

         const socket = io("http://127.0.0.1:3000/", {
             transports: ["websocket"]
         });

        /* const socket = io("http://44.202.92.222:3000/", {
            transports: ["websocket"]
        }); */

        // const socket = io("https://diagram-socket.herokuapp.com/", {
        //     transports: ["websocket"]
        // });

        const id = document.getElementById('id_diagram').value
        const name_user = document.getElementById('name_user').value
        const email_user = document.getElementById('email_user').value
        const btn = document.querySelector('#btn-1')
        
        const btn2 = document.getElementById('btn')
        const audio = document.getElementById('audio')
        

        btn2.addEventListener('click', () => {
            audio.play();
        })

        const data_user = [name_user, email_user, id]
        socket.emit('join-room', id, data_user);

        btn.addEventListener('click', () => {
            socket.emit('diagram', document.getElementById("text-area-1").value, id);
        });

        // Escucha los movimientos del diagrama 
        socket.on('return-diagram', (data) => {
            //console.log(data);
            document.getElementById('text-area-2').value = data;
            document.querySelector('#btn-render').click();
        });

        // Indica el usuario conectado
        socket.on('new-connection-user', (users) => {
            document.getElementById('btn').click()
            let Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })

            Toast.fire({
            icon: 'success',
            title: users[0] + ' ha entrado a la sala...'
            })
        })

        socket.on('new-desconnection-user', (user_name) => {
            let Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
            icon: 'success',
            title: user_name + ' se ha desconectado...'
            })
        })

        // Escucha de nuevos usuarios conectados
        socket.on('new-connection', (users) => {
            const divPadre = document.getElementById('collaborators')
            divPadre.innerHTML = ''

            for (var i = 0; i < users.length; i++) {
                if (users[i][2] == id) {
                    let divUser = document.createElement("div")
                    divUser.classList.add('flex', 'p-3', 'text-sm','rounded-lg', 'text-gray-700', 'bg-gray-300', 'border-gray-400', 'border-2', 'shadow-md', 'hover:shadow-lg', 'mx-3', 'mb-4')
                    
                    let imgUser = document.createElement("img")
                    imgUser.classList.add('rounded-full')
                    imgUser.src = "https://media.tycsports.com/files/2022/06/14/440404/las-20-mejores-fotos-de-perfil-para-tu-cuenta-de-free-fire_w416.webp"
                    imgUser.width = 30
                    imgUser.heigth = 30
                    divUser.appendChild(imgUser)

                    let divUserSecond = document.createElement("div")
                    divUserSecond.classList.add('block', 'ml-2')
                    
                    divUserSecond.insertAdjacentHTML("beforeend", `<p class="text-md text-gray-700">${users[i][0]}</p>`)

                    divUserSecond.insertAdjacentHTML("beforeend", `<p class="text-xs text-gray-500">${users[i][1]}</p>`)

                    divUser.appendChild(divUserSecond)

                    divPadre.appendChild(divUser)
                }
            }
        })

        function cutString(word) {
            var result_word, count_space = 0
            var index

            for (var i = 0; i < word.length; i++) {
                if (word[i] == ' ') {
                    count_space = count_space + 1
                    if (count_space == 2) {
                        index = i
                        break
                    }
                    
                }
            }

            if (!index)
                return word
            return word.substr(0, index)
        } 

        // Conexion del cliente al servidor
        // const socket = io("https://react-socket-server-tjms.herokuapp.com/", {
        //     transports: ["websocket"]
        // });
    </script>
@endsection

<x-app-layout>
    {{-- <div id="loader-page" class="loader-page"></div> --}}

    <div id="app">
        <div class="app-header">
            <div class="app-title">
                <h1>My Diagram</h1>
            </div>
            <div class="toolbar-container"></div>
        </div>
        <div class="app-body">
            <div class="stencil-container"></div>
            <div class="paper-container"></div>
            <div class="inspector-container"></div>
            <div class="navigator-container"></div>
            <div class="collaborators-container overflow-y-auto">
                <div class="flex w-full bg-gray-300" style="height: 12%">
                    <i class="fa-solid fa-user text-lg mx-3"></i>
                    <h1 class="text-black text-lg">Colaboradores</h1>
                    <audio src="{{ asset('notify.mp3') }}" id="audio" hidden></audio>
                    <button id="btn" hidden>Button</button>
                </div>
                <div class="w-full bg-gray-200 my-0" style="min-height: 88%">
                    <h1 class="font-sans p-2"><i class="fa-solid fa-circle text-green-500 mx-2"></i>Conectados</h1>
                    <div class="mt-3" id="collaborators"></div>
                </div>
            </div>
        </div>
        @livewire('diagrama.diagram-update', ['diagram' => $diagram])

        <input type="hidden" id="name_user" value="{{ Auth::user()->name }}">
    </div>

    <script></script>

    <!-- JointJS+ dependencies: -->
    <script src="{{ asset('lib/node_modules/jquery/dist/jquery.js') }}"></script>
    <script src="{{ asset('lib/node_modules/lodash/lodash.js') }}"></script>
    <script src="{{ asset('lib/node_modules/backbone/backbone.js') }}"></script>
    <script src="{{ asset('lib/node_modules/graphlib/dist/graphlib.core.js') }}"></script>
    <script src="{{ asset('lib/node_modules/dagre/dist/dagre.core.js') }}"></script>

    <script src="{{ asset('buildjs/package/rappid.js') }}"></script>

    <!--[if IE 9]>
        <script>
            // `-ms-user-select: none` doesn't work in IE9
            document.onselectstart = function() {
                return false;
            };
        </script>
    <![endif]-->

    <!-- Application files:  -->
    <script src="{{ asset('lib/Js/js/config/halo.js') }}"></script>
    <script src="{{ asset('lib/Js/js/config/selection.js') }}"></script>
    <script src="{{ asset('lib/Js/js/config/inspector.js') }}"></script>
    <script src="{{ asset('lib/Js/js/config/stencil.js') }}"></script>
    <script src="{{ asset('lib/Js/js/config/toolbar.js') }}"></script>
    <script src="{{ asset('lib/Js/js/config/sample-graphs.js') }}"></script>
    <script src="{{ asset('lib/Js/js/views/main.js') }}"></script>
    <script src="{{ asset('lib/Js/js/views/theme-picker.js') }}"></script>
    <script src="{{ asset('lib/Js/js/models/joint.shapes.app.js') }}"></script>
    <script src="{{ asset('lib/Js/js/views/navigator.js') }}"></script>  

    <!-- Local file warning: -->
    <div id="message-fs" style="display: none;">
        <p>The application was open locally using the file protocol. It is recommended to access it trough a <b>Web
                server</b>.</p>
        <p>Please see <a href="README.md">instructions</a>.</p>
    </div>

    <script src="{{ asset('js/prevent-reload.js') }}"></script>

    @push('js')
        <script src="{{ asset('lib/Js/js/config/start-joint.js') }}"></script>
    @endpush
</x-app-layout>
