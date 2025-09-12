<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

/**
* Write code on Method
*
* @return response()
*/

if (! function_exists('get_estados')) {

    function get_estados($sel='', $tipo=1){

        //echo $sel.'|';

        $opcoes  = '';
        $estados = array('AC','AL','AM','AP','BA','CE','DF','ES','GO','MA','MG','MS','MT','PA','PB','PE','PI','PR','RJ','RN','RO','RR','RS','SC','SE','SP','TO');

        if($tipo === 1){

            foreach ($estados as $uf){
                $check   = ($sel == $uf) ? ' selected="selected"' : '';
                $opcoes .= '<option value="'.$uf.'"'.$check.'>'.$uf.'</option>';
            }

            $lista = $opcoes;

        } else {

            $lista = $sel;

        }

        return $lista;

    }

}

if (! function_exists('get_cidades')) {

    function get_cidades($lista, $tipo = 1) {
        var_dump($lista);
        
        $opcoes = '';
        $cidades = array();
        
        if (count($lista) > 0) {
            foreach ($lista as $value) {
                try {
                    $cidade = null;
                    
                    if ($tipo === 1) {
                        $cidade = $value->location->cidade ?? null;
                    } else if ($tipo === 3) {
                        $cidade = $value->contato->cidade ?? null;
                    } else {
                        $cidade = $value->cidade ?? null;
                    }
                    
                    if ($cidade) {
                        $parts = explode(' ', $cidade);
                        $implode = array();
                        
                        foreach ($parts as $item) {
                            $implode[] = ucfirst($item);
                        }
                        
                        $nome = implode(' ', $implode);
                        $cidades[$nome] = $nome;
                    }
                } catch (\Exception $e) {
                    continue; // Ignora registros com problemas
                }
            }
        }
        
        foreach ($cidades as $value) {
            $opcoes .= '<option value="' . $value . '">' . $value . '</option>';
        }
        
        return $opcoes;
    }

    // function get_cidades($lista, $tipo=1){

    //     $opcoes  = '';
    //     $cidades = array();

    //     if(count($lista) > 0){

    //         foreach($lista as $value){

    //             $implode = array();

    //             if($tipo === 1){
    //                 $parts   = explode(' ', $value->location->cidade);
    //             } else if($tipo === 3){
    //                 $parts   = explode(' ', $value->contato->cidade);
    //             } else {
    //                 $parts   = explode(' ', $value->cidade);
    //             }

    //             var_dump($value);

    //             foreach($parts as $item){
    //                 $implode[] = ucfirst($item);
    //             }
    //             $nome = implode(' ', $implode);
    //             $cidades[$nome] = $nome;

    //         }

    //         ksort($cidades);

    //         foreach($cidades as $cidade){
    //             $opcoes .= '<option value="'.$cidade.'">'.$cidade.'</option>';
    //         }

    //     } else {

    //         $opcoes = '<option value="">Nenhuma cidade encontrada</option>';

    //     }

    //     return $opcoes;

    // }

}



if (! function_exists('limite')) {

    function limite($texto, $limite, $tipo=''){

        if(strlen($texto) <= $limite){

            $res = $texto;

        } else {

            $novo = substr($texto, 0, $limite).'...';

            if($tipo){
                $res = '<'.$tipo.' title="'.$texto.'" class="texto-limitado">'.$novo.'</'.$tipo.'>';
            } else {
                $res = '<span title="'.$texto.'" class="texto-limitado">'.$novo.'</span>';
            }

        }

        return $res;

    }

}

function getPaises()
{
    return ["Afeganistão", "África do Sul", "Albânia", "Alemanha", "Andorra", 
            "Angola", "Antígua e Barbuda", "Arábia Saudita", "Argélia", "Argentina", 
            "Armênia", "Austrália", "Áustria", "Azerbaijão", "Bahamas", "Bahrein", 
            "Bangladesh", "Barbados", "Bélgica", "Belize", "Benim", "Bielorrússia", 
            "Bolívia", "Bósnia e Herzegovina", "Botsuana", "Brasil", "Brunei", 
            "Bulgária", "Burkina Faso", "Burundi", "Butão", "Cabo Verde", "Camarões", 
            "Camboja", "Canadá", "Catar", "Cazaquistão", "Chade", "Chile", "China", 
            "Chipre", "Colômbia", "Comores", "Congo", "Coreia do Norte", "Coreia do Sul", 
            "Costa do Marfim", "Costa Rica", "Croácia", "Cuba", "Dinamarca", "Djibuti", 
            "Dominica", "Egito", "El Salvador", "Emirados Árabes Unidos", "Equador", 
            "Eritreia", "Eslováquia", "Eslovênia", "Espanha", "Estados Unidos", 
            "Estônia", "Eswatini", "Etiópia", "Fiji", "Filipinas", "Finlândia", 
            "França", "Gabão", "Gâmbia", "Gana", "Geórgia", "Granada", "Grécia", 
            "Guatemala", "Guiana", "Guiné", "Guiné Equatorial", "Guiné-Bissau", 
            "Haiti", "Honduras", "Hungria", "Iêmen", "Ilhas Marshall", "Índia", 
            "Indonésia", "Irã", "Iraque", "Irlanda", "Islândia", "Israel", "Itália", 
            "Jamaica", "Japão", "Jordânia", "Kiribati", "Kuwait", "Laos", "Lesoto", 
            "Letônia", "Líbano", "Libéria", "Líbia", "Liechtenstein", "Lituânia", 
            "Luxemburgo", "Macedônia do Norte", "Madagascar", "Malásia", "Maláui", 
            "Maldivas", "Mali", "Malta", "Marrocos", "Maurícia", "Mauritânia", 
            "México", "Micronésia", "Moçambique", "Moldávia", "Mônaco", "Mongólia", 
            "Montenegro", "Myanmar", "Namíbia", "Nauru", "Nepal", "Nicarágua", 
            "Níger", "Nigéria", "Noruega", "Nova Zelândia", "Omã", "Países Baixos", 
            "Palau", "Panamá", "Papua-Nova Guiné", "Paquistão", "Paraguai", "Peru", 
            "Polônia", "Portugal", "Quênia", "Quirguistão", "Reino Unido", 
            "República Centro-Africana", "República Democrática do Congo", 
            "República Dominicana", "Romênia", "Ruanda", "Rússia", "Samoa", 
            "San Marino", "Santa Lúcia", "São Cristóvão e Névis", "São Tomé e Príncipe", 
            "São Vicente e Granadinas", "Seicheles", "Senegal", "Serra Leoa", 
            "Sérvia", "Singapura", "Síria", "Somália", "Sri Lanka", "Sudão", 
            "Sudão do Sul", "Suécia", "Suíça", "Suriname", "Tailândia", "Taiwan", 
            "Tajiquistão", "Tanzânia", "Timor-Leste", "Togo", "Tonga", "Trinidad e Tobago", 
            "Tunísia", "Turcomenistão", "Turquia", "Tuvalu", "Ucrânia", "Uganda", 
            "Uruguai", "Uzbequistão", "Vanuatu", "Vaticano", "Venezuela", "Vietnã", 
            "Zâmbia", "Zimbábue"];
}