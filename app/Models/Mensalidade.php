<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensalidade extends Model
{
    protected $table = 'mensalidades';
    protected $guarded = ['id'];

    public function getPagoAttribute(){
        return $this->attributes['pago'] == 1 ? 'Sim' : 'Não';
    }
}
