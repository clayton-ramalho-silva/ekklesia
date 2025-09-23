<?php

namespace App\Http\Requests\Interview;

use Illuminate\Foundation\Http\FormRequest;

class StoreInterviewRequest extends FormRequest
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
            'outros_idiomas' => 'nullable|string',
            'apresentacao_pessoal' => 'nullable|string',
            'saude_candidato' => 'nullable|string|max:255',
            'vacina_covid' => 'nullable|string|max:255',
            'qual_formadora' => 'nullable|string',
            'experiencia_profissional' => 'nullable|string',
            'qual_motivo_demissao' => 'nullable|string',
            'caracteristicas_positivas' => 'nullable|string',
            'habilidades' => 'nullable|string',
            'pontos_melhoria' => 'nullable|string',
            'rotina_candidato' => 'nullable|string',
            'disponibilidade_horario' => 'nullable|string',
            'familia' => 'nullable|string',
            'renda_familiar' => 'nullable|string|max:255',            
            'familia_cras' => 'nullable|string|max:255',
            'objetivo_longo_prazo' => 'nullable|string',
            'porque_ser_jovem_aprendiz' => 'nullable|string',
            'fonte_curriculo' => 'nullable|string|max:255',
            'perfil_santa_casa' => 'nullable|string|max:255',
            'classificacao' => 'nullable|string|max:255',
            'parecer_recrutador' => 'nullable|string', // Parecer RH
            'observacoes' => 'nullable|string', // Entrevistas
            'obs_rh' => 'nullable|string', // Observações RH
            'tipo_beneficio' => 'nullable|string|max:255',
            'resume_id' => [
                'required',
                'exists:resumes,id',
                function ($attribute, $value, $fail) {
                    if (\App\Models\Interview::where('resume_id', $value)->exists()) {
                        $fail('Já existe uma entrevista cadastrada para este currículo.');
                    }
                },
            ],
            //'perfil' => 'nullable|string|max:255',
            //'curso_extracurricular' => 'nullable|string',
            //'pretencao_candidato' => 'nullable|string',
            //'sobre_candidato' => 'nullable|string',
            //'sugestao_empresa' => 'nullable|string',
            //'pontuacao' => 'nullable|string|max:255', 
        ];
    }

    public function messages()
    {
        return [
            'resume_id.required' => 'O currículo é obrigatório.',
            'resume_id.exists' => 'Currículo não encontrado.',
            // outras mensagens...
        ];
    }
}
