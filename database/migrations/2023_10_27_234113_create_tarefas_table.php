<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tarefas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('projeto_id')->references('id')->on('projetos');
            $table->string('titulo');
            $table->text('descricao');
            $table->date('inicio');
            $table->boolean('feita')->default(false);
            $table->date('prazo_entrega'); // Data em que a tarefa precisa ser entregue
            $table->date('data_entrega');  // Data que a tarefa foi entregue
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarefas');
    }
};
