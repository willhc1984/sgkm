
// Receber o seletor do campo preço do fornecedor
let inputPriceForn = document.getElementById('preco_fornecedor');

//Verificar se existe o seletor no HTML
if (inputPriceForn) {
    // Aguardar o usuário digitar valor no campo
    inputPriceForn.addEventListener('input', function () {

        // Obter o valor atual removendo qualquer caractere que não seja número
        let valuePrice = this.value.replace(/[^\d]/g, '');

        // Adicionar os separadores de milhares
        var formattedPrice = (valuePrice.slice(0, -2).replace(/\B(?=(\d{3})+(?!\d))/g, '.')) + '' + valuePrice.slice(-2);

        // Adicionar a vírgula e até dois dígitos se houver centavos
        if (formattedPrice.length > 2) {
            formattedPrice = formattedPrice.slice(0, -2) + ',' + formattedPrice.slice(-2);
        }

        // Atualizar o valor do campo
        this.value = formattedPrice;
    });
}

// Receber o seletor do campo preço da loja
let inputPriceFinal = document.getElementById('preco_final');

//Verificar se existe o seletor no HTML
if (inputPriceFinal) {
    // Aguardar o usuário digitar valor no campo
    inputPriceFinal.addEventListener('input', function () {

        // Obter o valor atual removendo qualquer caractere que não seja número
        let valuePrice = this.value.replace(/[^\d]/g, '');

        // Adicionar os separadores de milhares
        var formattedPrice = (valuePrice.slice(0, -2).replace(/\B(?=(\d{3})+(?!\d))/g, '.')) + '' + valuePrice.slice(-2);

        // Adicionar a vírgula e até dois dígitos se houver centavos
        if (formattedPrice.length > 2) {
            formattedPrice = formattedPrice.slice(0, -2) + ',' + formattedPrice.slice(-2);
        }

        // Atualizar o valor do campo
        this.value = formattedPrice;
    });
}

// Receber o seletor apagar e percorrer a lista de registro
document.querySelectorAll('.btnDelete').forEach(function (button) {
    // Aguardar o clique do usuário no botão apagar
    button.addEventListener('click', function (event) {

        // Bloquear o recarregamento da página
        event.preventDefault();

        // Receber o atributo que possui o id do registro que deve ser excluído
        var deleteId = this.getAttribute('data-delete-id');

        // SweetAlert
        Swal.fire({
            title: 'Tem certeza?',
            text: 'Você não poderá reverter isso!',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#0d6efd',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Sim, excluir!',
        }).then((result) => {
            // Carregar a página responsável em excluír se o usuário confirmar a exclusão
            if (result.isConfirmed) {
                document.getElementById(`formDelete${deleteId}`).submit();
            }
        });

    });

});