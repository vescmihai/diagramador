<?php

namespace App\Http\Livewire\diagrama;

use App\Models\Diagram;
use App\Models\User;
use App\Models\UserHasDiagram;
use Livewire\Component;

class DiagramEditColaboradores extends Component
{
    public $diagram;
    public $users, $select_users, $diagram_user;
    public $user_has_diagrams;
    public $name, $type;

    protected $listeners = ['deleteOneCollaborator'];
    
    public function render()
    {
        return view('livewire.diagrama.diagram-edit-colaboradores');
    }
    
    public function mount() {
        $this->users = User::select('users.id', 'users.name', 'users.email')->get();

        $user_has_diagrams = UserHasDiagram::where('diagram_id', $this->diagram->id)->get();

        $this->diagram_user = [];
        foreach ($user_has_diagrams as $user_has_diagram) {
            array_push($this->diagram_user, $user_has_diagram->user_id);
        }

        $this->user_has_diagrams = User::join('user_has_diagrams', 'user_has_diagrams.user_id', 'users.id')
            ->where('user_has_diagrams.diagram_id', $this->diagram->id)
            ->select('users.*')
            ->get();

        $this->name = $this->diagram->diagram_name;
        $this->type = $this->diagram->diagram_type;
        
    }

    public function addCollaborators() {

        foreach ($this->select_users as $user_id) {
            $exist = UserHasDiagram::where('diagram_id', $this->diagram->id)->where('user_id', $user_id)->first();

            if ($exist != null)
                continue;

            $user = User::findOrFail($user_id);
            
            $user_has_diagram = UserHasDiagram::create([
                'role' => null,
                'user_id' => $user_id,
                'diagram_id' => $this->diagram->id,
            ]);

            //$user->notify(new CollaboratorNotification($user_has_diagram));
           /*  event(new CollaboratorEvent($user_has_diagram)); */
        }

        // Actualiza Select2
        $this->emit('collaboratorsAdded');

        // Actualiza diagrama de collab
        $this->emit('updated_collaborator');
        
        DiagramEditColaboradores::mount();
    }

    public function deleteOneCollaborator($id) {
        $user_has_diagram = UserHasDiagram::where('user_id', $id)
            ->where('diagram_id', $this->diagram->id)
            ->first();

        $user_has_diagram->delete();

        DiagramEditColaboradores::mount();
    }   

    public function diagramUpdate() {
        $diagram = Diagram::findOrFail($this->diagram->id);

        $diagram->diagram_name = $this->name;
        $diagram->diagram_type = $this->type;
        $diagram->save();
        
        return redirect()->route('diagrama.misdiagramas');
    }
}
