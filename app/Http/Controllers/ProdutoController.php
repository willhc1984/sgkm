<?php

namespace App\Http\Controllers;

use App\Models\Consultor;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    //Listar produtos do consultor
    public function index(Consultor $consultor){
        $produtos = Produto::with('consultor')
            ->where('consultor_id', $consultor->id)
            ->orderBy('nome')->paginate(10);
        
        return view('produtos.index', [
            'produtos' => $produtos,
            'consultor' => $consultor
        ]);
    }
}
