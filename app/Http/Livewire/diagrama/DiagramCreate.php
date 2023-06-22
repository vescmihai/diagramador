<?php

namespace App\Http\Livewire\diagrama;

use App\Models\Diagram;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DiagramCreate extends Component
{
    public $open= false;
    public $name, $tipo;

    

    protected $rules = [
        'name' => 'required|max:25'
    ];

    public function render()
    {
        return view('livewire.diagrama.diagram-create');
    }

    public function save(){
        try {
            $diagram = Diagram::create([
                'diagram_name' => $this->name,
                'diagram_type' => $this->tipo,
                'diagram_json' => '{"cells":[]}',
                'diagram_json_copy' => '{"cells":[]}',
                'diagram_img' => asset('new-diagram.png'),
                'user_id' => Auth::user()->id,
            ]);

            DB::commit();
            $this->open = false;
            return redirect()->route('diagrama.edit');

        } catch (\Throwable $th) {

            DB::rollBack();
            $this->open = false;
            $this->emit('unexpected_error');
        }
    }

    
}
