<?php

namespace App\Http\Livewire\Diagrama;

use App\Models\Diagram;
use Livewire\Component;

class DiagramUpdate extends Component
{
    public $diagram;

    protected $listeners = [
        'saveChanges',
        'updateDiagram',
        'withoutChanges'
    ];
    
    public function render()
    {
        return view('livewire..diagrama.diagram-update');
    }

    public function saveChanges($diagram_id, $diagram_json) {
        $diagram = Diagram::findOrFail($diagram_id);

        $diagram->diagram_json = $diagram_json;
        $diagram->diagram_json_copy = $diagram_json;
        $diagram->save();

        $this->emit('changesSaved');
    }

    public function updateDiagram($diagram_id, $diagram_json) {
        $diagram = Diagram::findOrFail($diagram_id);

        $diagram->diagram_json_copy = $diagram_json;
        $diagram->save();
    }

    public function withoutChanges($diagram_id) {
        $diagram = Diagram::findOrFail($diagram_id);

        $diagram->diagram_json_copy = $diagram->diagram->json;
        $diagram->save();
    }
}
