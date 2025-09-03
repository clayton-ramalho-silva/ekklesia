<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Traits\LogsActivity;

class CompanyController extends Controller
{
    use LogsActivity;

    public function index(Request $request)
    {
        /**
         * Filtros: cidades, uf, status
         */

        
        
        $query = Company::with(['location']);


         $form_busca = '';
        // Filtro nome
        if ($request->filled('form_busca')){
            //dd($request->form_busca);
            $query->where('nome_fantasia', 'like', '%'. $request->form_busca . '%');
            $form_busca = $request->form_busca;

        }


        // Filtro cidade
        if ($request->filled('cidade')) {

            if($request->cidade !== "Todas"){

                $query->whereHas('location', function($q) use ($request){
                    $q->where('cidade', 'like', '%' . $request->cidade . '%');
                });

            }

        }

         // Filtro uf
         if ($request->filled('uf')) {

            if($request->uf !== "Todos"){

                $query->whereHas('location', function($q) use ($request){
                    $q->where('uf', 'like', '%' . $request->uf . '%');
                });

            }

        }

        // Filtro Status
        if ($request->filled('status')){

            $query->whereIn('status', $request->status);

        }

        // Filtro Filtro data Company

        if($request->filled('filtro_data')) {
            $dias = match($request->filtro_data) {
                '7' => 7,
                '15' => 15,
                '30' => 30,
                '90' => 90,
                default => null,
            };

            if ($dias) {
                $query->where('created_at', '>=', now()->subDays($dias));
            }
        }

        $companies = $query->get();
        
        return view('companies.index', compact('companies', 'form_busca'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
                'cnpj' => 'required|string|unique:companies,cnpj',
                'razao_social' => 'required|string|max:255',
                'nome_fantasia' => 'nullable|string|max:255',
                'cep' => 'nullable|string|max:255',
                'logradouro' => 'nullable|string|max:255',
                'numero' => 'nullable|string|max:20',
                'complenento' => 'nullable|string|max:255',
                'bairro' => 'nullable|string|max:255',
                'pais' => 'nullable|string|max:255',
                'cidade' => 'nullable|string|max:255',
                'uf' => 'nullable|string|max:255',
                'nome_contato' => 'nullable|string|max:255',
                'email' => 'nullable|email',
                'telefone' => 'nullable|max:15',
                'whatsapp' => 'nullable|max:15',
                'logotipo' => 'nullable|file|mimes:jpg,jpeg,png|max:2048'
            ]);

        dd($data);
        // Salvando imagem no banco e movendo arquivo para pasta.
        if($request->hasFile('logotipo') && $request->file('logotipo')->isValid()){
            $file = $request->file('logotipo');

            $extension = $file->getClientOriginalExtension();

            $fileName = md5($file->getClientOriginalName() . microtime()) . '.' . $extension;

            $file->move(public_path('documents/companies/images'), $fileName);

            $data['logotipo'] = $fileName;
        }

        $company = Company::create([
            'cnpj' => $data['cnpj'],
            'razao_social' => $data['razao_social'],
            'nome_fantasia' => $data['nome_fantasia'],
            'logotipo' => $data['logotipo'] ?? null
        ]);

        $company->contacts()->create([
            'telefone' => $data['telefone'],
            'email' => $data['email'],
            'nome_contato' => $data['nome_contato'],
            'whatsapp' => $data['whatsapp']
        ]);

        $company->location()->create([
            'logradouro' => $data['logradouro'],
            'numero' => $data['numero'],
            'complenento' => $data['complenento'],
            'bairro' => $data['bairro'],
            'cidade' => $data['cidade'],
            'uf' => $data['uf'],
            //'logradouro' => $data['logradouro'],
            'cep' => $data['cep'],
            'pais' => $data['pais']
        ]);


        // Salvando Log de criação
        $this->logAction('create', 'companies', $company->id, 'Empresa cadastrado com sucesso.');

        return redirect()->route('companies.index')->with('success', 'Empresa cadastrada com sucesso!');
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        //dd($request->all());

        $data = $request->validate([
            'cnpj' => 'required|string|unique:companies,cnpj,'. $company->id,
            'razao_social' => 'required|string|max:255',
            'nome_fantasia' => 'nullable|string|max:255',
            'cep' => 'nullable|string|max:255',
            'logradouro' => 'nullable|string|max:255',
            'numero' => 'nullable|string|max:20',
            'complenento' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'pais' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'uf' => 'nullable|string|max:255',
            'nome_contato' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'telefone' => 'nullable|string|max:15',
            'whatsapp' => 'nullable|string|max:15',
            'logotipo' => 'nullable|file|mimes:jpg,jpeg,png|max:2048'
        ]);

        //dd($data);

        $logotipo_atual = $company->logotipo;

        // Salvando imagem no banco e movendo arquivo para pasta.
        if($request->hasFile('logotipo') && $request->file('logotipo')->isValid()){
            $file = $request->file('logotipo');

            $extension = $file->getClientOriginalExtension();

            $fileName = md5($file->getClientOriginalName() . microtime()) . '.' . $extension;

            $file->move(public_path('documents/companies/images'), $fileName);

            $data['logotipo'] = $fileName;

            if($logotipo_atual){
                unlink(public_path('documents/companies/images/'. $logotipo_atual));
            }
        } else {
            $data['logotipo'] = $logotipo_atual;
        }


        $company->update([
            'cnpj' => $data['cnpj'],
            'razao_social' => $data['razao_social'],
            'nome_fantasia' => $data['nome_fantasia'],
            'logotipo' => $data['logotipo'],
            'status' => ($request->input('status') === 'on') ? 'ativo' : 'inativo'
        ]);

        $company->contacts()->update([
            'telefone' => $data['telefone'],
            'email' => $data['email'],
            'nome_contato' => $data['nome_contato'],
            'whatsapp' => $data['whatsapp']
        ]);

        $company->location()->update([
            'logradouro' => $data['logradouro'],
            'numero' => $data['numero'],
            'complenento' => $data['complenento'],
            'bairro' => $data['bairro'],
            'cidade' => $data['cidade'],
            'uf' => $data['uf'],
            //'logradouro' => $data['logradouro'],
            'cep' => $data['cep'],
            'pais' => $data['pais']
        ]);



        // Salvando Log de criação
        $this->logAction('update', 'companies', $company->id, 'Empresa atualizada com sucesso.');

        return redirect()->route('companies.index')->with('success', 'Empresa atualizada com sucesso!');
    }

    public function destroy(Company $company)
    {       
        //dd('chegou deletar empresa');


        // Verifica se já está deletada
        if ($company->trashed()){
            return redirect()->route('companies.index')->with('danger', 'Empresa já foi excluída');
        }

        // Deletar as vagas associadas (soft delete).
        foreach($company->jobs as $job) {
            $job->delete();
        }

        // Deletar os dados relacionados (soft delete)
        if ($company->location) {
            $company->location->delete();
        }

        if ($company->contacts) {
            $company->contacts->delete();
        }

        // Logotipo atual
        $logotipo_atual = $company->logotipo;
        
        // Deletar a Empresa
        $company->delete();
        
      
        // Após delete no banco, deletar o arquivo do logotipo 0f0e5dce0fd8ebe899215d35d9fbb13b.png

        if($logotipo_atual) {
            $caminhoArquivo = public_path('documents/companies/images/'. $logotipo_atual);
            if(file_exists($caminhoArquivo)){
                unlink($caminhoArquivo);
            }
        }

        // Salvando Log de criação
        $this->logAction('delete', 'companies', $company->id, 'Empresa excluído.');

        return redirect()->route('companies.index')->with('success', 'Empresa excluída com sucesso!');
    }


    public function updateStatus(Request $request, $companyId)
    {
        $company = Company::findOrFail($companyId);

        // Atualiza o status com base no valor do switch
        $company->status = $request->input('status') === 'on' ? 'ativo' : 'inativo';
        $company->save();

        return redirect()->back()->with('success', 'Status atualizado com sucesso!');
    }


}
