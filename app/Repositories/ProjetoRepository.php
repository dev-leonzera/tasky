<?php

namespace App\Repositories;

use App\Models\Projeto;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

    public function getProjetosAtrasando(){
        $dataAtual = Carbon::now();
        $dataVencimentoLimite = $dataAtual->copy()->addDays(5);

        $projetos = $this->projeto->with('clientes')->whereDate('data_entrega', '>=', $dataAtual)
        ->whereDate('data_entrega', '<=', $dataVencimentoLimite)
        ->where('ativo', '=', 1)
        ->get();

        return $projetos;
    }
}