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
}