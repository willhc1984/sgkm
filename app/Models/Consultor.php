<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultor extends Model
{
    use HasFactory;

    protected $table = 'consultores';

    protected $fillable = ['nome', 'contato'];

    public $timestamps = false;

    //Criar relacionamento 1:N
    public function produtos(){
        return $this->hasMany(Produto::class);
    }
}
