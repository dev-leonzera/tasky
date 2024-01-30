<?php

namespace App\Utils;

use Carbon\Carbon;

class GenerateDataVencimento{
    public static function generate($diaVencimento){
        $diaAtual = Carbon::now()->get('day');
        $mesVencimento = Carbon::now()->get('month');
        if($diaVencimento < $diaAtual){
            $dataFinal = Carbon::createFromDate(null, $mesVencimento, $diaVencimento)->addMonth()->toDateString();
        } else {
            $dataFinal = Carbon::createFromDate(null, $mesVencimento, $diaVencimento)->toDateString();
        }
        
        return $dataFinal;
    }
}