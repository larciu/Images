<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageBinaryController extends Controller
{
    private static $typeAllowedAlls = ['png', 'jpg', 'jpeg', 'pdf', 'docx', 'doc', 'xlsx', 'xls','svg'];
    //capturando a extensão do binario passado por parâmetro
    public static function getBinaryType ($file){
        return $file->getClientOriginalExtension();
    }

    #função que recebe como parametro um binario do arquivo (obrigatório)
    #parâmetro opcionais: tipo de arquivos suportados e caminho
    #retornando um array com o caminho de acesso da imagem e o flag de sucesso
    //upload  das imagens que ficarão na pasta storage dentro do public
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

    //caso você queira colocar o nome de forma automatica nesse arquivo, use essa função
    //Nesse caso, é preciso passar a extensão do arquivo que será verificada se pode upar ou não
    //upload  das imagens que ficarão na pasta storage dentro do public
    public static function uploadsFromBinaryWithName ($binary, $extension,$path="default") {
        if (!in_array($extension, ImageBinaryController::$typeAllowedAlls)){
            return ['success' => false, 'codigo' => 0];
        }
        $name = uniqid(date('HisYmd'));
        $imageName = $name . '.' . $extension;
        $pathImage = "uploads/$path/" . $imageName;
        Storage::disk('public')->put($pathImage, $binary);
        $pathImage = "/storage/$pathImage";

        return  ['path' => $pathImage, 'success' => false];
    }

    //excluindo a imagem.
    //só as imagens que estão na pasta storage dentro do public
    public static function deleteFromBinary ($path) {
        $pathImage = str_replace('/storage', '', $path);
        $pathImage = Storage::disk('public')->delete($pathImage);
        return  ['success' => $pathImage, 'success' => false];
    }
}
