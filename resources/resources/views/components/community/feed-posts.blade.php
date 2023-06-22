@props(['foto'=> null])
<!-- Post 2 -->
<div class="bg-white shadow-md rounded border border-slate-200 p-5 mb-8">
    <!-- Header -->
    <header class="flex justify-between items-start space-x-3 mb-3">
        <!-- User -->
        <div class="flex items-start space-x-3">
            
        </div>
        <!-- Menu button -->
        <div class="relative">
            <div class="absolute top-0 right-0 inline-flex" x-data="{ open: false }">
                <button
                    class="text-slate-400 hover:text-slate-500 rounded-full"
                    :class="{ 'bg-slate-100 text-slate-500': open }"
                    aria-haspopup="true"
                    @click.prevent="open = !open"
                    :aria-expanded="open"
                >
                    <span class="sr-only">Menu</span>
                    <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32">
                        <circle cx="16" cy="16" r="2" />
                        <circle cx="10" cy="16" r="2" />
                        <circle cx="22" cy="16" r="2" />
                    </svg>
                </button>
                <div
                    class="origin-top-right z-10 absolute top-full right-0 min-w-36 bg-white border border-slate-200 py-1.5 rounded shadow-lg overflow-hidden mt-1"
                    @click.outside="open = false"
                    @keydown.escape.window="open = false"
                    x-show="open"
                    x-transition:enter="transition ease-out duration-200 transform"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-out duration-200"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    x-cloak
                >
                    <ul>
                        <li>
                            <a class="font-medium text-sm text-slate-600 hover:text-slate-800 flex py-1 px-3" href="#0" @click="open = false" @focus="open = true" @focusout="open = false">Option 1</a>
                        </li>
                        <li>
                            <a class="font-medium text-sm text-slate-600 hover:text-slate-800 flex py-1 px-3" href="#0" @click="open = false" @focus="open = true" @focusout="open = false">Option 2</a>
                        </li>
                        <li>
                            <a class="font-medium text-sm text-rose-500 hover:text-rose-600 flex py-1 px-3" href="#0" @click="open = false" @focus="open = true" @focusout="open = false">Remove</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>                                                
    </header>
    <!-- Body -->
    <div class="text-sm text-slate-800 space-y-2 mb-5">
        <p>Designing an Earth-positive future, together 🌿</p>
        <div class="relative !my-4">
            <img class="block w-full" src="{{ $foto->image_url }}" width="590" height="332" alt="Feed 01" />
            {{-- <div class="absolute left-0 right-0 bottom-0 p-4 bg-black bg-opacity-25 backdrop-blur-md">
                <div class="flex items-center justify-between">
                    <div class="text-xs font-medium text-slate-300">togethernature.com</div>
                    <a class="text-xs font-medium text-indigo-400 hover:text-indigo-300" href="#0">Learn More -&gt;</a>
                </div>
            </div> --}}
        </div>
    </div>
    <!-- Footer -->
    <footer class="flex items-center space-x-4">
        <!-- Like button -->
        <button class="flex items-center text-slate-400 hover:text-indigo-500">
            <svg class="w-4 h-4 shrink-0 fill-current mr-1.5" viewBox="0 0 16 16">
                <path d="M14.682 2.318A4.485 4.485 0 0011.5 1 4.377 4.377 0 008 2.707 4.383 4.383 0 004.5 1a4.5 4.5 0 00-3.182 7.682L8 15l6.682-6.318a4.5 4.5 0 000-6.364zm-1.4 4.933L8 12.247l-5.285-5A2.5 2.5 0 014.5 3c1.437 0 2.312.681 3.5 2.625C9.187 3.681 10.062 3 11.5 3a2.5 2.5 0 011.785 4.251h-.003z" />
            </svg>
            <div class="text-sm text-slate-500">4</div>
        </button>
        <!-- Share button -->
        <button class="flex items-center text-slate-400 hover:text-indigo-500">
            <svg class="w-4 h-4 shrink-0 fill-current mr-1.5" viewBox="0 0 16 16">
                <path d="M13 7h2v6a1 1 0 0 1-1 1H4v2l-4-3 4-3v2h9V7ZM3 9H1V3a1 1 0 0 1 1-1h10V0l4 3-4 3V4H3v5Z" />
            </svg>
            <div class="text-sm text-slate-500">44</div>
        </button>
        <!-- Replies button -->
        <button class="flex items-center text-slate-400 hover:text-indigo-500">
            <svg class="w-4 h-4 shrink-0 fill-current mr-1.5" viewBox="0 0 16 16">
                <path d="M8 0C3.6 0 0 3.1 0 7s3.6 7 8 7h.6l5.4 2v-4.4c1.2-1.2 2-2.8 2-4.6 0-3.9-3.6-7-8-7zm4 10.8v2.3L8.9 12H8c-3.3 0-6-2.2-6-5s2.7-5 6-5 6 2.2 6 5c0 2.2-2 3.8-2 3.8z" />
            </svg>
            <div class="text-sm text-slate-500">7</div>
        </button>
    </footer>
</div>

