<div class="modal fade" id="modalComissao" tabindex="-1" aria-labelledby="modalComissaoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('consultor.atualizarComissao') }}">
            @csrf
            <input type="hidden" name="consultor_id" id="consultorIdInput">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Atualizar Comissão do Consultor: <strong id="nomeConsultorModal"></strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="alert alert-warning" role="alert">
                        <b>Obs..:</b> A comissão informada será aplicada a todos os produtos alocados para o consultor. 
                    </div>
                    <label>Nova comissão (%)</label>
                    <input type="number" name="nova_comissao" class="form-control" required step="0.01" min="0">
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Atualizar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('modalComissao');
    modal.addEventListener('show.bs.modal', function (event) {
        const trigger = event.relatedTarget;
        const consultorId = trigger.getAttribute('data-consultor-id');
        const consultorNome = trigger.getAttribute('data-consultor-nome');
        document.getElementById('consultorIdInput').value = consultorId;
        document.getElementById('nomeConsultorModal').textContent = consultorNome;
    });
});
</script>
