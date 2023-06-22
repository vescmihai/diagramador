
import { dia } from '@clientio/rappid';

const PADDING = {
    top: 13,
    left: 8,
    right: 8,
    bottom: 8
};

export class TableHighlighter extends dia.HighlighterView {
    
    constructor() {
        super({
            tagName: 'rect',
            layer: dia.Paper.Layers.BACK
        });
    }
    
    highlight(tableView) {
        const table = tableView.model;
        const { width, height } = table.size();
        this.vel.attr({
            'x': -PADDING.left,
            'y': -PADDING.top,
            'width': PADDING.left + width + PADDING.right,
            'height': PADDING.top + height + PADDING.bottom,
            'fill': 'none',
            'stroke-width': 3,
            'stroke': table.getTabColor(),
            'pointer-events': 'none'
        });
    }
}

export class LinkHighlighter extends dia.HighlighterView {
    
    constructor() {
        super({
            tagName: 'path',
            layer: dia.Paper.Layers.BACK
        });
    }
    
    highlight(linkView) {
        const link = linkView.model;
        const vertices = link.get('vertices');
        
        if (!vertices.length) {
            this.vel.attr('d', ''); // Clear path if no vertices
            return;
        }
        
        let pathData = '';
        const source = link.source();
        const target = link.target();
        
        pathData += `M ${source.x} ${source.y} `; // Start at source
        
        for (const vertex of vertices) {
            pathData += `L ${vertex.x} ${vertex.y} `; // Line to each vertex
        }
        
        pathData += `L ${target.x} ${target.y}`; // Line to target
        
        this.vel.attr({
            'd': pathData,
            'fill': 'none',
            'stroke-width': 3,
            'stroke': 'gray',
            'pointer-events': 'none'
        });
    }
}
