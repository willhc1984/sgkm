<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>S.G.K.M - Produtos</title>
</head>

<body styles="font-size: 12px">
    <h2 style="text-align: center">Produtos</h2>

    <table style="border-collapse: collapse; width: 100%">
        <thead>
            <tr style="background-color: #adb5bd">
                <th style="border: 1px solid #ccc;">Nome</th>
                <th style="border: 1px solid #ccc;">Preço-Final</th>
                <th style="border: 1px solid #ccc;">Consultor</th>
                <th style="border: 1px solid #ccc;">Comissão</th>
                <th style="border: 1px solid #ccc;">Lucro Consultor</th>
                <th style="border: 1px solid #ccc;">Data da venda</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($produtos as $produto)
                <tr>
                    <td style="border: 1px solid #ccc; text-align: center">{{ $produto->nome }}</td>
                    <td style="border: 1px solid #ccc; text-align: center">
                        {{ 'R$ ' . number_format($produto->preco_final, 2, ',', '.') }}</td>
                    <td style="border: 1px solid #ccc; text-align: center">{{ $produto->consultor->nome }}</td>
                    <td style="border: 1px solid #ccc; text-align: center">{{ $produto->comissao_consultor }} %</td>
                    <td style="border: 1px solid #ccc; text-align: center">
                        {{ 'R$ ' . number_format($produto->lucro_consultor, 2, ',', '.') }}</td>
                    <td style="border: 1px solid #ccc; text-align: center">
                        {{ \Carbon\Carbon::parse($produto->data_venda)->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Nenhum produto encontrado!</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p class="text-center"> Total de produtos: <b><span class="badge bg-success"> {{ $produtos->count() }}
            </span></b></p>
    <p class="text-center"> Total bruto: <b><span class="badge bg-success"> R$
                {{ number_format($produtos->sum('preco_final'), 2, ',', '.') }} </span></b></p>
    <p class="text-center"> Comissão total do consultor(a): <b><span class="badge bg-success">R$
                {{ number_format($produtos->sum('lucro_consultor'), 2, ',', '.') }} </i></b>
    </p>

</body>


</html>
