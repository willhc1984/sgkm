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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->float('preco_fornecedor');
            $table->float('preco_loja');
            $table->float('preco_consultor');
            $table->string('situacao');
            $table->timestamp('data_venda');
            $table->integer('qtde');
            $table->foreignId('consultor_id')->constrained('consultores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
