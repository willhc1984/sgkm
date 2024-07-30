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
        Schema::table('produtos', function(Blueprint $table){
            $table->float('lucro_consultor')->after('comissao_consultor')->default(0);
            $table->float('lucro_loja')->after('lucro_consultor')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produtos', function(Blueprint $table){
            $table->dropColumn('lucro_consultor');
            $table->dropColumn('lucro_loja');
        });
    }
};
