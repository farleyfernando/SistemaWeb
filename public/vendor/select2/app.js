$(document).ready(function() {


    $('.contas_receber').select2({
        placeholder: "Nome...",
        allowClear: true,
        "language": {
            "noResults": function() {
                return '<span class="text-danger">Cliente não localizado </span> <a href="' + BASE_URL + 'clientes/adicionar" target="_blank" class="btn btn-primary btn-sm">Cadastrar</a>';
            }
        },
        escapeMarkup: function(markup) {
            return markup;
        }
    });

    $('.forma-pagamento').select2({
        placeholder: "Forma de pagamento",
        allowClear: true,
        "language": {
            "noResults": function() {
                return '<span class="text-danger">Forma não localizado </span> <a href="' + BASE_URL + 'modulo/add" target="_blank" class="btn btn-primary btn-sm">Cadastrar</a>';
            }
        },
        escapeMarkup: function(markup) {
            return markup;
        }
    });

    $('.vendedor').select2({
        placeholder: "Nome",
        allowClear: true,
        "language": {
            "noResults": function() {
                return '<span class="text-danger">Vendedor não localizado </span> <a href="' + BASE_URL + 'vendedores/adicionar" target="_blank" class="btn btn-primary btn-sm">Cadastrar</a>';
            }
        },
        escapeMarkup: function(markup) {
            return markup;
        }
    });

    $('.contas_pagar').select2({
        placeholder: "Nome fanstasia",
        allowClear: true,
        "language": {
            "noResults": function() {
                return '<span class="text-danger">Fornecedor não localizado </span> <a href="' + BASE_URL + 'fornecedores/adicionar" target="_blank" class="btn btn-primary btn-sm">Cadastrar</a>';
            }
        },
        escapeMarkup: function(markup) {
            return markup;
        }
    });

});