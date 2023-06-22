import { dia, setTheme, shapes, ui, linkTools } from "@clientio/rappid";
import { Table, Link } from "./shapes";
import { anchorNamespace } from "./anchors";
import { routerNamespace } from "./routers";
import { TableHighlighter, LinkHighlighter } from "./highlighters";

export const init = () => {
    const appEl = document.getElementById("app");
    const canvasEl = document.querySelector(".canvas");
    /*  const btn = document.querySelector('#btn'); */

    // Variables globales de los textarea
    let txt_original = document.getElementById("text-area-1");
    let txt_copy = document.getElementById("text-area-2");
    let id_diagram = document.getElementById("id_diagram");
    let txt_original_bd = document.getElementById("text-area-3");

    let btnSocket = document.getElementById("btn-1");
    let render = document.getElementById("btn-render");
    let update = document.getElementById("btn-update");

    setTheme("my-theme");

    const graph = new dia.Graph({}, { cellNamespace: shapes });

    const paper = new dia.Paper({
        model: graph,
        width: 1000,
        height: 800,
        gridSize: 20,
        interactive: true,
        defaultConnector: { name: "rounded" },
        async: true,
        frozen: true,
        sorting: dia.Paper.sorting.APPROX,
        cellViewNamespace: shapes,
        routerNamespace: routerNamespace,
        defaultRouter: { name: "customRouter" },
        anchorNamespace: anchorNamespace,
        defaultAnchor: { name: "customAnchor" },
        snapLinks: true,
        linkPinning: false,
        magnetThreshold: "onleave",
        highlighting: {
            connecting: {
                name: "addClass",
                options: {
                    className: "column-connected",
                },
            },
        },
        defaultLink: () => new Link(),
        validateConnection: function (srcView, srcMagnet, tgtView, tgtMagnet) {
            return srcMagnet !== tgtMagnet;
        },
    });

    const scroller = new ui.PaperScroller({
        paper,
        cursor: "grab",
        baseWidth: 100,
        baseHeight: 100,
        inertia: { friction: 0.8 },
        autoResizePaper: true,
        contentOptions: function () {
            return {
                useModelGeometry: true,
                allowNewOrigin: "any",
                padding: 40,
                allowNegativeBottomRight: true,
            };
        },
    });

    canvasEl.appendChild(scroller.el);
    scroller.render().center();

    /* const users = new Table()
        .setName('users')
        .setTabColor('#6495ED')
        .position(170, 220)
        .setColumns([
            { name: 'id', type: 'int', key: true },
            { name: 'full_name', type: 'varchar' },
            { name: 'created_at', type: 'datetime' },
            { name: 'country_code', type: 'int' }
        ])
        .addTo(graph);


    const orders = new Table()
        .setName('orders')
        .setTabColor('#008B8B')
        .position(570, 140)
        .setColumns([
            { name: 'user_id', type: 'int', key: true },
            { name: 'status', type: 'varchar' },
            { name: 'product_id', type: 'int' },
            { name: 'created_at', type: 'datetime' }
        ])
        .addTo(graph);


    const countries = new Table()
        .setName('countries')
        .setTabColor('#CD5C5C')
        .position(170, 540)
        .setColumns([
            { name: 'code', type: 'int', key: true },
            { name: 'name', type: 'varchar' }
        ])
        .addTo(graph);


    const products = new Table()
        .setName('products')
        .setTabColor('#FFD700')
        .position(570, 440)
        .setColumns([
            { name: 'id', type: 'int', key: true },
            { name: 'name', type: 'varchar' },
            { name: 'price', type: 'int' },
            { name: 'status', type: 'varchar' },
            { name: 'created_at', type: 'datetime' }
        ])
        .addTo(graph);

    
    const links = [
        new Link({
            source: { id: users.id, port: 'id' },
            target: { id: orders.id, port: 'user_id' }
        }),
        new Link({
            source: { id: users.id, port: 'country_code' },
            target: { id: countries.id, port: 'code' }
        }),
        new Link({
            source: { id: orders.id, port: 'product_id' },
            target: { id: products.id, port: 'id' }
        }),

    
    ];

    links.forEach((link) => {
        link.addTo(graph);
    }); */

    // Register events
    /* paper.on('link:mouseenter', (linkView) => {
        //console.log(linkView);
        showLinkTools(linkView);
    }); */

    paper.on("link:pointerclick", (linkView) => {
        editLink(linkView);
    });

    paper.on("link:mouseleave", (linkView) => {
        linkView.removeTools();
    });

    paper.on("blank:pointerdown", (evt) => scroller.startPanning(evt));

    paper.on("blank:mousewheel", (evt, ox, oy, delta) => {
        evt.preventDefault();
        zoom(ox, oy, delta);
    });
    paper.on("cell:mousewheel", (_, evt, ox, oy, delta) => {
        evt.preventDefault();
        zoom(ox, oy, delta);
    });
    function zoom(x, y, delta) {
        scroller.zoom(delta * 0.2, {
            min: 0.4,
            max: 3,
            grid: 0.2,
            ox: x,
            oy: y,
        });
    }

    paper.on("element:pointerclick", (elementView) => {
        //console.log(elementView);
        editTable(elementView);
    });

    paper.on("blank:pointerdblclick", (evt, x, y) => {
        const table = new Table();
        table.position(x, y);
        table.setColumns([
            {
                name: "id",
                type: "int",
            },
        ]);
        table.addTo(graph);
        editTable(table.findView(paper));

        txt_original.value = JSON.stringify(graph.toJSON());
        btnSocket.click();
        update.click();
    });

    /* paper.on('change', (elementView) => {
        console.log('Hubo un cambio en el diagrama');
        txt_original.value = JSON.stringify(graph.toJSON());
        btnSocket.click();
        update.click();
    });
 */
    graph.on("change:attrs", function (cell) {
        console.log("se cambio los atributos");
        txt_original.value = JSON.stringify(graph.toJSON());
        btnSocket.click();
        update.click();
    });

    /* graph.on('change', function(cell, opt) {
        console.log('Hubo un cambio en el diagrama');
        console.log(cell);
        console.log(opt);
        txt_original.value = JSON.stringify(graph.toJSON());
        btnSocket.click();
        update.click();
    }); */

    graph.on("change:columns", function (cell) {
        console.log("se cambio los atributos");
        txt_original.value = JSON.stringify(graph.toJSON());
        btnSocket.click();
        update.click();
    });

    graph.on("change:position", function (cell) {
        console.log("se cambio los posicion");
        txt_original.value = JSON.stringify(graph.toJSON());
        btnSocket.click();
        update.click();
        console.log(graph.toJSON());
    });

    graph.on("change:labels", function (cell) {
        console.log("se cambio los labels de los links");
        console.log(graph.toJSON());
        txt_original.value = JSON.stringify(graph.toJSON());
        btnSocket.click();
        update.click();
    });

    graph.on("remove", function (cell) {
        console.log("se eliminó un elemento");
        console.log(graph.toJSON());
        txt_original.value = JSON.stringify(graph.toJSON());
        btnSocket.click();
        update.click();
    });

    paper.unfreeze();

    // Actions
    function showLinkTools(linkView) {
        const tools = new dia.ToolsView({
            tools: [
                new linkTools.Remove({
                    distance: "50%",
                    markup: [
                        {
                            tagName: "circle",
                            selector: "button",
                            attributes: {
                                r: 7,
                                fill: "#f6f6f6",
                                stroke: "#ff5148",
                                "stroke-width": 2,
                                cursor: "pointer",
                            },
                        },
                        {
                            tagName: "path",
                            selector: "icon",
                            attributes: {
                                d: "M -3 -3 3 3 M -3 3 3 -3",
                                fill: "none",
                                stroke: "#ff5148",
                                "stroke-width": 2,
                                "pointer-events": "none",
                            },
                        },
                    ],
                }),
                new linkTools.SourceArrowhead(),
                new linkTools.TargetArrowhead(),
            ],
        });
        linkView.addTools(tools);
    }

    function editTable(tableView) {
        const HIGHLIGHTER_ID = "table-selected";
        const table = tableView.model;
        const tableName = table.getName();
        if (TableHighlighter.get(tableView, HIGHLIGHTER_ID)) return;

        TableHighlighter.add(tableView, "root", HIGHLIGHTER_ID);

        const inspector = new ui.Inspector({
            cell: table,
            theme: "default",
            inputs: {
                "attrs/tabColor/fill": {
                    label: "Color",
                    type: "color",
                },
                "attrs/headerLabel/text": {
                    label: "Name",
                    type: "text",
                },
                columns: {
                    label: "Columns",
                    type: "list",
                    addButtonLabel: "Add Column",
                    removeButtonLabel: "Remove Column",
                    item: {
                        type: "object",
                        properties: {
                            name: {
                                label: "Name",
                                type: "text",
                            },

                            type: {
                                label: "Type",
                                type: "select",
                                options: [
                                    "char",
                                    "varchar",
                                    "int",
                                    "datetime",
                                    "timestamp",
                                    "boolean",
                                    "enum",
                                    "uniqueidentifier",
                                ],
                            },
                            /* others:{
                                label: 'Methods',
                                type: 'text'
                            }, */
                            key: {
                                label: "Key",
                                type: "toggle",
                            },
                        },
                    },
                },
            },
        });

        inspector.render();
        inspector.el.style.position = "relative";

        const dialog = new ui.Dialog({
            theme: "default",
            modal: false,
            draggable: true,
            closeButton: false,
            width: 300,
            title: tableName || "New Table*",
            content: inspector.el,
            buttons: [
                {
                    content: "Remove",
                    action: "remove",
                    position: "left",
                },
                {
                    content: "Close",
                    action: "close",
                },
            ],
        });

        dialog.open(appEl);

        const dialogTitleBar = dialog.el.querySelector(".titlebar");
        const dialogTitleTab = document.createElement("div");
        dialogTitleTab.style.background = table.getTabColor();
        dialogTitleTab.setAttribute("class", "titletab");
        dialogTitleBar.appendChild(dialogTitleTab);

        inspector.on("change:attrs/tabColor/fill", () => {
            dialogTitleTab.style.background = table.getTabColor();
        });
        inspector.on("change:attrs/headerLabel/text", () => {
            dialogTitleBar.textContent = table.getName();
        });

        dialog.on("action:close", () => {
            inspector.remove();
            TableHighlighter.remove(tableView, HIGHLIGHTER_ID);
        });
        dialog.on("action:remove", () => {
            dialog.close();
            table.remove();
        });

        if (!tableName) {
            const inputEl = inspector.el.querySelector(
                'input[data-attribute="attrs/headerLabel/text"]'
            );
            inputEl.focus();
        }
    }

    function editLink(linkView) {
        const link = linkView.model;

        const inspector = new ui.Inspector({
            cell: link,
            theme: "default",
            inputs: {
                labels: {
                    label: "Labels",
                    type: "list",
                    item: {
                        type: "object",
                        properties: {
                            fuente: {
                                label: "source",
                                type: "select",
                                options: ["origen", "destino"],
                            },

                            attrs: {
                                text: {
                                    text: {
                                        label: "Multiplicidad",
                                        type: "select",
                                        options: ["1", "0..*", "1..*", "*"],
                                    },
                                },
                            },
                        },
                    },
                },
            },
        });

        /*         const inspector = new ui.Inspector({
            cell: link,
            theme: 'default',
            inputs: {
                    'labels': {
                    label: 'labels',
                    type: 'list',
                    addButtonLabel: 'Add Column',
                    removeButtonLabel: 'Remove Label',
                    item: {
                        type: 'object',
                        properties: {

                            attrs: {
                                text: {
                                    text: {
                                        label: 'Multiplicidad',
                                        type: 'select',
                                        options: [
                                            '1',
                                            '0..*',
                                            '1..*',
                                            '*',
                                        ]
                                    }
                                }

                            }


                        }
                    }
                }
            }
        });
 */
        inspector.render();
        inspector.el.style.position = "relative";

        const dialog = new ui.Dialog({
            theme: "default",
            modal: false,
            draggable: true,
            closeButton: false,
            width: 300,
            title: "Edit Link",
            content: inspector.el,
            buttons: [
                {
                    content: "Remove",
                    action: "remove",
                    position: "left",
                },
                {
                    content: "Close",
                    action: "close",
                },
            ],
        });

        dialog.open(appEl);

        /* inspector.on('change:labels', (event, path, newValue) => {
            const labelIndex = parseInt(path.split('.')[1]);
            console.log(labelIndex);
            const labels = link.labels();
            if (labelIndex >= 0 && labelIndex < labels.length) {

                labels[labelIndex].attrs.text.text = newValue;
                link.labels(labels);
                link.addTo(graph);
            }
            console.log('se cambio el label');
        }); */

        dialog.on("action:close", () => {
            inspector.remove();
            //LinkHighlighter.remove(linkView, HIGHLIGHTER_ID);
        });

        dialog.on("action:remove", () => {
            dialog.close();
            link.remove();
        });
    }

    window.addEventListener("load", function () {
        /* setTimeout(function () {
        var page = document.getElementById("loader-page")

        page.style.visibility = "hidden"
        page.style.opacity = "0"
    }, 1000); */

        /* txt_original.value = JSON.stringify(graph.toJSON());
    
    btnSocket.click();
    update.click(); */
        graph.fromJSON(JSON.parse(txt_original.value));
        txt_copy.value = txt_original.value;
    });

    // Cambios en el paper
    render.addEventListener("click", () => {
        console.log("renderizando");
        if (txt_original.value != txt_copy.value) {
            graph.fromJSON(JSON.parse(txt_copy.value));
            txt_original.value = txt_copy.value;
        }

        /* console.log(graph.toJSON()); */
    });

    // Actulizar JSON copia en la BD
    update.addEventListener("click", () => {
        console.log("Captando movimiento");
        Livewire.emit("updateDiagram", id_diagram.value, txt_original.value);
    });

    const btn_guardar = document.getElementById("btn-guardar");

    btn_guardar.addEventListener("click", function () {
        console.log("CLick guardar");

        txt_original_bd.value = txt_original.value;

        Livewire.emit("saveChanges", id_diagram.value, txt_original.value);
    });

    /* const descargarArchivoSQL = function (contenido, nombreArchivo) {
        const enlace = document.createElement("a");
        const contenidoArchivo = new Blob([contenido], { type: "text/plain" });

        enlace.href = URL.createObjectURL(contenidoArchivo);
        enlace.download = nombreArchivo + ".sql";
        enlace.click();
    }; */



    const btnMySql = document.getElementById("btn-mysql");

    btnMySql.addEventListener("click", () => {
        console.log(graph);

        let json = graph.toJSON();
        let arrayJSON = Object.values(json)[0];
        console.log(arrayJSON);

        let jsonString = JSON.stringify(json);
        let array = JSON.parse(jsonString).cells;
        console.log(array);

        let tablas = [];

        arrayJSON.forEach((currentItem) => {
            if (currentItem.type != "app.Link") {
                let tabla = `CREATE TABLE ${currentItem.attrs.headerLabel.text} (\n`;
                currentItem.columns.forEach((atributo) => {
                    tabla = `${tabla} ${atributo.name} ${atributo.type} NOT NULL,\n`;
                });
                tabla = `${tabla} )`;
                tablas.push(tabla);
            } else {
            }
        });

        let contenido;
        tablas.forEach((currentItem) => {
            contenido += currentItem + "\n";
        });

        console.log(graph.getElements());
        console.log(graph.getLinks());

        let elements = graph.getElements();
        let links = graph.getLinks();

        let relaciones = [];

        if (links != undefined) {
            links.forEach((currentItem) => {
                let linkActual = currentItem.attributes;
                if (currentItem.attributes.labels != undefined) {
                    let idOrigen = linkActual.source.id;
                    let idDestino = linkActual.target.id;
                    let tablaOrigen = "";
                    let tablaDestino = "";

                    elements.forEach((currentItem) => {
                        if (currentItem.id == idOrigen) {
                            tablaOrigen =
                                currentItem.attributes.attrs.headerLabel.text;
                        }
                        if (currentItem.id == idDestino) {
                            tablaDestino =
                                currentItem.attributes.attrs.headerLabel.text;
                        }
                    });

                    let multiplicidadOrigen = "";
                    let multiplicidadDestino = "";
                    let nombreRelacion = "";

                    linkActual.labels.forEach((currentItem) => {
                        if (currentItem.fuente == 'origen') {
                            multiplicidadOrigen = currentItem.attrs.text.text;
                        } else {
                            multiplicidadDestino = currentItem.attrs.text.text;
                        }
                    });

                    if (
                        multiplicidadOrigen == "1" &&
                        multiplicidadDestino == "1"
                    ) {
                        nombreRelacion = "uno a uno";
                    }

                    if (
                        multiplicidadOrigen == "*" &&
                        multiplicidadDestino == "1"
                    ) {
                        nombreRelacion = "uno a muchos origen";
                    }

                    if (
                        (multiplicidadOrigen == "1" &&
                        multiplicidadDestino == "*")
                    ) {
                        nombreRelacion = "uno a muchos destino";
                    }

                    if (
                        multiplicidadOrigen == "*" &&
                        multiplicidadDestino == "*"
                    ) {
                        nombreRelacion = "muchos a muchos";
                    }
                    
                    relaciones.push({tablaOrigen: tablaOrigen, tablaDestino:tablaDestino, nombreRelacion:nombreRelacion});
                }
            });
        }

        relaciones.forEach((currentItem) => {
            if (currentItem.nombreRelacion == "uno a uno") {
                contenido = `${contenido} ALTER TABLE ${currentItem.tablaOrigen} ADD COLUMN ${currentItem.tablaDestino}_id 
                ADD CONSTRAINT ${currentItem.tablaOrigen}_${currentItem.tablaDestino} 
                FOREIGN KEY (${currentItem.tablaDestino}_id) REFERENCES ${currentItem.tablaDestino} (id);\n`;
            }else if(currentItem.nombreRelacion == "uno a muchos origen"){
                contenido = `${contenido} ALTER TABLE ${currentItem.tablaOrigen} 
                ADD COLUMN ${currentItem.tablaDestino}_id 
                ADD CONSTRAINT ${currentItem.tablaOrigen}_${currentItem.tablaDestino} 
                FOREIGN KEY (${currentItem.tablaDestino}_id) REFERENCES ${currentItem.tablaDestino} (id);\n`;
                
            }else if(currentItem.nombreRelacion == "uno a muchos destino"){
                contenido = `${contenido} ALTER TABLE ${currentItem.tablaDestino} ADD COLUMN ${currentItem.tablaOrigen}_id 
                ADD CONSTRAINT ${currentItem.tablaOrigen}_${currentItem.tablaDestino} 
                FOREIGN KEY (${currentItem.tablaOrigen}_id) REFERENCES ${currentItem.tablaOrigen} (id);\n`;
            }else if(currentItem.nombreRelacion == "muchos a muchos"){
                contenido = `${contenido} CREATE TABLE ${currentItem.tablaOrigen}_${currentItem.tablaDestino} (\n 
                    ${currentItem.tablaOrigen}_id INT NOT NULL,\n 
                    ${currentItem.tablaDestino}_id INT NOT NULL,\n 
                    CONSTRAINT ${currentItem.tablaOrigen}_${currentItem.tablaDestino} PRIMARY KEY (${currentItem.tablaOrigen}_id, ${currentItem.tablaDestino}_id),\n 
                    CONSTRAINT ${currentItem.tablaOrigen}_${currentItem.tablaDestino}_${currentItem.tablaOrigen}_fk FOREIGN KEY (${currentItem.tablaOrigen}_id) REFERENCES ${currentItem.tablaOrigen} (id),\n 
                    CONSTRAINT ${currentItem.tablaOrigen}_${currentItem.tablaDestino}_${currentItem.tablaDestino}_fk FOREIGN KEY (${currentItem.tablaDestino}_id) REFERENCES ${currentItem.tablaDestino} (id)\n);\n`;
            }
        });
        const nombreArchivo = "diagrama1";
        /* showPreview(contenido, nombreArchivo); */
        Livewire.emit("open", contenido);

        
    });

};
