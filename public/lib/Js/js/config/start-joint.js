// Carga del diagrama incial o diagrama guardado
joint.setTheme('modern');
app = new App.MainView({ el: '#app' });
themePicker = new App.ThemePicker({ mainView: app });
themePicker.render().$el.appendTo(document.body);

// Variables globales de los textarea
 txt_original = document.getElementById("text-area-1")
txt_copy = document.getElementById("text-area-2")
id_diagram = document.getElementById("id_diagram")
txt_original_bd = document.getElementById('text-area-3')

window.addEventListener('load', function () {
    setTimeout(function () {
        var page = document.getElementById("loader-page")

        page.style.visibility = "hidden"
        page.style.opacity = "0"
    }, 1000);

    app.graph.fromJSON(JSON.parse(txt_original.value));
    txt_copy.value = txt_original.value
});

const render = document.getElementById('btn-render')
const update = document.getElementById('btn-update')

// Cambios enn el paper
render.addEventListener('click', () => {
    console.log("renderizando");
    if (txt_original.value != txt_copy.value) {
        app.paper.model.fromJSON(JSON.parse(document.getElementById("text-area-2").value))

        txt_copy.value = txt_original.value;
    }
    
});

// Actulizar JSON copia en la BD
update.addEventListener('click', () => {
    console.log("Captando movimiento");
    Livewire.emit('updateDiagram', id_diagram.value, txt_original.value)
}); 




// The application was open locally using the file protocol.
(function () {
    var fs = (document.location.protocol === 'file:');
    var ff = (navigator.userAgent.toLowerCase().indexOf('firefox') !== -1);
    if (fs && !ff) {
        (new joint.ui.Dialog({
            width: 300,
            type: 'alert',
            title: 'Local File',
            content: $('#message-fs').show()
        })).open();
    }
})();