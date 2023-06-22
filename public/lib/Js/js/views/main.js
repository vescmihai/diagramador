/*! JointJS+ v3.7.0 - HTML5 Diagramming Framework - TRIAL VERSION

Copyright (c) 2023 client IO

 2023-05-30 


This Source Code Form is subject to the terms of the JointJS+ Trial License
, v. 2.0. If a copy of the JointJS+ License was not distributed with this
file, You can obtain one at https://www.jointjs.com/license
 or from the JointJS+ archive as was distributed by client IO. See the LICENSE file.*/


var App = window.App || {};

(function(joint) {

    'use strict';

    App.MainView = joint.mvc.View.extend({

        className: 'app',

        events: {
            'mouseup input[type="range"]': 'removeTargetFocus',
            'mousedown': 'removeFocus',
            'touchstart': 'removeFocus'
        },

        removeTargetFocus: function(evt) {
            evt.target.blur();
        },

        removeFocus: function(evt) {

            // do not lose focus on right-click
            if (evt.button === 2) return;

            // do not lose focus if clicking current element for a second time
            var activeElement = document.activeElement;
            var target = evt.target;
            if ($.contains(activeElement, target) || (activeElement === target)) return;

            activeElement.blur();
            window.getSelection().removeAllRanges();
        },

        init: function() {

            this.initializePaper();
            this.initializeStencil();
            this.initializeSelection();
            this.initializeToolsAndInspector();
            this.initializeNavigator();
            this.initializeToolbar();
            this.initializeKeyboardShortcuts();
            this.initializeTooltips();
        },

        // Create a graph, paper and wrap the paper in a PaperScroller.
        initializePaper: function() {

            var graph = this.graph = new joint.dia.Graph;

            this.commandManager = new joint.dia.CommandManager({ graph: graph });

            var paper = this.paper = new joint.dia.Paper({
                width: 1000,
                height: 1000,
                gridSize: 10,
                drawGrid: true,
                model: graph,
                defaultLink: new joint.shapes.app.Link,
                defaultConnectionPoint: joint.shapes.app.Link.connectionPoint,
                interactive: { linkMove: false },
                async: true,
                sorting: joint.dia.Paper.sorting.APPROX
            });

            paper.on('blank:contextmenu', (evt) => {
                this.renderContextToolbar({ x: evt.clientX, y: evt.clientY });
            });

            paper.on('cell:contextmenu', (cellView, evt) => {
                this.renderContextToolbar({ x: evt.clientX, y: evt.clientY }, [cellView.model]);
            });

            this.snaplines = new joint.ui.Snaplines({ paper: paper });

            var paperScroller = this.paperScroller = new joint.ui.PaperScroller({
                paper: paper,
                autoResizePaper: true,
                scrollWhileDragging: true,
                cursor: 'grab'
            });

            this.$('.paper-container').append(paperScroller.el);
            paperScroller.render().center();

            paper.on('paper:pan', (evt, tx, ty) => {
                evt.preventDefault();
                paperScroller.el.scrollLeft += tx;
                paperScroller.el.scrollTop += ty;
            });

            paper.on('paper:pinch', (evt, ox, oy, scale) => {
                // the default is already prevented
                const zoom = paperScroller.zoom();
                paperScroller.zoom(zoom * scale, { min: 0.2, max: 5, ox, oy, absolute: true });
            });
        },

        // Create and populate stencil.
        initializeStencil: function() {

            var stencil = this.stencil = new joint.ui.Stencil({
                paper: this.paperScroller,
                snaplines: this.snaplines,
                scaleClones: true,
                width: 240,
                groups: App.config.stencil.groups,
                dropAnimation: true,
                groupsToggleButtons: true,
                search: {
                    '*': ['type', 'attrs/text/text', 'attrs/root/dataTooltip', 'attrs/label/text'],
                    'org.Member': ['attrs/.rank/text', 'attrs/root/dataTooltip', 'attrs/.name/text']
                },
                layout: {
                    columns: 2,
                    marginX: 10,
                    marginY: 10,
                    columnGap: 10,
                    columnWidth: 100,
                    // reset defaults
                    resizeToFit: false,
                    dx: 0,
                    dy: 0
                },
                // Remove tooltip definition from clone
                dragStartClone: function(cell) {
                    return cell.clone().removeAttr('root/dataTooltip');
                }
            });

            this.$('.stencil-container').append(stencil.el);
            stencil.render().load(App.config.stencil.shapes);

            stencil.on('element:drop', function(elementView) {
                this.selection.collection.reset([elementView.model]);
            }, this);
        },

        initializeKeyboardShortcuts: function() {

            this.keyboard = new joint.ui.Keyboard();
            this.keyboard.on({

                'ctrl+c': function() {
                    // Copy all selected elements and their associated links.
                    this.clipboard.copyElements(this.selection.collection, this.graph);
                },

                'ctrl+v': function() {

                    var pastedCells = this.clipboard.pasteCells(this.graph);

                    var elements = pastedCells.filter((cell) => cell.isElement());

                    // Make sure pasted elements get selected immediately. This makes the UX better as
                    // the user can immediately manipulate the pasted elements.
                    this.selection.collection.reset(elements);
                },

                'ctrl+x shift+delete': function() {
                    this.clipboard.cutElements(this.selection.collection, this.graph);
                },

                'delete backspace': function(evt) {
                    evt.preventDefault();
                    this.graph.removeCells(this.selection.collection.toArray());
                },

                'ctrl+z': function() {
                    this.commandManager.undo();
                    this.selection.collection.reset([]);
                },

                'ctrl+y': function() {
                    this.commandManager.redo();
                    this.selection.collection.reset([]);
                },

                'ctrl+a': function() {
                    this.selection.collection.reset(this.graph.getElements());
                },

                'ctrl+plus': function(evt) {
                    evt.preventDefault();
                    this.paperScroller.zoom(0.2, { max: 5, grid: 0.2 });
                },

                'ctrl+minus': function(evt) {
                    evt.preventDefault();
                    this.paperScroller.zoom(-0.2, { min: 0.2, grid: 0.2 });
                },

                'keydown:shift': function(evt) {
                    this.paperScroller.setCursor('crosshair');
                },

                'keyup:shift': function() {
                    this.paperScroller.setCursor('grab');
                }

            }, this);
        },

        initializeSelection: function() {

            this.clipboard = new joint.ui.Clipboard();

            this.selection = new joint.ui.Selection({
                paper: this.paperScroller,
                handles: App.config.selection.handles,
                useModelGeometry: true,
                translateConnectedLinks: joint.ui.Selection.ConnectedLinksTranslation.SUBGRAPH
            });

            this.selection.collection.on('reset add remove', this.onSelectionChange.bind(this));

            // Initiate selecting when the user grabs the blank area of the paper while the Shift key is pressed.
            // Otherwise, initiate paper pan.
            this.paper.on('blank:pointerdown', function(evt, x, y) {

                if (this.keyboard.isActive('shift', evt)) {
                    this.selection.startSelecting(evt);
                } else {
                    this.selection.collection.reset([]);
                    this.paperScroller.startPanning(evt, x, y);
                    this.paper.removeTools();
                }

            }, this);

            // Initiate selecting when the user grabs a cell while shift is pressed.
            this.paper.on('cell:pointerdown element:magnet:pointerdown', (cellView, evt) => {

                if (this.keyboard.isActive('shift', evt)) {
                    cellView.preventDefaultInteraction(evt);
                    this.selection.startSelecting(evt);
                }

            }, this);

            this.paper.on('element:pointerdown', function(elementView, evt) {

                // Select an element if CTRL/Meta key is pressed while the element is clicked.
                if (this.keyboard.isActive('ctrl meta', evt)) {
                    if (this.selection.collection.find(function(cell) { return cell.isLink() })) {
                        // Do not allow mixing links and elements in the selection
                        this.selection.collection.reset([elementView.model]);
                    } else {
                        this.selection.collection.add(elementView.model);
                    }
                }

            }, this);

            this.graph.on('remove', function(cell) {

                // If element is removed from the graph, remove from the selection too.
                if (this.selection.collection.has(cell)) {
                    this.selection.collection.reset(this.selection.collection.models.filter(c => c !== cell));
                }

            }, this);

            this.selection.on('selection-box:pointerdown', function(elementView, evt) {

                // Unselect an element if the CTRL/Meta key is pressed while a selected element is clicked.
                if (this.keyboard.isActive('ctrl meta', evt)) {
                    evt.preventDefault();
                    this.selection.collection.remove(elementView.model);
                }

            }, this);

            this.selection.on('selection-box:pointerup', (elementView, evt) => {

                if (evt.button === 2) {
                    evt.stopPropagation();
                    this.renderContextToolbar({ x: evt.clientX, y: evt.clientY }, this.selection.collection.toArray());
                }

            }, this);
        },

        renderContextToolbar(point, cellsToCopy = []) {
            this.selection.collection.reset(cellsToCopy);
            const contextToolbar = new joint.ui.ContextToolbar({
                target: point,
                root: this.paper.el,
                padding: 0,
                vertical: true,
                anchor: 'top-left',
                tools: [
                    {
                        action: 'copy',
                        content: 'Copy',
                        attrs: {
                            'disabled': cellsToCopy.length === 0
                        }
                    },
                    {
                        action: 'paste',
                        content: 'Paste',
                        attrs: {
                            'disabled': this.clipboard.isEmpty()
                        }
                    }]
            });

            contextToolbar.on('action:copy', () => {
                contextToolbar.remove();

                this.clipboard.copyElements(cellsToCopy, this.graph);
            });

            contextToolbar.on('action:paste', () => {
                contextToolbar.remove();
                const pastedCells = this.clipboard.pasteCellsAtPoint(this.graph, this.paper.clientToLocalPoint(point));

                const elements = pastedCells.filter(cell => cell.isElement());

                // Make sure pasted elements get selected immediately. This makes the UX better as
                // the user can immediately manipulate the pasted elements.
                this.selection.collection.reset(elements);
            });
            contextToolbar.render();
        },

        onSelectionChange: function() {
            var paper = this.paper;
            var selection = this.selection;
            var collection = selection.collection;
            paper.removeTools();
            joint.ui.Halo.clear(paper);
            joint.ui.FreeTransform.clear(paper);
            joint.ui.Inspector.close();
            if (collection.length === 1) {
                var primaryCell = collection.first();
                var primaryCellView = paper.findViewByModel(primaryCell);
                selection.destroySelectionBox(primaryCell);
                this.selectPrimaryCell(primaryCellView);
            } else if (collection.length === 2) {
                collection.each(function(cell) {
                    selection.createSelectionBox(cell);
                });
            }

            document.getElementById("text-area-1").value = JSON.stringify(this.paper.model.toJSON());
            document.querySelector('#btn-1').click();
            document.getElementById('btn-update').click();
        },

        selectPrimaryCell: function(cellView) {
            var cell = cellView.model
            if (cell.isElement()) {
                this.selectPrimaryElement(cellView);
            } else {
                this.selectPrimaryLink(cellView);
            }
            this.createInspector(cell);
        },

        selectPrimaryElement: function(elementView) {

            var element = elementView.model;

            new joint.ui.FreeTransform({
                cellView: elementView,
                allowRotation: false,
                preserveAspectRatio: !!element.get('preserveAspectRatio'),
                allowOrthogonalResize: element.get('allowOrthogonalResize') !== false
            }).render();

            new joint.ui.Halo({
                cellView: elementView,
                handles: App.config.halo.handles,
                useModelGeometry: true
            }).render();
        },

        selectPrimaryLink: function(linkView) {

            var ns = joint.linkTools;
            var toolsView = new joint.dia.ToolsView({
                name: 'link-pointerdown',
                tools: [
                    new ns.Vertices(),
                    new ns.SourceAnchor(),
                    new ns.TargetAnchor(),
                    new ns.SourceArrowhead(),
                    new ns.TargetArrowhead(),
                    new ns.Segments,
                    new ns.Boundary({ padding: 15 }),
                    new ns.Remove({ offset: -20, distance: 40 })
                ]
            });

            linkView.addTools(toolsView);
        },

        createInspector: function(cell) {

            const opts = Object.assign({ cell }, App.config.inspector[cell.get('type')]);

            return joint.ui.Inspector.create('.inspector-container', opts);
        },

        initializeToolsAndInspector: function() {

            this.paper.on({

                'cell:pointerup': function(cellView) {
                    var cell = cellView.model;
                    var collection = this.selection.collection;
                    if (collection.includes(cell)) return;
                    collection.reset([cell]);
                },

                'link:mouseenter': function(linkView) {

                    // Open tool only if there is none yet
                    if (linkView.hasTools()) return;

                    var ns = joint.linkTools;
                    var toolsView = new joint.dia.ToolsView({
                        name: 'link-hover',
                        tools: [
                            new ns.Vertices({ vertexAdding: false }),
                            new ns.SourceArrowhead(),
                            new ns.TargetArrowhead()
                        ]
                    });

                    linkView.addTools(toolsView);
                },

                'link:mouseleave': function(linkView) {
                    // Remove only the hover tool, not the pointerdown tool
                    if (linkView.hasTools('link-hover')) {
                        linkView.removeTools();
                    }
                }

            }, this);

            this.graph.on('change', function(cell, opt) {

                if (!cell.isLink() || !opt.inspector) return;

                var ns = joint.linkTools;
                var toolsView = new joint.dia.ToolsView({
                    name: 'link-inspected',
                    tools: [
                        new ns.Boundary({ padding: 15 }),
                    ]
                });

                cell.findView(this.paper).addTools(toolsView);

            }, this)
        },

        initializeNavigator: function() {

            var navigator = this.navigator = new joint.ui.Navigator({
                width: 240,
                height: 115,
                paperScroller: this.paperScroller,
                zoom: {
                    grid: 0.2,
                    min: 0.2,
                    max: 5
                },
                paperOptions: {
                    async: true,
                    sorting: joint.dia.Paper.sorting.NONE,
                    elementView: joint.shapes.app.NavigatorElementView,
                    linkView: joint.shapes.app.NavigatorLinkView,
                    cellViewNamespace: { /* no other views are accessible in the navigator */ }
                }
            });

            this.$('.navigator-container').append(navigator.el);
            navigator.render();
        },

        initializeToolbar: function() {

            var toolbar = this.toolbar = new joint.ui.Toolbar({
                autoToggle: true,
                groups: App.config.toolbar.groups,
                tools: App.config.toolbar.tools,
                references: {
                    paperScroller: this.paperScroller,
                    commandManager: this.commandManager
                }
            });

            toolbar.on({
                'svg:pointerclick': this.openAsSVG.bind(this),
                'png:pointerclick': this.openAsPNG.bind(this),
                'to-front:pointerclick': this.applyOnSelection.bind(this, 'toFront'),
                'to-back:pointerclick': this.applyOnSelection.bind(this, 'toBack'),
                'layout:pointerclick': this.layoutDirectedGraph.bind(this),
                'snapline:change': this.changeSnapLines.bind(this),
                //'clear:pointerclick': this.graph.clear.bind(this.graph),
                'clear:pointerclick': this.clearPaper.bind(this),
                'print:pointerclick': this.paper.print.bind(this.paper),
                'grid-size:change': this.paper.setGridSize.bind(this.paper)
            });

            this.$('.toolbar-container').append(toolbar.el);
            toolbar.render();
        },

        clearPaper: function() {
            this.graph.clear()
            document.getElementById("text-area-1").value = JSON.stringify(this.paper.model.toJSON());
            //txt_original.value = '{"cells":[]}'
            // document.getElementById('btn-1').click();

            //this.paper.model.fromJSON(JSON.parse('{"cells":[]}'))
        },

        applyOnSelection: function(method) {
            this.graph.startBatch('selection');
            this.selection.collection.models.forEach(function(model) { model[method](); });
            this.graph.stopBatch('selection');
        },

        changeSnapLines: function(checked) {

            if (checked) {
                this.snaplines.enable();
            } else {
                this.snaplines.disable();
            }
        },

        initializeTooltips: function() {

            new joint.ui.Tooltip({
                rootTarget: document.body,
                target: '[data-tooltip]',
                direction: 'auto',
                padding: 10,
                animation: true
            });
        },

        // backwards compatibility for older shapes
        exportStylesheet: '.scalable * { vector-effect: non-scaling-stroke }',

        openAsSVG: function() {

            var paper = this.paper;
            paper.hideTools().toSVG(function(svg, error) {
                if (error) {
                    console.error(error.message);
                }
                new joint.ui.Lightbox({
                    image: 'data:image/svg+xml,' + encodeURIComponent(svg),
                    downloadable: true,
                    fileName: 'Rappid'
                }).open();
                paper.showTools();
            }, {
                preserveDimensions: true,
                convertImagesToDataUris: true,
                useComputedStyles: false,
                stylesheet: this.exportStylesheet
            });
        },

        openAsPNG: function() {

            var paper = this.paper;
            paper.hideTools().toPNG(function(dataURL, error) {
                if (error) {
                    console.error(error.message);
                }
                new joint.ui.Lightbox({
                    image: dataURL,
                    downloadable: true,
                    fileName: 'Rappid'
                }).open();
                paper.showTools();
            }, {
                padding: 10,
                useComputedStyles: false,
                stylesheet: this.exportStylesheet
            });
        },

        layoutDirectedGraph: function() {

            joint.layout.DirectedGraph.layout(this.graph, {
                setLinkVertices: true,
                rankDir: 'TB',
                marginX: 100,
                marginY: 100
            });

            this.paperScroller.centerContent({ useModelGeometry: true });
        }
    });

})(joint);
