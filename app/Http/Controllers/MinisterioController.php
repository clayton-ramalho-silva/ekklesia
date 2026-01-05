<?php

namespace App\Http\Controllers;

use App\Models\Igreja;
use App\Models\Membro;
use App\Models\Ministerio;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MinisterioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Ministerio::ativos()->with('igreja')->get();
        return view('admin.ministerio.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $igrejas = Igreja::all();
        $membros = Membro::all();
        return view('admin.ministerio.create', compact('igrejas', 'membros'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'igreja_id' => 'required|exists:igrejas,id',
            'lider_id' => 'required|exists:membros,id',
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);        

        $baseSlug = Str::slug($request->nome);
        $uniqueSlug = $baseSlug;
        $counter = 1;
        while (Membro::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $ministerio = new Ministerio();
        $ministerio->igreja_id = $request->igreja_id;
        $ministerio->lider_id = $request->lider_id;
        $ministerio->nome = $request->nome;
        $ministerio->slug = $uniqueSlug;
        $ministerio->descricao = $request->descricao;
        $ministerio->save();

        return redirect()->route('admin.ministerio.index')->with('success', 'Ministério criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ministerio $ministerio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $ministerio = Ministerio::where('id', decrypt($id))->first();
        $igrejas = Igreja::all();
        $membros = Membro::all();
        return view('admin.ministerio.edit', compact('ministerio', 'igrejas', 'membros'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ministerio $ministerio)
    {
        //
        $validated = $request->validate([
            'igreja_id' => 'required|exists:igrejas,id',
            'lider_id' => 'required|exists:membros,id',
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'membros' => 'nullable|array',
            'membros.*' => 'exists:membros,id',
        ]);

        // Atualiza dados básicos 
        $ministerio->update($validated);

        $membrosIds = $request->input('membros', []);

        $syncData = array_fill_keys($membrosIds, [
            'cargo' => 'participante',
            'data_inicio' => now()->toDateString(),
            'status' => 'ativo',
        ]);

        // Garante que o líder esteja incluído (se houver)
        if ($liderId = $validated['lider_id'] ?? null) {
            $syncData[$liderId] = [
                'cargo' => 'líder',
                'data_inicio' => now()->toDateString(),
                'status' => 'ativo',
            ];
        }

        $ministerio->membros()->sync($syncData);       

        return redirect()->route('admin.ministerio.index')->with('success', 'Ministério atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Desassociar membros antes de deletar o ministério
               
        $ministerio = Ministerio::where('id', decrypt($id))->first();
        $ministerio->membros()->detach();
        $ministerio->delete();
        
        return redirect()->route('admin.ministerio.index')->with('success', 'Ministério deletado com sucesso.');
    }
}
