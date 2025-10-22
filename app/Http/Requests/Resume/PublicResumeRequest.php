<?php

namespace App\Http\Requests\Resume;

use Illuminate\Foundation\Http\FormRequest;

class PublicResumeRequest extends FormRequest
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
            'nome' => 'required|string|max:255',
            'cpf' => [
                'required',
                'string',
                'max:255',
                new \App\Rules\UniqueCpf('personal_info_resumes'),
                ],
            'cnh' => 'required|string|max:255',
            'rg' => 'nullable|string|max:255',
            'data_nascimento' => 'required|date',
            'nacionalidade' => 'required|string|max:500',
            'estado_civil' => 'required|string|max:255',
            'reservista' => 'required|string|max:255',
            'possui_filhos' => 'required|string|max:255',
            'sexo' => 'required|string|max:255',
            'pcd' => 'string|nullable|max:255',
            'pcd_sim' => 'string|nullable|max:255',
            'cep' => 'required|string|max:255',
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:255',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'uf' => 'required|string|max:255',
            'email' => 'required|email|unique:contact_resumes,email',
            'instagram' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'telefone_celular' => 'required|string|max:255',
            'telefone_residencial' => 'required|string|max:255', // Telefone de contato
            'nome_contato' => 'required|string|max:255',
            'vagas_interesse' => 'required|array',
            'experiencia_profissional' => 'required|array',
            'experiencia_profissional_outro' => 'nullable|string|max:255',
            'escolaridade' => 'required|array',
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

            'foi_jovem_aprendiz' => 'required|string|max:255',
            'informatica' => 'required|string|max:255',
            'ingles' => 'required|string|max:255',
            'cras' => 'required|string|max:255',
            'fonte' => 'required|string|max:255',
            'curriculo_doc' => 'file|mimes:pdf|max:2048',
            //'foto_candidato' => 'file|mimes:jpg,jpeg,png|max:2048',
            'filhos_sim' => 'string|nullable|max:255', // idade
            'filhos_qtd' => 'string|nullable|max:255',
            'sexo_outro' => 'string|nullable|max:255',
            'tipo_cnh' => 'string|nullable|max:255',
            'autorizacao_uso_dados' => 'required',
            'autorizacao_responsavel_menor' => 'nullable',
            //'foto_candidato' => 'file|mimes:jpg,jpeg,png|max:2048',
            //'obs_informatica' => 'string|nullable|max:500',
            //'obs_ingles' => 'string|nullable|max:500',
            //'reservista_outro' => 'required|string|max:255',            
            //'escolaridade' => 'nullable|string|max:255',
            //'participou_selecao' => 'nullable|string|max:255',
            //'participou_selecao_outro' => 'nullable|string|max:255',
            //'tamanho_uniforme' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'nome' => 'O campo nome é obrigatório.',            
            'cnh' => 'O campo CNH é obrigatório.',
            'rg' => 'O campo RG é obrigatório.',
            'data_nascimento' => 'O campo data de nascimento é obrigatório.',
            'nacionalidade' => 'O campo nacionalidade é obrigatório.',
            'estado_civil' => 'O campo estado civil é obrigatório.',
            'reservista' => 'O campo reservista é obrigatório.',
            'possui_filhos' => 'O campo possui filhos é obrigatório.',
            'sexo' => 'O campo gênero é obrigatório.',
            'pcd' => 'O campo PCD é obrigatório.',            
            'cep' => 'O campo CEP é obrigatório.',
            'logradouro' => 'O campo Rua é obrigatório.',
            'numero' => 'O campo Número é obrigatório.',            
            'bairro' => 'O campo Bairro é obrigatório.',
            'cidade' => 'O campo Cidade é obrigatório.',
            'uf' => 'O campo Estado é obrigatório.',
            'telefone_celular' => 'O campo Telefone Celular é obrigatório.',
            'telefone_residencial' => 'O campo Telefone para Recado é Obrigatório', // Telefone de contato
            'nome_contato' => 'O campo Nome para Contato é obrigatório.',
            'vagas_interesse' => 'O campo Vagas de Interesse é obrigatório.',
            'experiencia_profissional' => 'O campo Experiência Profissional é obrigatório.',
            //'experiencia_profissional_outro' => 'nullable|string|max:255',
            'escolaridade.required' => 'O campo Escolaridade é obrigatório.',            
            // 'escolaridade_outro' => 'nullable|string|max:255',
            // 'semestre' => 'nullable|string|max:255',
            // 'instituicao' => 'nullable|string|max:255',
            // 'outro_modalidade' => 'nullable|string|max:255',
            // 'superior_periodo' => 'string|nullable|max:255',
            // 'fundamental_periodo' => 'string|nullable|max:255',
            // 'fundamental_modalidade' => 'string|nullable|max:255',
            // 'medio_periodo' => 'string|nullable|max:255',
            // 'medio_modalidade' => 'string|nullable|max:255',
            // 'tecnico_periodo' => 'string|nullable|max:255',
            // 'tecnico_modalidade' => 'string|nullable|max:255',
            // 'tecnico_curso' => 'string|nullable|max:255',
            // 'superior_curso' => 'string|nullable|max:255',
            // 'superior_instituicao' => 'string|nullable|max:255',
            // 'superior_semestre' => 'string|nullable|max:255',
            'foi_jovem_aprendiz' => 'O campo foi jovem aprendiz é obrigatório.',
            'informatica' => 'O campo Conhecimento em informática é obrigatório.',
            'ingles' => 'O campo Conhecimento em inglês é obrigatório.',
            'cras' => 'O campo CRAS é obrigatório.',
            'fonte' => 'O campo Como ficou sabendo do programa é obrigatório.',
            'curriculo_doc.mime' => 'O Arquivo deve ser em formato PDF',            
            'curriculo_doc.max' => 'O Arquivo de ter no máximo 2MB',
            
            'cpf.unique' =>'Currículo já cadastrado neste CPF.',
            'email.unique' => 'E-mail já cadastrado.',
            'autorizacao_uso_dados.required' => 'É necessária a autorização do uso de dados',
        ];
    }
}
