<?php

namespace App\Repositories;

use App\Models\Cliente;
use Illuminate\Support\Facades\DB;

class ClienteRepository {

    private $clienteModel;

    public function __construct(Cliente $clienteModel){
        $this->clienteModel = $clienteModel;
    }

    public function listAllClientes(){
        return $this->clienteModel->all();
    }

    public function getCliente($id){
        return $this->clienteModel->find($id);
    }

    public function getCountAllClientes(){
        return $this->clienteModel->all()->count();
    }

    public function storeNewCliente($dados){
        try {
            DB::transaction(function()  use ($dados){
                $this->clienteModel->create($dados);
            });
            return true;
            
        } catch (\Throwable $th) {
            return false;
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
}