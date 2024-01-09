<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Repositories\ClienteRepository;
use App\Repositories\ProjetoRepository;

class DashboardController extends Controller
{
    private $clienteRepository;
    private $projetoRepository;

    public function __construct(ClienteRepository $clienteRepository, ProjetoRepository $projetoRepository){
        $this->clienteRepository = $clienteRepository;
        $this->projetoRepository = $projetoRepository;
    }

    public function index(){
        $countClientes = $this->clienteRepository->getCountAllClientes();
        $countProjetos = $this->projetoRepository->getCountProjetos();       

        $projetos = $this->projetoRepository->getProjetosAtrasando();
        $mensalidades = $this->clienteRepository->getMensalidadesVencendo();
        
        return Inertia::render('Dashboard', 
            compact(
                'countClientes', 
                'countProjetos',
                'mensalidades',
                'projetos'
            ));
    }
}
