<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(Request $request)
    {

         $query = Log::with('user');


        // Formulário Busca Topo
          $form_busca = '';
            // Filtro nome
        if($request->filled('form_busca')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->form_busca . '%');
            });

            $form_busca = $request->form_busca;
        }
        //$logs = $query->latest()->paginate(20);
            // Implementar paginação
        $logs = $query->latest()->paginate(50)->appends($request->all()); // Ajustar o numero coforme necessário.  

        return view('logs.index', compact('logs','form_busca'));
    }
}
