<?php

namespace App\Repositories;

use App\Models\Projeto;
use Illuminate\Support\Facades\DB;

class ProjetoRepository{

    private $projeto;

    public function __construct(Projeto $projeto){
        $this->projeto = $projeto;
    }

    public function getAllProjetos(){
        return $this->projeto->paginate(10);
    }

    public function getCountProjetos(){
        return $this->projeto->all()->count();
    }

    public function storeNewProjeto($dados){
        DB::transaction(function () use ($dados){
            $this->projeto->create($dados);
            return true;
        });
        return false;
    }

    public function getProjeto($id){
        return $this->projeto->with('clientes')->find($id);
    }

    public function updateProjeto($id, $dados){
        $projeto = $this->projeto->find($id);
        DB::transaction(function() use ($projeto, $dados){
            $projeto->update($dados);
            return true;
        });
    }

    public function deleteProjeto($id){
        $projeto = $this->projeto->find($id);

        DB::transaction(function() use ($projeto){
            $projeto->delete();
            return true;
        });
        return false;
    }
}