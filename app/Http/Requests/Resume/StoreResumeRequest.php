<?php

namespace App\Http\Requests\Resume;

use Illuminate\Foundation\Http\FormRequest;

class StoreResumeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        
        return [
            'nome' => 'nullable|string|max:255',
            'cpf' => 'nullable|string|max:255',
            'rg' => 'nullable|string|max:255',
            'cnh' => 'nullable|string|max:255',
            'data_nascimento' => 'nullable|date',
            'nacionalidade' => 'string|nullable|max:500',
            'estado_civil' => 'nullable|string|max:255',
            'reservista' => 'nullable|string|max:255',
            'possui_filhos' => 'nullable|string|max:255',
            'sexo' => 'nullable|string|max:255',
            'pcd' => 'string|nullable|max:255',
            'pcd_sim' => 'string|nullable|max:255',
            'cep' => 'nullable|string|max:255',
            'logradouro' => 'nullable|string|max:255',
            'numero' => 'nullable|string|max:255',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'uf' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:contact_resumes,email',
            'instagram' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'telefone_celular' => 'nullable|string|max:255',
            'telefone_residencial' => 'nullable|string|max:255', // Telefone de contato
            'nome_contato' => 'nullable|string|max:255',
            'vagas_interesse' => 'nullable',
            'experiencia_profissional' => 'nullable',
            'experiencia_profissional_outro' => 'nullable|string|max:255',
            'escolaridade' => 'nullable',
            'escolaridade_outro' => 'nullable|string|max:255',
            'semestre' => 'nullable|string|max:255',
            'instituicao' => 'nullable|string|max:255',
            'outro_modalidade' => 'nullable|string|max:255',            
            'fundamental_periodo' => 'string|nullable|max:255',
            'fundamental_modalidade' => 'string|nullable|max:255',
            'medio_periodo' => 'string|nullable|max:255',
            'medio_modalidade' => 'string|nullable|max:255',

            'tecnico_curso' => 'string|nullable|max:255',
            'tecnico_semestre' => 'string|nullable|max:255',
            'tecnico_instituicao' => 'string|nullable|max:255',
            'tecnico_modalidade' => 'string|nullable|max:255',
            'tecnico_periodo' => 'string|nullable|max:255',

            'tecnico_completo_curso' => 'string|nullable|max:255',
            'tecnico_completo_instituicao' => 'string|nullable|max:255',
            'tecnico_completo_data_conclusao' => 'string|nullable|max:255',


            'superior_curso' => 'string|nullable|max:255',
            'superior_termo' => 'string|nullable|max:255',
            'superior_instituicao' => 'string|nullable|max:255',
            'superior_semestre' => 'string|nullable|max:255',
            'superior_periodo' => 'string|nullable|max:255',

            'superior_completo_curso' => 'string|nullable|max:255',
            'superior_completo_instituicao' => 'string|nullable|max:255',
            'superior_completo_data_conclusao' => 'string|nullable|max:255',

            'foi_jovem_aprendiz' => 'nullable|string|max:255',
            'informatica' => 'nullable|string|max:255',
            'ingles' => 'nullable|string|max:255',
            'cras' => 'string|nullable|max:255',
            'fonte' => 'string|nullable|max:255',
            'curriculo_doc' => 'required|file|mimes:pdf|max:2048',
            'foto_candidato' => 'file|mimes:jpg,jpeg,png|max:2048',
            'filhos_sim' => 'string|nullable|max:255', // Idade dos filhos
            'filhos_qtd' => 'string|nullable|max:255',
            'sexo_outro' => 'string|nullable|max:255',
            'tipo_cnh' => 'string|nullable|max:255',
            //'obs_informatica' => 'string|nullable|max:500',
            //'obs_ingles' => 'string|nullable|max:500',
            //'reservista_outro' => 'nullable|string|max:255',
            //'escolaridade' => 'nullable|string|max:255',
            //'participou_selecao' => 'nullable|string|max:255',
            //'participou_selecao_outro' => 'nullable|string|max:255',
            //'tamanho_uniforme' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'curriculo_doc.mime' => 'O Arquivo deve ser em formato PDF',            
            'curriculo_doc.max' => 'O Arquivo de ter no máximo 2MB',
            'curriculo_doc.required' => 'O Currículo é obrigatório.'            
           
        ];
    }
}


