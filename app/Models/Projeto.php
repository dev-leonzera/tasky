<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    use HasFactory;

    protected $table = 'projetos';
    protected $guarded = ['id'];

    public function clientes(){
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }

    public function tarefas(){
        return $this->hasMany(Tarefa::class);
    }

    // public function getAtivoAttribute()
    // {
    //     return $this->attributes['ativo'] === 1 ? 'Ativo' : 'Inativo';
    // }
}
