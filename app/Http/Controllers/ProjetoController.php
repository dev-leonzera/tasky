<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjetoRequest;
use App\Http\Requests\UpdateProjetoRequest;
use App\Http\Resources\ProjetoResource;
use App\Repositories\ClienteRepository;
use App\Repositories\ProjetoRepository;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjetoController extends Controller
{
    private $projetoRepository;

    public function __construct(ProjetoRepository $projetoRepository){
        $this->projetoRepository = $projetoRepository;
    }

    public function index(){
        $projetos = ProjetoResource::collection($this->projetoRepository->getAllProjetos());        
        return Inertia::render('Projetos/Index', compact('projetos'));
    }

    public function show($id){
        $projeto = $this->projetoRepository->getProjeto($id);

        return Inertia::render('Projetos/Show', compact('projeto'));
    }

    public function create(){
        $clientes = Cliente::all();

        return Inertia::render('Projetos/Create', compact('clientes'));
    }

    public function store(StoreProjetoRequest $request){
        $input = $request->validated();

        $projeto = [
            'cliente_id' => $input['cliente_id'],
            'titulo' => $input['titulo'],
            'descricao' => $input['descricao'],
            'orcamento' => $input['orcamento'],
            'data_inicio' => $input['data_inicio'],
            'data_entrega' => $input['data_entrega'],
        ];

        $result = $this->projetoRepository->storeNewProjeto($projeto);

        if ($result === true){
            return $this->index();
        }
    }

    public function edit($id){
        $projeto = $this->projetoRepository->getProjeto($id);

        return Inertia::render('Projetos/Edit', compact('projeto'));
    }

    public function update($id, UpdateProjetoRequest $request){
        $result = $this->projetoRepository->updateProjeto($id, $request->validated());

        if ($result === true){
            return $this->index();
        }
    }

    public function destroy($id){
        $result = $this->projetoRepository->deleteProjeto($id);

        if ($result === true){
            return $this->index();
        }
    }
}
