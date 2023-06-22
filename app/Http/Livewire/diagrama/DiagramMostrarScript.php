<?php

namespace App\Http\Livewire\Diagrama;

use Livewire\Component;

class DiagramMostrarScript extends Component
{
    
    public $open= false;
    public $contenido= '';

    protected $listeners = ['open'];

    public function render()
    {
        return view('livewire..diagrama.diagram-mostrar-script');
    }

    public function open($contenido){
        $this->contenido = $contenido;
        $this->open = true;
    }
    public function save(){

    }
    
}
