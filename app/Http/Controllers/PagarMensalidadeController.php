<?php

namespace App\Http\Controllers;

use App\Models\Mensalidade;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PagarMensalidadeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
        $mensalidade = Mensalidade::find($id);
        $mensalidade->pago = 1;
        $mensalidade->data_pagamento = now();
        $mensalidade->save();

        return redirect()->back();
    }
}
