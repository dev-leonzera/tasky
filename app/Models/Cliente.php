<?php

namespace App\Models;

use App\Utils\GenerateDataVencimento;
use App\Utils\GenerateMensalidades;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $guarded = ['id'];

    protected static function boot(){
        parent::boot();

        static::created(function($cliente){
            if($cliente->mensalista === true){
                GenerateMensalidades::generate($cliente->id, $cliente->dia_vencimento);
            }
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
