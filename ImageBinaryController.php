<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageBinaryController extends Controller
{
    //capturando a extensão do binario passado por parâmetro
    public static function getBinaryType ($file){
        return $file->getClientOriginalExtension();
    }

    #função que recebe como parametro um binario do arquivo (obrigatório)
    #parâmetro opcionais: tipo de arquivos suportados e caminho
    #retornando um array com o caminho de acesso da imagem e o flag de sucesso
    /*caso de erro, retorna a flag com sucesso e o código do erro;
     0 se for tipo de arquivo inválido e 1 erro de upload */
    public static function uploadsFromBinary ($binary, $typesAllowed = ['jpg', 'jpeg', 'png'],$path="default") {
            $extension = ImageBinaryController::getBinaryType($binary);
            if (!in_array($extension, $typesAllowed)){
                return ['success' => false, 'codigo' => 0];
            }
            $pathDefault = Storage::put("/public/$path", $binary);
            $pathDefault = str_replace('public', 'storage', $pathDefault);

            return  ['path' => $pathDefault, 'success' => false];
    }
}
