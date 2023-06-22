<?php

namespace App\Http\Controllers;

use App\Models\Diagram;
use App\Models\UserHasDiagram;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class DiagramController extends Controller
{

    public function diagramas() {
        return view('diagrama.misdiagramas');
    }

    public function misColaboraciones() {
        return view('diagrama.miscolaboraciones');
    }

    public function editDiagrama($id)
    {
        /* foreach (Auth::user()->unreadNotifications as $notification) {
            if ($notification->read_at == null && $notification->data['diagram_id'] == $id) 
                $notification->markAsRead();
        } */
 
        $diagram = Diagram::findOrFail($id);

        $user_has_diagram = UserHasDiagram::where('diagram_id', $id)
            ->where('user_id', Auth::user()->id)
            ->first();

        if ($user_has_diagram == null) {
            if ($diagram->user_id != Auth::user()->id)
                abort(404);
        }
        
        return view('diagrama.prueba', compact('diagram'));
    }

    public function editColaboradores(Diagram $diagram) {
        if ($diagram->user_id != Auth::user()->id)
            abort(404);

        return view('diagrama.colaboradores', compact('diagram'));
    }

}
