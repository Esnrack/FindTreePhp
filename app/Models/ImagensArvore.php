<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagensArvore extends Model
{
    use HasFactory;

    protected $table = 'imagens_arvore';

    protected $fillable = [
        'arvore_id',
        'imagem',
        'descricao'
    ];

    public function arvore()
    {
        return $this->belongsTo(Arvore::class, 'arvore_id', 'id');
    }
}