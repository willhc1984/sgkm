<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    protected $fillable = ['nome', 'preco_fornecedor', 'preco_loja', 'preco_consultor',
        'situacao', 'data_venda', 'qtd', 'consultor_id'];

    public $timestamps = false;

    //Criar relacionamento 1:N
    public function consultor(){
        return $this->belongsTo(Consultor::class);
    }
}
