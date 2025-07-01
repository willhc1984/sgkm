<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsultorRequest;
use App\Models\Consultor;
use App\Models\Produto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultorController extends Controller
{

    //Executar o construct com middleware de autenticação e permissão
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:index-consultores', ['only' => ['index']]);
        $this->middleware('permission:show-consultores', ['only' => ['show']]);
        $this->middleware('permission:create-consultores', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-consultores', ['only' => ['edit', 'update']]);
        $this->middleware('permission:destroy-consultores', ['only' => ['destroy']]);
        $this->middleware('permission:atualizar-comissao', ['only' => ['atualizarComissao']]);
        $this->middleware('permission:alocar-consultor-em-massa', ['only' => ['alocarEmMassa']]);
    }

    //Listar consultores
    public function index()
    {
        //Recuperar registros de consultores
        $consultores = Consultor::orderBy('nome')->paginate(15);
        return view('consultores.index', [
            'consultores' => $consultores,
            'menu' => 'consultores'
        ]);
    }

    //Formulário para consultor
    public function create()
    {
        return view('consultores.create');
    }

    //Cadastrar consultor no banco de dados
    public function store(ConsultorRequest $request)
    {
        //Valida formulario de cadastro
        $request->validated();
        //Inicio da transação
        DB::beginTransaction();

        try {
            $consultor = Consultor::create([
                'nome' => $request->nome,
                'contato' => $request->contato,
                'email' => $request->email
            ]);
            //Operação concluida com exito
            Db::commit();
            //Redireciona com msg de sucesso
            return redirect()->route('consultor.index')->with('success', 'Consultor(a) cadastrado!');
        } catch (Exception $e) {
            //Operação não concluida
            DB::rollBack();
            //Redireciona com msg de erro
            return back()->withInput()->with('error', 'Consultor(a) não cadastrado! Tente novamente.' . $e->getMessage());
        }
    }

    //Editar consultor
    public function edit(Consultor $consultor)
    {
        return view('consultores.edit', ['consultor' => $consultor]);
    }

    //Atualizar consultor no banco de dados
    public function update(ConsultorRequest $request, Consultor $consultor)
    {
        //Validação dos campos do formulario.
        $request->validated();
        //Marca ponto inicial da transação
        DB::beginTransaction();

        try {
            //Atualiza no banco de dados
            $consultor->update([
                'nome' => $request->nome,
                'contato' => $request->contato,
                'email' => $request->email
            ]);

            //Operação concluida com exito
            DB::commit();

            //Redirecionar usuario
            return redirect()->route('consultor.index')->with('success', 'Consultor(a) atualizado!');
        } catch (Exception $e) {
            //Operação não concluida
            DB::rollBack();
            //Retorno com mensagem de erro
            return back()->withInput()->with('error', 'Consultor(a) não atualizado! Tente novamente');
        }
    }

    //Excluir consultores
    public function destroy(Consultor $consultor)
    {
        //Exclui regitro
        try {
            $consultor->delete();
            //Redireciona usuario com msg de successo
            return redirect()->route('consultor.index')->with('success', 'Consultor excluído!');
        } catch (Exception $e) {
            //Redireciona usuario com mensagem de erro
            return redirect()->route('consultor.index')->with('error', 'Consultor não excluído! Talvez haja produtos alocados para este consultor(a).');
        }
    }

    //Altera a comissão do consultor
    public function atualizarComissao(Request $request)
    {
        $request->validate([
            'consultor_id' => 'required|exists:consultores,id',
            'nova_comissao' => 'required|numeric|min:0|max:100',
        ]);

        $consultorId = $request->consultor_id;
        $novaComissao = $request->nova_comissao;

        $produtos = Produto::where('consultor_id', $consultorId)->get();
        $consultor = Consultor::find($consultorId);

        foreach ($produtos as $produto) {
            $produto->comissao_consultor = $novaComissao;
            $produto->lucro_consultor = $produto->preco_final * ($novaComissao / 100);
            $produto->lucro_loja = $produto->preco_final - $produto->preco_fornecedor - $produto->lucro_consultor;
            $produto->save();
        }

        return redirect()->route('consultor.index')->with('success', 'Comissão atualizada com sucesso para todos os produtos do consultor: <strong>' . $consultor->nome . '</strong>');
    }

    //Alocar produtos diversos, separados por ponto e virgula
    public function alocarEmMassa()
    {
        //Recupera consultores no banco de dados
        $consultores = Consultor::orderBy('nome')->get();

        return view('consultores.alocar-em-massa', [
            'consultores' => $consultores
        ]);
    }

    //Atualizar produtos alocados
    public function alocarEmMassaUpdate(Request $request)
    {
        //Valida formulario
        $request->validate([
            'codigos' => 'required|string',
            'novo_consultor' => 'required'
        ]);

        $consultorId = $request->input('novo_consultor'); // ID do consultor selecionado

        //Pega os id's digitados e transforma e array (collection)
        $ids = collect(explode(';', $request->codigos))
            ->map(fn($item) => trim($item))
            ->filter()
            ->unique();

        //Busca ids que existem no banco de dados 
        $idsExistentes = Produto::whereIn('id', $ids)->pluck('id');

        //Compara para descobrir os inexistentes
        $idsInexistentes = $ids->diff($idsExistentes);

        if ($idsInexistentes->isNotEmpty()) {
            return redirect()->back()
                ->with('error', 'Os seguintes códigos não existem no sistema: ' . $idsInexistentes->implode(', '))
                ->withInput();
        }

        // Se todos os IDs existem, atualiza os produtos
        Produto::whereIn('id', $ids)->update([
            'consultor_id' => $consultorId
        ]);

        return redirect()->back()->with('success', 'Produtos alocados com sucesso!');
    }
}
