<!-- Modal -->
<div class="modal fade" id="alterarConsultorModal" tabindex="-1" aria-labelledby="alterarConsultorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('produtos.alterar.consultor') }}" method="POST">
      @csrf
      <input type="hidden" name="consultor_atual" value="{{ request('consultor') }}">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="alterarConsultorModalLabel">Alterar Consultor</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger" role="alert">
                <b>AVISO:</b> Será alterado o consultor de todos os produtos da exibição atual! 
            </div>
          <div class="mb-3">
            <label for="novo_consultor" class="form-label">Novo Consultor</label>
            <select class="form-select" name="novo_consultor" required>
              @foreach($consultores as $consultor)
                <option value="{{ $consultor->id }}">{{ $consultor->nome }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Alterar</button>
        </div>
      </div>
    </form>
  </div>
</div>
