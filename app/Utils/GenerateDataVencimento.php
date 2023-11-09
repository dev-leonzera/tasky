<?php

namespace App\Utils;

use Carbon\Carbon;

class GenerateDataVencimento{
    public static function generate($dia){
        $dataAtual = Carbon::now();

        $dataSeguinte = $dataAtual->addMonth();
        $dataFinal = $dataSeguinte->setDay($dia);
        $dataFormatada = $dataFinal->toDateString();

        return $dataFormatada;
    }
}