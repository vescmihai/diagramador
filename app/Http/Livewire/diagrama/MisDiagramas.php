<?php

namespace App\Http\Livewire\diagrama;

use App\Models\Diagram;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class MisDiagramas extends Component
{
    use WithPagination;
    
    public $search;
    public $count = 8;
    protected $listeners = [ 'delete'];

    public function render()
    {
        $diagrams = Diagram::where('user_id', Auth::user()->id)
            ->where('diagram_name', 'like', '%'.$this->search.'%')
            ->paginate($this->count);

        return view('livewire.diagrama.mis-diagramas', compact('diagrams'));
    }

    public function delete(Diagram $diagram){
        try {
            
            $diagram->delete();

        } catch (\Throwable $th) {

        }
    }
}
