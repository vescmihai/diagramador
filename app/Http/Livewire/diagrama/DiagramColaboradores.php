<?php

namespace App\Http\Livewire\Diagrama;

use App\Models\UserHasDiagram;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DiagramColaboradores extends Component
{   
    public $search;
    public $count = 8;

    protected $listeners = ['updated_collaborator' => 'render'];
    
    public function mount() {
        $this->search = '';
    }

    public function render(){
    $diagram_has_users = UserHasDiagram::join('diagrams', 'diagrams.id', 'user_has_diagrams.diagram_id')
            ->where('user_has_diagrams.user_id', Auth::user()->id)
            ->where('diagrams.diagram_name', 'like', '%'.$this->search.'%')
            ->select('user_has_diagrams.*', 'diagrams.diagram_img', 'diagrams.diagram_name', 'diagrams.diagram_type')
            ->paginate($this->count); 
    
        return view('livewire..diagrama.diagram-colaboradores',compact('diagram_has_users'));
    }
}
