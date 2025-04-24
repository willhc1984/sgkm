@props(['produto'])

@php    
    $imagens = array_filter(explode(',', $produto->images ?? '')); //remove vazios
@endphp

<!-- Modal -->
<div class="modal fade" id="modalProduto{{ $produto->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $produto->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel{{ $produto->id }}">Imagens de {{ $produto->nome }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body d-flex flex-wrap gap-2 justify-content-center">
                @if(count($imagens) > 0)
                    @foreach($imagens as $img)
                        <img src="{{ trim($img) }}" alt="Imagem do produto" class="img-thumbnail" style="width: 250px; height: auto;">
                    @endforeach
                    @else
                        <div class="text-muted">
                            Nenhuma imagem cadastrada para este produto.
                        </div>
                @endif
            </div>
        </div>
    </div>
</div>