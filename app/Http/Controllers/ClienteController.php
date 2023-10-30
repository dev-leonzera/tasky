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

    public function create(){
        return Inertia::render('Clientes/Create');
    }

    public function store(Request $request){
        $dados = [
            'nome' => $request->nome,
            'tipo' => $request->tipo,
            'data_contrato' => now(),
            'documento' => $request->documento
        ];

        $cliente = $this->clienteRepository->createCliente($dados);

        return Inertia::render('Clientes/Index');
    }
}
