<?php

namespace App\Utils;

use App\Models\Mensalidade;

class GenerateMensalidades{
    public static function generate($clienteId, $diaVencimento){        
        Mensalidade::create([
            'cliente_id' => $clienteId,
            'data_vencimento' => GenerateDataVencimento::generate($diaVencimento),
            'pago' => false,
            'data_pagamento' => null
        ]);
    }
}