<?php

namespace App\Http\Controllers;

use App\Models\Membros;
use App\Models\Ministerio;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MinisterioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $ministerios = Ministerio::orderBy('nome')->paginate(25)->appends(request()->query());

        return view('ministerios.index', compact('ministerios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $membros = Membros::all();
        //$membros = Membros::orderBy('nome')->paginate(25)->appends(request()->query());

        return view('ministerios.create', compact('membros'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
                
        $data = $request->validate([
            'nome' => 'required',
            'departamento' => 'nullable|string|max:255', 
            'lideres' => 'nullable|array|min:1|max:5',
            'lideres.*' => ['exists:membros,id','distinct'],
            'participantes' => 'nullable|array',
            'participantes.*' => ['exists:membros,id','distinct'],
            'descricao' => 'nullable|string|max:1000',
        ]);
            
       
        $ministerio = Ministerio::create($data);

        /**
         * Lógica para registro de lideres
         */
        // Obter os IDs enviados no formulário
        $lideresAtuaisIds = $request->input('lideres', []);

        // Obter os IDs que já estavam associados (antes do update)
        $lideresAntigosIds = $ministerio->lideres->pluck('id')->toArray();

        // IDs que CONTINUAM como líderes
        $idsManter = array_intersect($lideresAtuaisIds, $lideresAntigosIds);

        // IDs que FORAM ADICIONADOS (novos líderes)
        $idsAdicionar = array_diff($lideresAtuaisIds, $lideresAntigosIds);

        // IDs que FORAM REMOVIDOS (ex-líderes)
        $idsRemover = array_diff($lideresAntigosIds, $lideresAtuaisIds);

        // 1. Atualizar os que continuam: garantir data_fim = null
        if (!empty($idsManter)) {
            DB::table('lider_ministerios')
                ->where('ministerio_id', $ministerio->id)
                ->whereIn('membro_id', $idsManter)
                ->update(['data_fim' => null]);
        }

        // 2. Adicionar novos líderes
        foreach ($idsAdicionar as $membroId) {
            DB::table('lider_ministerios')->insert([
                'ministerio_id' => $ministerio->id,
                'membro_id' => $membroId,
                'data_inicio' => now()->toDateString(),
                'data_fim' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // 3. Registrar data_fim para os removidos (não deletar!)
        if (!empty($idsRemover)) {
            DB::table('lider_ministerios')
                ->where('ministerio_id', $ministerio->id)
                ->whereIn('membro_id', $idsRemover)
                ->whereNull('data_fim') // só os que ainda estão ativos
                ->update(['data_fim' => now()->toDateString()]);
        }



        /**
         * Lógica para registro de participantes
         */
        $participantesAtuaisIds = $request->input('participantes', []);
        $participantesAntigosIds = $ministerio->participantes->pluck('id')->toArray();

        $idsManterPart = array_intersect($participantesAtuaisIds, $participantesAntigosIds);
        $idsAdicionarPart = array_diff($participantesAtuaisIds, $participantesAntigosIds);
        $idsRemoverPart = array_diff($participantesAntigosIds, $participantesAtuaisIds);

        // Manter: data_saida = null
        if (!empty($idsManterPart)) {
            DB::table('membro_ministerios')
                ->where('ministerio_id', $ministerio->id)
                ->whereIn('membro_id', $idsManterPart)
                ->update(['data_saida' => null]);
        }

        // Adicionar novos
        foreach ($idsAdicionarPart as $membroId) {
            DB::table('membro_ministerios')->insert([
                'ministerio_id' => $ministerio->id,
                'membro_id' => $membroId,
                'data_entrada' => now()->toDateString(),
                'data_saida' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Registrar data_saida para removidos
        if (!empty($idsRemoverPart)) {
            DB::table('membro_ministerios')
                ->where('ministerio_id', $ministerio->id)
                ->whereIn('membro_id', $idsRemoverPart)
                ->whereNull('data_saida')
                ->update(['data_saida' => now()->toDateString()]);
        }





        return redirect()->route('ministerios.index')->with('success', 'Ministério criado com sucesso!');
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
    public function edit(Ministerio $ministerio)
    {
        $ministerio->load('lideresAtivos'); // ou 'lideres' se quiser filtrar na view

        return view('ministerios.edit', [
            'ministerio' => $ministerio,
            'membros' => Membros::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ministerio $ministerio)
    {
        // Carregar líderes antes de tudo
        $ministerio->load('lideres');

        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'departamento' => 'nullable|string|max:255',
            'lideres' => 'nullable|array|min:1|max:5',
            'lideres.*' => ['exists:membros,id','distinct'],
            'descricao' => 'nullable|string|max:1000',
        ]);
        

        // === DEBUG: Verifique os dados recebidos ===
        // Log::info('DEBUG - UPDATE MINISTÉRIO', [
        //     'lideres_enviados' => $request->input('lideres', []),
        //     'lideres_antigos' => $ministerio->lideres->pluck('id')->toArray(),
        //     'ministerio_id' => $ministerio->id,
        // ]);

       
        // Atualizar dados básicos do ministério
        $ministerio->update(Arr::except($data, ['lideres'])); // remove 'lideres' antes de update()

        // === Lógica de atualização de líderes ===
        $lideresAtuaisIds = collect($request->input('lideres', []))->map(fn($id) => (int)$id)->sort()->values()->toArray();
        $lideresAntigosIds = $ministerio->lideres->pluck('id')->sort()->values()->toArray();

        // Log::info('DEBUG - Comparação', [
        //     'ids_manter' => array_values(array_intersect($lideresAtuaisIds, $lideresAntigosIds)),
        //     'ids_adicionar' => array_values(array_diff($lideresAtuaisIds, $lideresAntigosIds)),
        //     'ids_remover' => array_values(array_diff($lideresAntigosIds, $lideresAtuaisIds)),
        // ]);

        // IDs que CONTINUAM como líderes
        $idsManter = array_intersect($lideresAtuaisIds, $lideresAntigosIds);

        // IDs que FORAM ADICIONADOS (novos líderes)
        $idsAdicionar = array_diff($lideresAtuaisIds, $lideresAntigosIds);

        // IDs que FORAM REMOVIDOS (ex-líderes)
        $idsRemover = array_diff($lideresAntigosIds, $lideresAtuaisIds);

        // 1. Atualizar os que continuam: garantir data_fim = null
        if (!empty($idsManter)) {
            // Log::info("MANTENDO: " . implode(',', $idsManter));
            DB::table('lider_ministerios')
                ->where('ministerio_id', $ministerio->id)
                ->whereIn('membro_id', $idsManter)
                ->update(['data_fim' => null]);
        }

        // 2. Adicionar novos líderes
        if (!empty($idsAdicionar)) {
            // Log::info("ADICIONANDO: " . implode(',', $idsAdicionar));
            foreach ($idsAdicionar as $membroId) {
                DB::table('lider_ministerios')->insert([
                    'ministerio_id' => $ministerio->id,
                    'membro_id' => $membroId,
                    'data_inicio' => now()->toDateString(),
                    'data_fim' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // 3. Registrar data_fim para os removidos (não deletar!)
        if (!empty($idsRemover)) {
            // Log::info("REMOVENDO (data_fim): " . implode(',', $idsRemover));
            DB::table('lider_ministerios')
                ->where('ministerio_id', $ministerio->id)
                ->whereIn('membro_id', $idsRemover)
                ->whereNull('data_fim') // só os que ainda estão ativos
                ->update(['data_fim' => now()->toDateString()]);
        }


        /**Lógica para atualizar participantes */
         /**
         * Lógica para registro de participantes
         */
        $participantesAtuaisIds = collect($request->input('participantes', []))->map(fn($id) => (int)$id)->sort()->values()->toArray();
        $participantesAntigosIds = $ministerio->participantes->pluck('id')->sort()->values()->toArray();

        $idsManterPart = array_intersect($participantesAtuaisIds, $participantesAntigosIds);
        $idsAdicionarPart = array_diff($participantesAtuaisIds, $participantesAntigosIds);
        $idsRemoverPart = array_diff($participantesAntigosIds, $participantesAtuaisIds);

        // Manter: data_saida = null
        if (!empty($idsManterPart)) {
            DB::table('membro_ministerios')
                ->where('ministerio_id', $ministerio->id)
                ->whereIn('membro_id', $idsManterPart)
                ->update(['data_saida' => null]);
        }

        // Adicionar novos
        foreach ($idsAdicionarPart as $membroId) {
            DB::table('membro_ministerios')->insert([
                'ministerio_id' => $ministerio->id,
                'membro_id' => $membroId,
                'data_entrada' => now()->toDateString(),
                'data_saida' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Registrar data_saida para removidos
        if (!empty($idsRemoverPart)) {
            DB::table('membro_ministerios')
                ->where('ministerio_id', $ministerio->id)
                ->whereIn('membro_id', $idsRemoverPart)
                ->whereNull('data_saida')
                ->update(['data_saida' => now()->toDateString()]);
        }

        return redirect()->back()->with('success', 'Ministério atualizado com sucesso!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ministerio $ministerio)
    {
        // Registrar data_fim para todos os líderes ativos
        DB::table('lider_ministerios')
            ->where('ministerio_id', $ministerio->id)
            ->whereNull('data_fim') // só os ativos
            ->update(['data_fim' => now()->toDateString()]);

        // Registrar data_saida para todos os participantes ativos
        DB::table('membro_ministerios')
            ->where('ministerio_id', $ministerio->id)
            ->whereNull('data_saida') // só os ativos
            ->update(['data_saida' => now()->toDateString()]);
      
        $ministerio->delete();
        return redirect()->route('ministerios.index')->with('success', "Ministério {$ministerio->nome} excluído com sucesso.");
    }
}
