<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
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

    public function store(StoreClienteRequest $request){
        $input = $request->validated();

        
        $dados = [
            'nome' => $input['nome'],
            'tipo' => $input['tipo'],
            'dia_vencimento' => $input['dia_vencimento'],
            'data_contrato' => now()
        ];

        $result = $this->clienteRepository->storeNewCliente($dados);

        if($result){
            return $this->index();
        }
    }

    public function edit($id){
        $cliente = $this->clienteRepository->getCliente($id);

        return Inertia::render('Clientes/Edit', compact('cliente'));
    }

    public function update($id, UpdateClienteRequest $request){
        $data = $request->validated();

        $result = $this->clienteRepository->updateCliente($id, $data);

        if($result){
            
            return $this->index();
        }
    }

    public function show($id){
        $cliente = $this->clienteRepository->getCliente($id);

        // dd($cliente);

        return Inertia::render('Clientes/Show', compact('cliente'));
    }

    public function destroy($id){
        $result = $this->clienteRepository->deleteCliente($id);

        if($result){            
            return $this->index();
        }
    }

    public function toggleActiveCliente($id){
        $result = $this->clienteRepository->toggleActiveCliente($id);

        if($result){
            $this->index();
        }
    }
}
