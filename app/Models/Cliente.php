<?php

namespace App\Models;

use App\Utils\GenerateDataVencimento;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $guarded = ['id'];

    protected static function boot(){
        parent::boot();

        static::created(function($cliente){
            Mensalidade::create([
                'cliente_id' => $cliente->id,
                'data_vencimento' => GenerateDataVencimento::generate($cliente->dia_vencimento),
                'pago' => false,
                'data_pagamento' => null
            ]);
        });
    }

    public function mensalidades(){
        return $this->hasMany(Mensalidade::class);
    }

    public function projetos(){
        return $this->hasMany(Projeto::class);
    }

    public function getAtivoAttribute()
    {
        return $this->attributes['ativo'] == 1 ? 'Ativo' : 'Inativo';
    }

    public function getTipoAttribute(){
        return $this->attributes['tipo'] == 'pf' ? 'Pessoa Física' : 'Pessoa Jurídica';
    }
}
