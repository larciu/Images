<?php

namespace App\Http\Controllers;

use Google\Service\AdMob\Date;
use Illuminate\Http\Request;

class DateController extends Controller
{
    protected static $months =  array(
        1 => 'Janeiro',
        'Fevereiro',
        'Março',
        'Abril',
        'Maio',
        'Junho',
        'Julho',
        'Agosto',
        'Setembro',
        'Outubro',
        'Novembro',
        'Dezembro'
    );

    protected static $months_abb = array(
        1 => 'Jan',
        'Fev',
        'Mar',
        'Abr',
        'Mai',
        'Jun',
        'Jul',
        'Ago',
        'Set',
        'Out',
        'Nov',
        'Dez'
    );
    //esse metódo tem como intuito receber uma datetime ou timestamp no formato AMERICANO.
    //E, de forma opcional, o formato do mês(O nome completo ou abreviado).
    //se o formato for uma string maior que três caracteres será o nome completo, senão abreviado.
    public static function MonthFromNumber ($date, $format = "AGOSTO"){
        $month = date('m', strtotime($date));
        $month = $month[0] == '0' ? str_replace('0', '', $month) : $month;
        if (strlen($format) > 3){
            return DateController::$months[$month];
        }

        return DateController::$months_abb[$month];
    }
}
