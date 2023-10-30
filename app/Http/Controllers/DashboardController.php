<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Repositories\ClienteRepository;


class DashboardController extends Controller
{
    private $clienteRepository;

    public function __construct(ClienteRepository $clienteRepository){
        $this->clienteRepository = $clienteRepository;
    }

    public function index(){
        $countClientes = $this->clienteRepository->getCountAllClientes();
        return Inertia::render('Dashboard', compact('countClientes'));
    }
}
