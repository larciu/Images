<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GenerateCodeController extends Controller
{
    #função que recebe um intervalo de valores NÚMERICOS  e retorna um array com numeros aleatórios sorteados
    #o excepts são as exceções desse intervalo que não fará parte do sorteio
    # amount é a quantidade de números sorteados que se quer obter
    public static function generateCodeNumber ($start, $end, $excepts = [], $amount = 1){
        $elements = [];

        for ($i = $start; $i <= $end; $i++){
            $elements [] = $i;
        }

        $resultElements = array_diff($elements, $excepts);
        $random_keys = array_rand($resultElements, $amount);
        $returnElements = [];

        if (is_array($random_keys)){
            foreach ($random_keys as $random_key){
                $returnElements[] = $elements[$random_key];
            }
        }
        else{
            $returnElements = [$elements[$random_keys]];
        }

        return $returnElements;

    }
}
