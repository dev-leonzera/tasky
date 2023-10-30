<?php

namespace App\Repositories;

use App\Models\Cliente;

class ClienteRepository {

    private $clienteModel;

    public function __construct(Cliente $clienteModel){
        $this->clienteModel = $clienteModel;
    }

    public function listAllClientes(){
        return $this->clienteModel->all();
    }

    public function getCountAllClientes(){
        return $this->clienteModel->all()->count();
    }

    public function createCliente($dados){
        $cliente = $this->clienteModel->create($dados);
        return $cliente;
    }
}