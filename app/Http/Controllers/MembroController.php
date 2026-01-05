<?php

namespace App\Http\Controllers;

use App\Models\Membro;
use App\Models\Igreja;
use Illuminate\Http\Request;
use App\Services\ImageService;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class MembroController extends Controller
{
    protected $imageService;
    /**
     * Display a category listing of the resource.
     */
    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;        
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Membro::orderBy('id','DESC')->get();
        return view('admin.membro.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $igrejas = Igreja::all();
        return view('admin.membro.create', compact('igrejas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {       // dd($request->all());
        $request->validate([
            'igreja_id' => 'required|exists:igrejas,id',
            'nome' => 'required|string|max:255',
            'apelido' => 'nullable|string|max:255',
            'data_nascimento' => 'nullable|date',
            'sexo' => 'nullable|in:M,F,O',
            'estado_civil' => 'nullable|string|max:50',
            'cpf' => [
                'nullable',
                'string',
                'max:14',
                Rule::unique('membros')->where(function ($query) {
                    return $query->whereNull('deleted_at');
                }),
            ],
            'rg' => 'nullable|string|max:20',
            'titulo_eleitor' => 'nullable|string|max:20',
            'telefone' => 'nullable|string|max:20',
            'email' => [
                'nullable',
                'string',
                'email',
                'max:255',
                Rule::unique('membros')->where(function ($query) {
                    return $query->whereNull('deleted_at');
                }),
            ],
            'whatsapp_ativo' => 'nullable|boolean',
            'endereco' => 'nullable|string',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'uf' => 'nullable|string|size:2',
            'cep' => 'nullable|string|max:10',
            'data_conversao' => 'nullable|date',
            'data_batismo' => 'nullable|date',
            'data_entrada_igreja' => 'nullable|date',
            'status' => 'required|in:ativo,inativo,visitante,transferido,falecido',
            'observacoes' => 'nullable|string',
            'foto_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);        

        $baseSlug = Str::slug($request->nome);
        $uniqueSlug = $baseSlug;
        $counter = 1;

        // Verifica apenas registros não deletados
        while (Membro::where('slug', $uniqueSlug)->whereNull('deleted_at')->exists()) {
            $uniqueSlug = $baseSlug . '-' . $counter;
            $counter++;
        }
        // Lógica para salvar o membro  
        $membro = new Membro();
        $membro->igreja_id = $request->igreja_id;
        $membro->nome = $request->nome;
        $membro->apelido = $request->apelido;
        $membro->data_nascimento = $request->data_nascimento;
        $membro->sexo = $request->sexo;
        $membro->estado_civil = $request->estado_civil;
        $membro->cpf = $request->cpf;
        $membro->rg = $request->rg;
        $membro->titulo_eleitor = $request->titulo_eleitor;
        $membro->telefone = $request->telefone;
        $membro->email = $request->email;
        $membro->whatsapp_ativo = $request->whatsapp_ativo ?? false ;
        $membro->endereco = $request->endereco;
        $membro->bairro = $request->bairro;
        $membro->cidade = $request->cidade;
        $membro->uf = $request->uf;
        $membro->cep = $request->cep;
        $membro->data_conversao = $request->data_conversao;
        $membro->data_batismo = $request->data_batismo;
        $membro->data_entrada_igreja = $request->data_entrada_igreja;
        $membro->status = $request->status;
        $membro->observacoes = $request->observacoes;
        $membro->slug = $uniqueSlug;

        if($image = $request->file('foto_url')){
            $membro->foto_url = $this->imageService->compressAndStoreImage($image, $uniqueSlug, 'membro');
        }
        $membro->save();

        return redirect()->route('admin.membro.index')->with('success', 'Membro criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Membro $membro)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $membro = Membro::where('id', decrypt($id))->first();
        $igrejas = Igreja::all();
        return view('admin.membro.edit', compact('membro', 'igrejas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Membro $membro)
    {
        //
        $request->validate([
            'igreja_id' => 'required|exists:igrejas,id',
            'nome' => 'required|string|max:255',
            'apelido' => 'nullable|string|max:255',
            'data_nascimento' => 'nullable|date',
            'sexo' => 'nullable|in:M,F,O',
            'estado_civil' => 'nullable|string|max:50',
            'cpf' => 'nullable|string|max:14|unique:membros,cpf,'.$request->id,
            'rg' => 'nullable|string|max:20',
            'titulo_eleitor' => 'nullable|string|max:20',
            'telefone' => 'nullable|string|max:20',
            'email' => 'nullable|string|email|max:255|unique:membros,email,'.$request->id,
            'whatsapp_ativo' => 'nullable|boolean',
            'endereco' => 'nullable|string',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'uf' => 'nullable|string|size:2',
            'cep' => 'nullable|string|max:10',
            'data_conversao' => 'nullable|date',
            'data_batismo' => 'nullable|date',
            'data_entrada_igreja' => 'nullable|date',
            'status' => 'required|in:ativo,inativo,visitante,transferido,falecido',
            'observacoes' => 'nullable|string',
            'foto_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $membro = Membro::find($request->id);
        $membro->igreja_id = $request->igreja_id;
        $membro->nome = $request->nome;
        $membro->apelido = $request->apelido;
        $membro->data_nascimento = $request->data_nascimento;
        $membro->sexo = $request->sexo;
        $membro->estado_civil = $request->estado_civil;
        $membro->cpf = $request->cpf;
        $membro->rg = $request->rg;
        $membro->titulo_eleitor = $request->titulo_eleitor;
        $membro->telefone = $request->telefone;
        $membro->email = $request->email;
        $membro->whatsapp_ativo = $request->whatsapp_ativo ?? false ;
        $membro->endereco = $request->endereco;
        $membro->bairro = $request->bairro;
        $membro->cidade = $request->cidade;
        $membro->uf = $request->uf;
        $membro->cep = $request->cep;
        $membro->data_conversao = $request->data_conversao;
        $membro->data_batismo = $request->data_batismo;
        $membro->data_entrada_igreja = $request->data_entrada_igreja;
        $membro->status = $request->status;
        $membro->observacoes = $request->observacoes;

        if($image = $request->file('foto_url')){
            // Unlink the old image
            $oldImage = $membro->foto_url;
            $image_path = public_path('images/membro/'.$oldImage);
            if(file_exists($image_path)) {
                unlink($image_path);
            }

            // Add the new image
            $membro->foto_url = $this->imageService->compressAndStoreImage($image, $membro->slug, 'membro');
        }


        $membro->save();

        return redirect()->route('admin.membro.index')->with('success', 'Membro atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $membro = Membro::where('id', decrypt($id))->first();
        //Unlink the foto_url image
        $oldImage = $membro->foto_url;
        $image_path = public_path('images/membro/'.$oldImage);
        if(file_exists($image_path)) {
            unlink($image_path);
        }
        $membro->delete();
        return redirect()->route('admin.membro.index')->with('success', 'Membro deletado com sucesso.');
    }
}
