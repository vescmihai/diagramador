/*! JointJS+ v3.7.0 - HTML5 Diagramming Framework - TRIAL VERSION

Copyright (c) 2023 client IO

 2023-05-30 


This Source Code Form is subject to the terms of the JointJS+ Trial License
, v. 2.0. If a copy of the JointJS+ License was not distributed with this
file, You can obtain one at https://www.jointjs.com/license
 or from the JointJS+ archive as was distributed by client IO. See the LICENSE file.*/


var App = App || {};
App.config = App.config || {};

(function() {

    'use strict';

    App.config.selection = {

        handles: [{
            name: 'remove',
            position: 'nw',
            events: {
                pointerdown: 'removeElements'
            },
            attrs: {
                '.handle': {
                    'data-tooltip-class-name': 'small',
                    'data-tooltip': 'Click to remove the selected elements',
                    'data-tooltip-position': 'right',
                    'data-tooltip-padding': 15
                }
            }

        }, {
            name: 'rotate',
            position: 'sw',
            events: {
                pointerdown: 'startRotating',
                pointermove: 'doRotate',
                pointerup: 'stopBatch'
            },
            attrs: {
                '.handle': {
                    'data-tooltip-class-name': 'small',
                    'data-tooltip': 'Click and drag to rotate the selected elements',
                    'data-tooltip-position': 'right',
                    'data-tooltip-padding': 15
                }
            }

        }, {
            name: 'resize',
            position: 'se',
            events: {
                pointerdown: 'startResizing',
                pointermove: 'doResize',
                pointerup: 'stopBatch'
            },
            attrs: {
                '.handle': {
                    'data-tooltip-class-name': 'small',
                    'data-tooltip': 'Click and drag to resize the selected elements',
                    'data-tooltip-position': 'left',
                    'data-tooltip-padding': 15
                }
            }
        }]
    };

})();
