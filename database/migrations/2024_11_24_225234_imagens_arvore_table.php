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
        Schema::create('imagens_arvore', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('imagem');
            $table->text('descricao');
            $table->unsignedBiginteger('arvore_id'); 

            $table->foreign('arvore_id')->references('id')
                 ->on('arvores')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagens_arvore');
    }
};
