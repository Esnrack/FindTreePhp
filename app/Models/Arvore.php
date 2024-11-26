<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arvore extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome_arvore',
        'descricao_botanica',
        'biologia_reprodutiva',
        'frutificacao',
        'dispersao',
        'ocorrencia_natural',
        'mapa',
        'aspectos_ecologicos',
        'regeneracao_natural',
        'aproveitamento',
        'alimentacao',
        'dados_nutricionais',
        'formas_consumo',
        'biotec_energ',
        'composicao',
        'poten_bioprodutos',
        'bioatividade',
        'paisagismo',
        'cultivo_viveiro',
        'colheita_benef_semente',
        'producao_mudas',
        'transplante',
        'cuidados_especiais',
        'agua',
        'solos'
    ];

    public function imagens()
    {
        return $this->hasMany(ImagensArvore::class, 'arvore_id', 'id');
    }
}
