<?php

namespace App\Http\Controllers;

use App\Models\Membros;
use Illuminate\Http\Request;
use App\Services\UploadService;

class MembrosController extends Controller
{

    public function __construct(private UploadService $uploadService)
    {

    }

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $membros = Membros::orderBy('nome')->paginate(25)->appends(request()->query());
    
        return view('membros.index', compact('membros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('membros.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required',
            'cpf' => 'nullable|unique:membros,cpf',
            'rg' => 'nullable|string|max:255',
            'data_nascimento' => 'nullable|date',
            'estado_civil' => 'nullable|string|max:255',
            'possui_filhos' => 'nullable|string|max:255',
            'filhos_qtd' => 'string|nullable|max:255',
            'filhos_idade' => 'string|nullable|max:255', // Idade dos filhos
            'sexo' => 'nullable|string|max:255',
            'cep' => 'nullable|string|max:255',
            'logradouro' => 'nullable|string|max:255',
            'numero' => 'nullable|string|max:255',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'uf' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:membros,email',
            'telefone_celular' => 'nullable|string|max:255',
            'telefone_residencial' => 'nullable|string|max:255', // Telefone de contato
            'nome_contato' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',            
            'data_conversao' => 'nullable|date',
            'data_batismo' => 'nullable|date',
            'data_membresia' => 'nullable|date',
            'foto_membro' => 'file|mimes:jpg,jpeg,png|max:2048',
            'observacao' => 'nullable|string|max:1000',
        ]);

        // Salvando foto do membro no banco e movendo arquivo para pasta.           
        $data['foto_membro'] = $this->uploadService->uploadMembroPhoto($request->file('foto_membro'), null);
        $data['status_membro'] = 'Ativo';

        Membros::create($data);

        return redirect()->route('membros.index')->with('success', 'Membro criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Membros $membro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Membros $membro)
    {
        return view('membros.edit', compact('membro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Membros $membro)
    {
        $data = $request->validate([
            'nome' => 'required',
            'cpf' => 'nullable',
            'rg' => 'nullable|string|max:255',
            'data_nascimento' => 'nullable|date',
            'estado_civil' => 'nullable|string|max:255',
            'possui_filhos' => 'nullable|string|max:255',
            'filhos_qtd' => 'string|nullable|max:255',
            'filhos_idade' => 'string|nullable|max:255', // Idade dos filhos
            'sexo' => 'nullable|string|max:255',
            'cep' => 'nullable|string|max:255',
            'logradouro' => 'nullable|string|max:255',
            'numero' => 'nullable|string|max:255',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'uf' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'telefone_celular' => 'nullable|string|max:255',
            'telefone_residencial' => 'nullable|string|max:255', // Telefone de contato
            'nome_contato' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',            
            'data_conversao' => 'nullable|date',
            'data_batismo' => 'nullable|date',
            'data_membresia' => 'nullable|date',
            'foto_membro' => 'file|mimes:jpg,jpeg,png|max:2048',
            'observacao' => 'nullable|string|max:1000',
            
        ]);
        

        // Salvando foto do membro no banco e movendo arquivo para pasta.
        $foto_membro_atual = $membro->foto_membro;


        $data['foto_membro'] = $this->uploadService->uploadMembroPhoto($request->file('foto_membro'), $foto_membro_atual);

        $membro->update($data);

        return redirect()->route('membros.index')->with('success', "Membro {$membro->nome} atualizado com sucesso.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Membros $membro)
    {
        
        $membro->delete();

        return redirect()->route('membros.index')->with('success', "Membro {$membro->nome} excluído com sucesso.");
    }
}
