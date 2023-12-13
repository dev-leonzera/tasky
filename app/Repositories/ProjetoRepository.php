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
        try{
            DB::transaction(function () use ($dados){
                $this->projeto->create($dados);
            });

            return true;
        } catch(\Throwable $th){
            return false;
        }
    }
}