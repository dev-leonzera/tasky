<?php

namespace App\Repositories;

use App\Models\Cliente;
use App\Models\Mensalidade;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClienteRepository {

    private $clienteModel;

    public function __construct(Cliente $clienteModel){
        $this->clienteModel = $clienteModel;
    }

    public function listAllClientes(){
        return $this->clienteModel->where('user_id', Auth::user()->id)->get();
    }

    public function getCliente($id){
        return $this->clienteModel->with('mensalidades')->find($id);
    }

    public function getCountAllClientes(){
        return $this->clienteModel->where('user_id', Auth::user()->id)->count();
    }

    public function storeNewCliente($dados){
        try {
            DB::transaction(function()  use ($dados){
                $this->clienteModel->create($dados);
            });
            return true;
            
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function updateCliente($id, $data){
        try {
            $cliente = $this->clienteModel->find($id);
            DB::transaction(function() use ($cliente, $data){
                $cliente->update($data);
            });
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function deleteCliente($id){
        try {
            $cliente = $this->clienteModel->find($id);
            DB::transaction(function() use ($cliente) {
              $cliente->delete();
            });
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function toggleActiveCliente($id){
        try {
            $cliente = $this->clienteModel->find($id);
            
            DB::transaction(function() use ($cliente) {
                if($cliente->ativo === "Inativo"){
                    $cliente->ativo = 1;
                } else {
                    $cliente->ativo = 0;
                }
                $cliente->save();
            });

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getMensalidadesVencendo(){
        $dataAtual = Carbon::now();
        $dataVencimentoLimite = $dataAtual->copy()->addDays(5);

        $mensalidades = Mensalidade::with('cliente')->whereDate('data_vencimento', '>=', $dataAtual)
        ->whereDate('data_vencimento', '<=', $dataVencimentoLimite)
        ->where('pago', '=', 0)
        ->get();

        return $mensalidades;
    }
}