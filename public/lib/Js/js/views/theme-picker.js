/*! JointJS+ v3.7.0 - HTML5 Diagramming Framework - TRIAL VERSION

Copyright (c) 2023 client IO

 2023-05-30 


This Source Code Form is subject to the terms of the JointJS+ Trial License
, v. 2.0. If a copy of the JointJS+ License was not distributed with this
file, You can obtain one at https://www.jointjs.com/license
 or from the JointJS+ archive as was distributed by client IO. See the LICENSE file.*/


var App = window.App || {};

(function(joint) {

    App.ThemePicker = joint.ui.Toolbar.extend({

        className: function() {
            return `${joint.ui.Toolbar.prototype.className} theme-picker`;
        },

        options: {
            mainView: null // an instance of App.MainView
        },

        themes: {
            type: 'select-button-group',
            name: 'theme-picker',
            multi: false,
            options: [
                /* { value: 'modern', content: 'Modern' },
                { value: 'dark', content: 'Dark' },
                { value: 'material', content: 'Material' } */
            ],
            attrs: {
                '.joint-select-button-group': {
                    'data-tooltip': 'Change Theme',
                    'data-tooltip-position': 'bottom'
                }
            }
        },

        init: function() {

            this.themes.selected = this.themes.options.findIndex(opt => opt.value === this.defaultTheme);
            this.options.tools = [this.themes];
            this.on('theme-picker:option:select', this.onThemeSelected, this);

            joint.ui.Toolbar.prototype.init.apply(this, arguments);
        },

        onThemeSelected: function(option) {

            joint.setTheme(option.value);
            if (this.options.mainView) {
                this.adjustAppToTheme(this.options.mainView, option.value);
            }
        },

        adjustAppToTheme: function(app, theme) {

            // Material design has no grid shown.
            if (theme === 'material') {
                app.paper.options.drawGrid = false;
                app.paper.clearGrid();
            } else {
                app.paper.options.drawGrid = true;
                app.paper.drawGrid();
            }
        }
    });

})(joint);
