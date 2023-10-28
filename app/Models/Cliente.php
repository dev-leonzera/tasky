<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $guarded = ['id'];

    public function getAtivoAttribute()
    {
        return $this->attributes['ativo'] == 1 ? 'Ativo' : 'Inativo';
    }

    public function getTipoAttribute(){
        return $this->attributes['tipo'] == 'pf' ? 'Pessoa Física' : 'Pessoa Jurídica';
    }
}
