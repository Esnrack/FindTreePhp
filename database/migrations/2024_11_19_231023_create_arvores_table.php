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
        Schema::create('arvores', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome_arvore', 250)->unique();
            $table->text('descricao_botanica');
            $table->text('biologia_reprodutiva');
            $table->text('frutificacao');
            $table->text('dispersao');
            $table->text('ocorrencia_natural');
            $table->text('mapa');
            $table->text('aspectos_ecologicos');
            $table->text('regeneracao_natural');
            $table->text('aproveitamento');
            $table->text('alimentacao');
            $table->text('dados_nutricionais');
            $table->text('formas_consumo');
            $table->text('biotec_energ');
            $table->text('composicao');
            $table->text('poten_bioprodutos');
            $table->text('bioatividade');
            $table->text('paisagismo');
            $table->text('cultivo_viveiro');
            $table->text('colheita_benef_semente');
            $table->text('producao_mudas');
            $table->text('transplante');
            $table->text('cuidados_especiais');
            $table->text('agua');
            $table->text('solos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arvores');
    }
};
