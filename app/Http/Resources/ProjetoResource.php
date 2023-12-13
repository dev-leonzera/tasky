<?php

namespace App\Http\Resources;

use App\Models\Cliente;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjetoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'cliente' => Cliente::find($this->cliente_id)->nome,
            'titulo' => $this->titulo,
            'orcamento' => $this->orcamento,
            'data_inicio' => $this->data_inicio,
            'data_entrega' => $this->data_entrega,
        ];
    }
}
