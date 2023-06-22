<div>
    <textarea name="original" id="text-area-1" cols="100" rows="15" hidden>{{ $diagram->diagram_json_copy }}</textarea>
    <textarea name="copia" id="text-area-2" cols="100" rows="15" hidden>{{ $diagram->diagram_json_copy }}</textarea>
    <textarea name="original_bd" id="text-area-3" cols="30" rows="10" hidden>{{ $diagram->diagram_json }}</textarea>
    <input type="hidden" id="id_diagram" value="{{ $diagram->id }}">
    <button type="hidden" id="btn-1" hidden>Boton para Socket</button>
    <button type="hidden" id="btn-render" hidden class="rounded-full p-2 bg-red-500">Renderizado de paper</button>
    <button type="hidden" id="btn-update" hidden>Actualizar Json Copia</button>

    <input type="hidden" id="name_user" value="{{ Auth::user()->name }}" hidden>
    <input type="hidden" id="email_user" value="{{ Auth::user()->email }}" hidden>
</div>