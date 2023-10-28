<?php

namespace App\Http\Controllers;

use App\Repositories\ClienteRepository;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClienteController extends Controller
{
    private $clienteRepository;

    public function __construct(ClienteRepository $clienteRepository){
        $this->clienteRepository = $clienteRepository;
    }

    public function index(){
        $clientes = $this->clienteRepository->listAllClientes();
        return Inertia::render('Clientes/Index', compact('clientes'));
    }
}
