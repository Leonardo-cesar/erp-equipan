var format = function (num) {
    var str = num.toString().replace("$", ""), parts = false, output = [], i = 1, formatted = null;
    if (str.indexOf(".") > 0) {
        parts = str.split(".");
        str = parts[0];
    }
    str = str.split("").reverse();
    for (var j = 0, len = str.length; j < len; j++) {
        if (str[j] != ",") {
            output.push(str[j]);
            if (i % 3 == 0 && j < (len - 1)) {
                output.push(",");
            }
            i++;
        }
    }
    formatted = output.reverse().join("");
    return (formatted + ((parts) ? "," + parts[1].substr(0, 2) : ""));
};

function formatReal(mixed) {
    var int = parseInt(mixed.toFixed(2).toString().replace(/[^\d]+/g, ''));
    var tmp = int + '';
    tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
    if (tmp.length > 6)
        tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

    return tmp;
}
;

function formatdata(dateObject) {
    var data = dateObject.split("-");
    var date = data[2] + "/" + data[1] + "/" + data[0];

    return date;
}

function formatdataTime(dateObject) {
    var data = dateObject.split("-");
    var dt = data[2].split(" ");
    var date = dt[0] + "/" + data[1] + "/" + data[0] + ' às ' + dt[1];

    return date;
}

function table() {

    $.tablesorter.themes.bootstrap = {
        table: 'table table-bordered table-striped',
        caption: 'caption',
        header: 'bootstrap-header',
        sortNone: '',
        sortAsc: '',
        sortDesc: '',
        active: '',
        hover: '',
        icons: '',
        iconSortNone: 'bootstrap-icon-unsorted',
        iconSortAsc: 'glyphicon glyphicon-chevron-up',
        iconSortDesc: 'glyphicon glyphicon-chevron-down',
        filterRow: '',
        footerRow: '',
        footerCells: '',
        even: '',
        odd: ''
    };

    $(".TableJquery").tablesorter({
        theme: "bootstrap",
        widthFixed: true,
        headerTemplate: '{content} {icon}',
        widgets: ["uitheme", "filter", "zebra"],
        widgetOptions: {
            zebra: ["even", "odd"],
            filter_reset: ".reset",
            filter_cssFilter: "form-control"
        }
    });
    $(".TableJquery").tablesorterPager({
        container: $(".ts-pager"),
        cssGoto: ".pagenum",
        removeRows: false,
        output: '{startRow} - {endRow} / {filteredRows} ({totalRows})'
    });
}

function pad(str, max) {
    str = str.toString();
    return str.length < max ? pad("0" + str, max) : str;
}


$("#UsuarioDataAniversario").mask("99/99/9999");
$(".maskMoney").maskMoney({showSymbol: true, decimal: ",", thousands: "."});
$(".tel").mask("(99) 9999-9999");
$(".cpf").mask("999.999.999-99");
$(".cnpj").mask("99.999.999/9999-99");
$(".dataNascimento").mask("99/99/9999");
$("#ClienteTelefone").mask("(99) 9999-9999");
$("#ClienteTelefone2").mask("(99) 9999-9999");
$("#ClienteCelular").mask("(99) 9999-9999");
$("#ClienteCnpj").mask("99.999.999/9999-99");
$("#ClienteCpfResponsavel").mask("999.999.999-99");
$("#ClienteCpf").mask("999.999.999-99");
$("#ClienteDataNascimento").mask("99/99/9999");
$("#PedidoPlaca").mask("aaa-9999");
$('.datepicker').datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR",
    calendarWeeks: true,
    autoclose: true,
    todayHighlight: true
});


$('#UsuarioNivelId').change(function () {
    if ($('#UsuarioNivelId').val() == 1) {
        $('#setor').fadeOut('fast');
        $('#unidade').fadeOut('fast');
    } else if ($('#UsuarioNivelId').val() == 2) {
        $('#setor').fadeOut('fast');
        $('#unidade').fadeIn('fast');
    } else {
        $('#setor').fadeIn('fast');
        $('#unidade').fadeIn('fast');
    }
});

$('#LogEstoqueTipo').change(function () {
    if ($('#LogEstoqueTipo').val() == 1) {
        $('.adicionar').fadeIn('fast');
        $('.transferencia').fadeOut('fast');
    } else {
        $('.adicionar').fadeIn('fast');
        $('.transferencia').fadeIn('fast');
    }
});




/***************** ADICIONAR CLIENTE ********************/
$('#tipo').change(function () {
    if ($('#tipo').val() == 0) {
        $('.form-cliente').fadeIn('fast');
        $('.form-representante').fadeOut('fast');
    } else {
        $('.form-cliente').fadeOut('fast');
        $('.form-representante').fadeIn('fast');
    }
});

$('#ClienteTipoJ').click(function () {
    if ($("#ClienteTipoJ").is(":checked")) {
        $('.pf').fadeOut('fast');
        $('.pj').fadeIn('fast');
        $(".cnpj").rules('add', {
            required: true,
            cnpj: 'both',
            messages: {
                required: "Campo Obrigatorio"
            }
        });

        $(".cpf_r").rules('add', {
            required: true,
            cpf: 'both',
            messages: {
                required: "Campo Obrigatorio"
            }
        });
    }
});


$('#ClienteTipoF').click(function () {
    if ($('#ClienteTipoF').is(":checked")) {
        $('.pj').fadeOut('fast');
        $('.pf').fadeIn('fast');
        $(".cpf").rules('add', {
            required: true,
            cpf: 'both',
            messages: {
                required: "Campo Obrigatorio"
            }
        });
    }
});

/*******************************************************/

$(document).ready(function () {
    $("#KitProdutos").select2({dropdownCssClass: 'top'});
    $("#PrecoKitId").select2();
    $(".selectFind").select2({dropdownCssClass: 'topEstoque'});
    $("#PedidoKit").select2();

    $('#bConfirmar').on('click', function () {
        if ($("#cAtender").is(":checked") == false) {
            alert('Por Favor Verifique se a EQUIPAN tem capacidade de atender esse pedido!');
            return false;
        } else {
            $('#PedidoConfirmarForm').submit();
            return true;
        }
    });
    
    $('#bConfirmar2').on('click', function () {
        if ($("#cAtender").is(":checked") == false) {
            alert('O Pedido foi analisado criticamente?');
            return false;
        } else {
            $('#PedidoCadastrarForm').submit();
            return true;
        }
    });

    $("#addkit").click(function () {
        $("#tableKit").append('<tr><td><input name="Produto[Produto][]" readonly value="' + $("#KitProdutos").val() + '" readonly></td><td>' + $("#select2-chosen-1").text() + '</td><td><a href="javascript:void(0);" class="remCF btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i> Remover</a></td></tr>');
        $("#tableKit").show();
    });
    $("#tableKit").on('click', '.remCF', function () {
        $(this).parent().parent().remove();
    });

    $("#replace").click(function () {
        str = $('#PedidoPlacas').val();
        st = str.replace(/\n/g, ",");
        s = st.replace('Placa,', "");
        a = s.length;
        b = a - 1;
        c = s.substr(0, b);
        $('#PedidoPlacas').val(c);
        var result = c.split(',');
        $('#qtdPlaca').val(result.length);
        d = $('#PedidoValor').val();
        e = d.replace(',', ".");
        f = e * result.length;
        $('#vtPlaca').val(formatReal(f));

        str = $('#PedidoRenavam').val();
        st = str.replace(/\n/g, ",");
        y = st.replace('Renavam,', "");
        z = y.length;
        x = z - 1;
        w = y.substr(0, x);
        $('#PedidoRenavam').val(w);
    });

    $("#addkitPedido").click(function () {

        if ($("#select2-chosen-1").text() == '-- Selecione o KIT --') {
            alert('Por favor, selecione um Produto!');
        } else if ($("#PedidoPlaca").val() == '') {
            alert('Por favor, preencha a PLACA!');
        } else if ($("#PedidoTarjeta").val() == '') {
            alert('Falta preencher a TARJETA!');
        } else {

            if ($("#PedidoValor").val() == '') {
                var PV = '0,0';
            } else {
                var PV = $("#PedidoValor").val();
            }

            var kit = $("#select2-chosen-1").text().split('   - ');
            $("#tableKit").append('<tr><td><input name="Produto[id][]" readonly value="' + kit[0] + '" ></td><td style="width: 45%;"><input name="Produto[Produto][]" readonly value="' + kit[1] + '" ></td><td><input name="Produto[placa][]" readonly value="' + $("#PedidoPlaca").val() + '" ></td><td><input name="Produto[tarjeta][]" readonly value="' + $("#PedidoTarjeta").val() + '" ></td><td><input name="Produto[valor][]" readonly value="' + PV + '" ></td><td><a href="javascript:void(0);" class="remPE btn btn-danger btn-xs" valor="' + PV + '"><i class="glyphicon glyphicon-remove"></i> Remover</a></td></tr>');
            $("#tableKit").show();

            var unidade = PV.replace(".", "");
            var unidade = unidade.replace(",", ".");

            var geral = parseFloat($("#PedidoVtotal").val()) + parseFloat(unidade);
            $("#PedidoVtotal").val(geral);

            $('#total').text(formatReal(geral));
        }
    });

    $("#tableKit").on('click', '.remPE', function () {

        var unidade = $(this).attr('valor').replace(".", "");
        var unidade = unidade.replace(",", ".");

        var geral = parseFloat($("#PedidoVtotal").val()) - parseFloat(unidade);
        $("#PedidoVtotal").val(geral);

        $('#total').text(formatReal(geral));

        $(this).parent().parent().remove();
    });

    $('#PedidoPlaca').keyup(function () {
        if ($('#PedidoPlaca').val() != '') {
            $.ajax({
                url: www_root + 'KitsPedidos/verifica/' + $('#PedidoPlaca').val(),
                success: function (data) {
                    if (data['tipo'] == 'feita') {
                        $('#addkitPedido').attr("disabled");
                        $('#tplaca').text(data['KitsPedido']['placa']);
                        $('#tdata').text(formatdataTime(data['KitsPedido']['created']));
                        $('#tloja').text(data['Pedido']['Unidade']['nome']);
                        $('.feita').fadeIn('fast');
                        $("#addkitPedido").attr("disabled", "disabled");
                        $('#addkitPedido').fadeOut('fast');
                    } else {
                        $('#addkitPedido').removeAttr("disabled");
                        $('.feita').fadeOut('fast');
                        $('#addkitPedido').fadeIn('fast');
                    }
                }
            });
        }
    });
});

$('#liberarVenda').click(function () {
    $.ajax({
        url: www_root + 'pedidos/liberar/',
        data: 'usuario=' + $('#PedidoUsuario').val() + '&senha=' + $('#PedidoSenha').val(),
        type: 'GET',
        success: function (data) {
            if (data != '') {
                $('#addkitPedido').removeAttr("disabled");
                $('#PedidoPlaca').prop("disabled", false);
                $('#PedidoTarjeta').prop("disabled", false);
                $('.feita').fadeOut('fast');
                $('#addkitPedido').fadeIn('fast');
            } else {
                alert('O usuário não tem permissão, para liberar o pedido.');
            }
        },
        error: function () {
            alert('O usuário não tem permissão');
        }
    });
});

$('#PrecoKitId').change(function () {
    if ($('#PrecoKitId').val() != '' && $('#PrecoUnidadeId').val() != '') {
        $(".select2-choice").css({"border": "1px solid #aaa"});
        $.ajax({
            url: www_root + 'precos/selecionar?produto=' + $('#PrecoKitId').val() + '&unidade=' + $('#PrecoUnidadeId').val(),
            success: function (data) {
                if (data != '') {
                    $.each(data, function (key, valor) {
                        $('#categoria' + key).val(format(valor));
                    });
                } else {
                    $('.maskMoney').val('');
                }
                $('#precosCategoria').fadeIn('fast');
            }
        });
    } else {
        $("#PrecoUnidadeId").css({"border": "1px solid #F03232"});
    }
});

$('#PrecoUnidadeId').change(function () {
    if ($('#PrecoKitId').val() != '' && $('#PrecoUnidadeId').val() != '') {
        $("#PrecoUnidadeId").css({"border": "1px solid #ccc"});
        $.ajax({
            url: www_root + 'precos/selecionar?produto=' + $('#PrecoKitId').val() + '&unidade=' + $('#PrecoUnidadeId').val(),
            success: function (data) {
                if (data != '') {
                    $.each(data, function (key, valor) {
                        $('#categoria' + key).val(format(valor));
                    });
                } else {
                    $('.maskMoney').val('');
                }
                $('#precosCategoria').show();
            }
        });
    } else {
        $(".select2-choice").css({"border": "1px solid #F03232"});
    }
});


$('#addPreco').click(function () {
    $.ajax({
        url: www_root + 'precos/add/',
        data: $('#PrecoIndexForm').serialize(),
        type: 'GET',
        success: function (data) {
            $('.alert').show().html('O preço do produto <b>' + $('#select2-chosen-1').text() + '</b> da a unidade <b>' + $('#PrecoUnidadeId option:selected').text() + '</b> foi salvo com sucesso!');
        }
    });
});

$('#liberarPrazo').click(function () {
    $.ajax({
        url: www_root + 'clientes/liberar/',
        data: $('#LiberarAddForm').serialize(),
        type: 'GET',
        success: function (data) {
            $('#ClientePrazo').prop("disabled", false);
            $('.modal').modal('hide');
            $('#liberar').fadeOut('fast');
            $('#liberado').html("Crédito liberado por <strong>" + data.Usuario.nome + "</strong>.").delay(300).fadeIn();
        }
    });
});

$('#liberarDesconto').click(function () {
    $.ajax({
        url: www_root + 'pedidos/liberar/',
        data: $('#LiberarAddForm').serialize(),
        type: 'POST',
        success: function (data) {
            if (data != '') {
                $('#PedidoUsuarioDescontoId').val(data.Usuario.id);
                $('#PedidoValor').removeAttr("readonly");
                $('#PedidoDesconto').removeAttr("readonly");
                $("#PedidoValor").maskMoney({showSymbol: true, decimal: ",", thousands: "."});
                $("#PedidoDesconto").maskMoney({showSymbol: true, decimal: ",", thousands: "."});
                $('.modal').modal('hide');
                $('#liberar').fadeOut('fast');
                $('#liberado').html("Desconto liberado por <strong>" + data.Usuario.nome + "</strong>.").delay(300).fadeIn();
            } else {
                alert('O usuário não tem permissão, para liberar o desconto.');
            }
        },
        error: function () {
            alert('O usuário não tem permissão');
        }
    });
});

$('#PedidoKit').on("select2-selecting", function (e) {
    $("#mEstoque ul li").detach();
    $("#mEstoque").fadeIn('fast');
    if ($('#PedidoUnidadeId').val() == '') {
        alert('Por favor, Selecione a Unidade!');
    } else {
        $.ajax({
            url: www_root + 'pedidos/valor?categoria=' + $('#PedidoCategoriaId').val() + '&produto=' + e.val + '&unidade=' + $('#PedidoUnidadeId').val(),
            type: 'GET',
            success: function (data) {
                var quant = new Array();
                $.each(data.Estoque, function (index, value) {
                    if (value.Estoque.quantidade <= 0) {
                        quant.push(false);
                        $("#mEstoque ul").append('<li style="color:red">O Produto: <i style="font-weight: bold;">' + value.Produto.nome + '</i> contem <i style="font-weight: bold;">' + value.Estoque.quantidade + '</i> no estoque</li>');
                    } else {
                        quant.push(true);
                        $("#mEstoque ul").append('<li style="color:green">O Produto: <i style="font-weight: bold;">' + value.Produto.nome + '</i> contem <i style="font-weight: bold;">' + value.Estoque.quantidade + '</i> no estoque</li>');
                    }
                });
                if (jQuery.inArray(false, quant) == 0) {
                    $('#PedidoPlaca').attr('disabled', true);
                    $('#PedidoTarjeta').attr('disabled', true);
                    $('#addkitPedido').attr('disabled', true);
                } else {
                    $('#PedidoPlaca').prop("disabled", false);
                    $('#PedidoTarjeta').prop("disabled", false);
                    $('#addkitPedido').attr('disabled', false);
                }
                if (data != '') {
                    $('#PedidoValor').val(format(data.Valor.Preco.valor));
                } else {
                    alert('O produto esta sem valor definido');
                }
            }
        });
    }
});

$('#LogEstoqueTransferencia').change(function () {
    if ($('#LogEstoqueTransferencia').is(':checked') == true) {
        $('#LogEstoqueUnidadeOrigenDestino').prop("disabled", false);
    } else if ($('#LogEstoqueTransferencia').is(':checked') == false) {
        $('#LogEstoqueUnidadeOrigenDestino').prop("disabled", true);
    }
});


$('#clienteLocaliza').on('change', function (e) {
    $.ajax({
        url: www_root + 'clientes/find?cliente=' + $('#clienteLocaliza').val(),
        type: 'GET',
        success: function (data) {
            console.log(data);
            $("#PedidoClienteId").val(data.Cliente.id);
            $("#PedidoNome").val(data.Cliente.nome);
            $("#PedidoCategoriaId").val(data.Cliente.categoria_id);
            $(".cliente").fadeIn('fast');
        }
    });
});

$('.bCliente').autocomplete({
    source: www_root + 'clientes/lista',
    select: function (event, ui) {
        $(".dv-repre").fadeOut('fast');
        if (ui.item.Representante != '') {
            $.each(ui.item.Representante, function (index, value) {
                $(".dv-representantes").append('<input name="data[Pedido][representante_id]" value="' + value.id + '#' + value.nome + ' [CPF: ' + value.cpf + ']' + '" type="radio"><label for="condition-access-1" style="margin-left: 5px;">' + value.nome + ' <i style="color:blue">[CPF: ' + value.cpf + ']<i/></label><br />');
            });
            $(".dv-repre").fadeIn('fast');
        }
        $("#PedidoCliente").val('');
        $("#PedidoClienteId").val(ui.item.Cliente.id);
        $("#PedidoNome").val(ui.item.Cliente.nome);
        $("label[for='PedidoCpf']").text(ui.item.Cliente.cpf != '' ? "CPF" : "CNPJ");
        $("#PedidoCpf").val(ui.item.Cliente.cpf != '' ? ui.item.Cliente.cpf : ui.item.Cliente.cnpj);
        $("#PedidoTelefone").val(ui.item.Cliente.telefone);
        $("#PedidoEmail").val(ui.item.Cliente.email);
        $("#PedidoCategoria").val(ui.item.Categoria.nome);
        $("#PedidoCategoriaId").val(ui.item.Categoria.id);
        $(".cliente").fadeIn('fast');

        /* Cadastro de Representante */
        $("#ClienteCliente").val(ui.item.Cliente.nome);
        $("#ClienteClienteId").val(ui.item.Cliente.id);
        /*****************************/

        if (ui.item.Cliente.prazo == true) {
            $('#PedidoTipo1').prop("disabled", false);
            $("#PedidoTipo1").prop("checked", true);
        } else {
            $('#PedidoTipo1').prop("disabled", true);
            $("#PedidoTipo0").prop("checked", true);
        }

        return false;
    }

}).autocomplete("instance")._renderItem = function (ul, item) {

    var searchMask = this.element.val();
    var regEx = new RegExp(searchMask, "ig");
    var replaceMask = "<u style=\"color:red;\">$&</u>";
    var html = "<strong>[" + item.Cliente.id.replace(regEx, replaceMask) + "] " + item.Cliente.nome.replace(regEx, replaceMask) + "</strong><br><i>" + item.Categoria.nome + '</i>';

    return $("<li>")
            .append($("<a></a>").html(html))
            .appendTo(ul);
};

$('#PedidoCadastrarForm').submit(function () {
    if (this.beenSubmitted)
        return false;
    else
        this.beenSubmitted = true;
});


/********************* FUNÇÕES CAIXA DA LOJA **********************************/

$('#pesquisarCaixa').click(function () {
    $('#dvLoading').fadeIn('fast');
    $('.alert-success').fadeOut('fast');
    $.ajax({
        url: www_root + 'caixas/pesquisar?pedido=' + $('#pedido').val() + '&placa=' + $('#placa').val(),
        type: 'GET',
        success: function (data) {
            if (data.Pedido.tipo != 'pago') {
                $('#caixa').fadeIn('fast');
                $('.bg-danger').fadeOut('fast');
                $("#tableKit tbody").detach();
                $('#CaixaPedidoId').val(data.Pedido.id);
                $('#CaixaUnidadeId').val(data.Pedido.unidade_id);
                $('#CaixaNome').val(data.Cliente.nome);
                $('#CaixaObservacaoPedido').val(data.Pedido.observacao);
                $('#CaixaUnidadeId').val(data.Pedido.unidade_id);
                $('#CaixaDocumento').val(data.Cliente.cpf ? data.Cliente.cpf : data.Cliente.cnpj);
                var total = 0;
                var vTotal;
                if ($('#pedido').val()) {
                    $.each(data.KitsPedido, function (index, value) {
                        var valorParcial = value.valor_parcial != null ? 'R$ ' + format(value.valor_parcial) : '-';
                        var parcial = value.parcial == 0 ? 'Não' : 'Sim';
                        var totalPlaca = value.valor_parcial != null ? value.valor - value.valor_parcial : value.valor;
                        var paga = value.paga == true ? '<b style="color: green;">Paga</b>' : '<b style="color: red;">Pendente</b>';
                        vTotal = parseFloat(vTotal) + parseFloat(total);
                        $("#tableKit").append('<tr><td style="width: 45%;">' + value.Kit.nome + '</td><td>' + value.placa + '</td><td>' + value.tarjeta + '</td><td>' + parcial + '</td><td>' + valorParcial + '</td><td>R$ ' + format(totalPlaca) + '</td>' + '</td><td>' + paga + '</td>');
                        if (value.paga != 1) {
                            total = parseFloat(total) + parseFloat(totalPlaca);
                        }
                    });
                } else {
                    $('#CaixaKitsPedidoId').val(data.KitsPedido.id);
                    var valorParcial = data.KitsPedido.valor_parcial != null ? 'R$ ' + format(data.KitsPedido.valor_parcial) : '-';
                    var parcial = data.KitsPedido.parcial == 0 ? 'Não' : 'Sim';
                    var totalPlaca = data.KitsPedido.valor_parcial != null ? data.KitsPedido.valor - data.KitsPedido.valor_parcial : data.KitsPedido.valor;
                    var paga = data.KitsPedido.paga == true ? '<b style="color: green;">Paga</b>' : '<b style="color: red;">Pendente</b>';
                    $("#tableKit").append('<tr><td style="width: 45%;">' + data.Kit.nome + '</td><td>' + data.KitsPedido.placa + '</td><td>' + data.KitsPedido.tarjeta + '</td><td>' + parcial + '</td><td>' + valorParcial + '</td><td> R$ ' + format(totalPlaca) + '</td><td>' + paga + '</td></tr>');
                    total = parseFloat(total) + parseFloat(totalPlaca);
                }
                $('#tipoPedido').html(data.Pedido.tipo == 0 ? '<p class="bg-success avista col-sm-2">A Vista</p>' : '<p class="bg-danger aprazo col-sm-2">A Prazo</p>');
                var desconto = data.Pedido.desconto == '' ? '0.0' : data.Pedido.desconto;
                $('#CaixaValor').val(formatReal(total));
                $('#CaixaDesconto').val(format(desconto));
                $('#CaixaValorTotal').val(formatReal(parseFloat(total) - desconto));
                $('#dvLoading').fadeOut('fast');
            } else {
                $('.pedidoPago').fadeIn('fast');
                $('#caixa').fadeOut('fast');
                $('.pedidoPago').text(data.Pedido.msg);
                $('#dvLoading').fadeOut('fast');
            }
        }
    });
});

$('#pesquisarParcial').click(function () {
    $('#dvLoading').fadeIn('fast');
    $.ajax({
        url: www_root + 'caixas/pesquisaparcial?placa=' + $('#placa').val(),
        type: 'GET',
        success: function (data) {
            if (data.Pedido.tipo != 'pago') {
                $('#caixa').fadeIn('fast');
                $('.bg-danger').fadeOut('fast');
                $("#tableKit tbody").detach();
                $('#CaixaPedidoId').val(data.Pedido.id);
                $('#CaixaUnidadeId').val(data.Pedido.unidade_id);
                $('#CaixaNome').val(data.Cliente.nome);
                $('#CaixaObservacaoPedido').val(data.Pedido.observacao);
                $('#CaixaUnidadeId').val(data.Pedido.unidade_id);
                $('#CaixaDocumento').val(data.Cliente.cpf ? data.Cliente.cpf : data.Cliente.cnpj);
                var total = 0;
                $('#CaixaKitsPedidoId').val(data.KitsPedido.id);
                $("#tableKit").append('<tr><td style="width: 45%;">' + data.Kit.nome + '</td><td>' + data.KitsPedido.placa + '</td><td>' + data.KitsPedido.tarjeta + '</td><td> R$ ' + format(data.KitsPedido.valor) + '</td></tr>');
                total = parseFloat(total) + parseFloat(data.KitsPedido.valor);
                $('#tipoPedido').html(data.Pedido.tipo == 0 ? '<p class="bg-success avista col-sm-2">A Vista</p>' : '<p class="bg-danger aprazo col-sm-2">A Prazo</p>');
                $('#CaixaValor').val(formatReal(total));
                $('#CaixaValorTotal').val(formatReal(total));
                $('#dvLoading').fadeOut('fast');
            } else {
                $('#caixa').fadeOut('fast');
                $('.baixaParcial').fadeIn('fast');
                $('.baixaParcial').text(data.Pedido.msg);
                $('#dvLoading').fadeOut('fast');
            }
        }
    });
});

$('#baixarCaixa').click(function () {
    $('#dvLoading').fadeIn('fast');
    $.ajax({
        url: www_root + 'caixas/add',
        data: $('#CaixaIndexForm').serialize(),
        type: 'POST',
        success: function (data) {
            console.log(data)
            if (data == 'erro') {
                $('.bg-danger').fadeIn('fast');
            } else {
                $('#caixa').fadeOut('fast');
                $("#tableKit tbody").detach();
                $('#CaixaPedidoId').val('');
                $('#CaixaUnidadeId').val('');
                $('#CaixaNome').val('');
                $('#CaixaObservacao').val('');
                $('#CaixaDocumento').val('');
                $('#pedido').val('');
                $('#placa').val('');
                $('#CaixaDesconto').val('');
                $('#CaixaDinheiro').val('');
                $('#CaixaDinheiro').val('');
                $('#CaixaCartaoCredito').val('');
                $('#CaixaCataoDebito').val('');
                $('#CaixaDeposito').val('');
                $('#CaixaCheque').val('');
                $('#CaixaObservacao').val('');
                $('#CaixaKitsPedidoId').val('');
                $('#CaixaKitsPedidoId').val('');
                $('.alert-success').fadeIn('fast');
                $('.bg-danger').fadeOut('fast');
            }
            $('#dvLoading').fadeOut();
        }
    });
});

$('#PesquisaUnidadeId').change(function () {
    $('#dvLoading').fadeIn('fast');
    $.ajax({
        url: www_root + 'clientes/select/' + $('#PesquisaUnidadeId').val(),
        type: 'GET',
        success: function (data) {
            var html = '<option value="">Selecione uma cliente</option>';
            $.each(data, function (key, value) {
                html += '<option value="' + value.Cliente.id + '">' + value.Cliente.nome + '</option>';
            });
            $("#PesquisaClienteId").html(html);
            $('#CaixaUnidadeId').val($('#PesquisaUnidadeId').val());
            $('#dvLoading').fadeOut();
        }
    });
});

$('#pesquisarCaixaLote').click(function () {
    $('#dvLoading').fadeIn('fast');
    $("#tabelaLote tbody").detach();
    $.ajax({
        url: www_root + 'caixas/prazo/',
        data: $('#PesquisaLoteForm').serialize(),
        type: 'GET',
        success: function (data) {
            var vTotal = 0.0;
            var up = [];
            $.each(data, function (key, value) {
                var obs = value.KitsPedido.observacao != null ? value.KitsPedido.observacao : '-';
                var valorParcial = value.KitsPedido.valor_parcial != null ? format(value.KitsPedido.valor_parcial) : '-';
                var parcial = value.KitsPedido.parcial == 0 ? 'Não' : 'Sim';
                var total = value.KitsPedido.valor_parcial != null ? value.KitsPedido.valor - value.KitsPedido.valor_parcial : value.KitsPedido.valor;
                var date = value.KitsPedido.created.split(" ");
                vTotal = vTotal + parseFloat(total);
                vTotal = parseFloat(vTotal.toFixed(2));
                $("#tabelaLote").append('<tr><td><input type="checkbox" name="quitar[' + value.KitsPedido.id + ']" id="' + value.KitsPedido.id + '" class="ChVa" checked="checked"><input type="hidden" value="' + total + '" id="valor' + value.KitsPedido.id + '"></td><td>' + value.Kit.nome + '</td><td>' + value.KitsPedido.placa + '</td><td>' + value.KitsPedido.tarjeta + '</td><td>' + obs + '</td><td>' + formatdata(date[0]) + '</td><td>' + format(value.KitsPedido.valor) + '</td><td>' + parcial + '</td><td>' + valorParcial + '</td><td>' + format(total) + '</td>');
                up.push(value.KitsPedido.id);
            });

            $('#total').val(vTotal);
            $('#up').val(up.join(','));
            $('#valor').val(formatReal(vTotal));

            $('.Chall').on('click', function () {
                if ($(this).is(":checked")) {
                    $('input:checkbox').attr('checked', 'checked');
                } else {
                    $('input:checkbox').removeAttr('checked');
                }
            });

            var total = $('#total').val();
            $('.ChVa').change(function () {
                var up = [];
                if ($(this).is(":checked")) {
                    total = parseFloat(total) + parseFloat($('#valor' + $(this).attr('id')).val());
                } else {
                    total = parseFloat(total) - parseFloat($('#valor' + $(this).attr('id')).val());
                }
                $.each($(".ChVa"), function (id, val) {
                    if ($(val).is(":checked")) {
                        up.push($(this).attr('id'));
                    }
                });
                $('#total').val(total);
                $('#up').val(up.join(','));
                $('#valor').val(formatReal(total));
            });

            $('#caixaLote').fadeIn('fast');
            $('#dvLoading').fadeOut();
        }
    });
});

$('#loteQuitar').click(function () {
    $('#dvLoading').fadeIn('fast');
    $.ajax({
        url: www_root + 'caixas/quitar/',
        data: $('#QuitarLoteForm').serialize(),
        type: 'POST',
        success: function (data) {
            if (data['tipo'] == 0) {
                $('.alert-success').fadeIn('fast');
                $('.bg-danger').fadeOut('fast');
                $('#caixaLote').fadeOut('fast');
                $("#QuitarDesconto").val(' ');
                $("#QuitarDinheiro").val(' ');
                $("#QuitarCartaoCredito").val(' ');
                $("#QuitarCataoDebito").val(' ');
                $("#QuitarDeposito").val(' ');
                $("#QuitarCheque").val(' ');
                $("#QuitarObservacao").val(' ');
                $("#tabelaLote tbody").detach();
            } else {
                $('.alert-success').fadeOut('fast');
                $('.bg-danger').fadeIn('fast');
                $('.vs').text('Valor total do Lote: R$' + format(data['total']) + ', valor da soma: R$' + format(data['soma']) + ', diferença de: R$' + format(data['total'] - data['soma']));
            }
            $('#dvLoading').fadeOut();
        }
    });
});

$('#fechamentoCaixa').click(function () {
    $('#dvLoading').fadeIn('fast');
    $("#tablefechamento tbody").detach();
    $.ajax({
        url: www_root + 'caixas/fechamentoR?de=' + $('#dataInicial').val() + '&ate=' + $('#dataFinal').val() + '&uni=' + $('#unidade_id').val(),
        type: 'GET',
        success: function (data) {
            var dinheiro = 0;
            var vDinheiro;
            var cheque = 0;
            var vCheque;
            var cDebito = 0;
            var vDebito;
            var cCredito = 0;
            var vCredito;
            var deposito = 0;
            var vDeposito;
            var desconto = 0;
            var vDesconto;
            var total = 0;
            var vTotal;
            var totalCDes = 0;
            var vtotalCDes;
            var pp;
            $.each(data, function (key, value) {
                if (value.Caixa.dinheiro != '') {
                    dinheiro = parseFloat(dinheiro) + parseFloat(value.Caixa.dinheiro);
                    vDinheiro = 'R$ ' + format(value.Caixa.dinheiro);
                } else {
                    vDinheiro = ' - ';
                }
                if (value.Caixa.cheque != '') {
                    cheque = parseFloat(cheque) + parseFloat(value.Caixa.cheque);
                    vCheque = 'R$ ' + format(value.Caixa.cheque);
                } else {
                    vCheque = ' - ';
                }
                if (value.Caixa.cartaoDebito != '') {
                    cDebito = parseFloat(cDebito) + parseFloat(value.Caixa.cartaoDebito);
                    vDebito = 'R$ ' + format(value.Caixa.cartaoDebito);
                } else {
                    vDebito = ' - ';
                }
                if (value.Caixa.cartaoCredito != '') {
                    cCredito = parseFloat(cCredito) + parseFloat(value.Caixa.cartaoCredito);
                    vCredito = 'R$ ' + format(value.Caixa.cartaoCredito);
                } else {
                    vCredito = ' - ';
                }
                if (value.Caixa.deposito != '') {
                    deposito = parseFloat(deposito) + parseFloat(value.Caixa.deposito);
                    vDeposito = 'R$ ' + format(value.Caixa.deposito);
                } else {
                    vDeposito = ' - ';
                }
                if (value.Caixa.desconto != '') {
                    desconto = parseFloat(desconto) + parseFloat(value.Caixa.desconto);
                    vDesconto = 'R$ ' + format(value.Caixa.desconto);

                    totalCDes = parseFloat(totalCDes) + (parseFloat(value.Caixa.valor) - parseFloat(value.Caixa.desconto));
                    vtotalCDes = 'R$ ' + format(parseFloat(value.Caixa.valor) - parseFloat(value.Caixa.desconto));
                } else {
                    vDesconto = ' - ';

                    totalCDes = parseFloat(totalCDes) + parseFloat(value.Caixa.valor);
                    vtotalCDes = 'R$ ' + format(value.Caixa.valor);
                }

                total = parseFloat(total) + parseFloat(value.Caixa.valor);
                vTotal = 'R$ ' + format(value.Caixa.valor);

                pp = value.Caixa.pedido_id != null ? '<td class="pg">' + value.Caixa.pedido_id + '</td>' : value.KitsPedido.Placa != null ? '<td class="pr">' + value.KitsPedido.Placa + '</td>' : '<td class="pr"> - BAIXA EM LOTE - </td>';

                $("#tablefechamento").append('<tr>' + pp + '<td>' + vDinheiro + '</td><td>' + vCheque + '</td><td>' + vDebito + '</td><td>' + vCredito + '</td><td>' + vDeposito + '</td><td>' + vDesconto + '</td><td>' + vTotal + '</td><td>' + vtotalCDes + '</td></tr>');
            });

            $('#tDinheiro').text(dinheiro != 0 ? 'R$ ' + formatReal(dinheiro) : ' - ');
            $('#tCheque').text(cheque != 0 ? 'R$ ' + formatReal(cheque) : ' - ');
            $('#tDebito').text(cDebito != 0 ? 'R$ ' + formatReal(cDebito) : ' - ');
            $('#tCredito').text(cCredito != 0 ? 'R$ ' + formatReal(cCredito) : ' - ');
            $('#tDeposito').text(deposito != 0 ? 'R$ ' + formatReal(deposito) : ' - ');
            $('#tDesconto').text(desconto != '' ? 'R$ ' + formatReal(desconto) : ' - ');
            $('#tTotal').text('R$ ' + formatReal(total));
            $('#tTotalcDe').text('R$ ' + formatReal(totalCDes));
            $('.divF').fadeIn('fast');
            $('#dvLoading').fadeOut();
        }
    });
});

/********************* FINAL FUNÇÕES CAIXA DA LOJA ****************************/


/******************** INICIO DE FUNÇÕES ENTREGA *******************************/
function validaCodigo() {
    $('.pCodigo').blur(function () {
        if ($(this).val() != '') {
            var id = ($(this).attr('id'));
            $('#dvLoading').fadeIn('fast');
            $.ajax({
                url: www_root + 'entregas/pesquisarCodigo?codigo=' + $(this).val() + '&produto=' + $('#ID' + id).val(),
                type: 'GET',
                success: function (data) {
                    if (data.retorno == false) {
                        $('#H' + id).val(data.Codigo.id);
                        $('#erroCodigo').fadeOut('fast');
                        $('#H' + id).val(data.Codigo.id);
                        $('#' + id).attr('style', "border-color:black!important");
                    } else {
                        $('#erroCodigo').text(data.msg);
                        $('#erroCodigo').fadeIn('fast');
                        $('#' + id).attr('style', "border-color:red!important");
                    }
                    $('#dvLoading').fadeOut('fast');
                }
            });
        }
    });
}

$('#pesquisarEntrega').click(function () {
    $('#dvLoading').fadeIn('fast');
    $('.alert-success').fadeOut('fast');
    $.ajax({
        url: www_root + 'entregas/pesquisar?pedido=' + $('#pedido').val() + '&placa=' + $('#placa').val(),
        type: 'GET',
        success: function (data) {
            $("#tableKit tbody").detach();
            $("#tableCodigo tbody").detach();
            $("#EntregaPedidoId").val(data.Pedido.id);
            $("#EntregaObservacaoPedido").val(data.Pedido.observacao);
            $("#EntregaUnidadeId").val(data.Pedido.unidade_id);
            $('#tipoPedido').html(data.Pedido.tipo == 0 ? '<p class="bg-success avista col-sm-2">A Vista</p>' : '<p class="bg-danger aprazo col-sm-2">A Prazo</p>');
            $('#entrega').fadeIn('fast');
            var VAuto = 0;
            var pagas = 0;
            if ($('#pedido').val()) {
                $("#EntregaNome").val(data.Cliente.nome);
                $.each(data.KitsPedido, function (index, value) {
                    VAuto = value.autorizacao == null ? VAuto + 1 : VAuto;
                    var renavan = value.renavan == null || value.renavan == '' ? '<input type="text" name="data[Placa][' + value.id + '][renavan]" id="EntregaRenavan" class="tableVisivel">' : value.renavan;
                    var autorizacao = value.autorizacao == null || value.autorizacao == '' ? '<input type="text" name="data[Placa][' + value.id + '][autorizacao]" id="EntregaRenavan" class="tableVisivel">' : value.autorizacao;
                    var entregue = value.entregue == false ? '<span style="color:red">Não</span>' : '<span style="color:green">Sim</span>';
                    var paga = value.paga == false ? '<span style="color:red">Não</span>' : '<span style="color:green">Sim</span>';
                    $("#tableKit").append('<tr><td style="width: 45%;"><input type="hidden" name="data[Placa][' + value.id + '][id]" value="' + value.id + '">' + value.Kit.nome + '</td><td>' + value.placa + '</td><td>' + value.tarjeta + '</td><td>' + renavan + '</td><td>' + autorizacao + '</td><td>' + entregue + '</td><td>' + paga + '</td></tr>');
                    if (value.Kit.tipo == 1) {
                        var VCD = typeof value.Codigo[0] == 'undefined' ? '<input type="hidden" id="ID' + value.id + 'CD" value="1' + value.Kit.codigo + '"><input type="hidden" name="data[Codigo][' + value.id + '][DT]" id="H' + value.id + 'CD" value=""><input type="text" name="data[Codigo][' + value.id + '][dianteira]" id="' + value.id + 'CD" class="pCodigo tableVisivel">' : value.Codigo[0].codigo;
                        $("#tableCodigo").append('<tr><td>' + value.Kit.nome + '</td><td><input type="hidden" name="data[Codigo][' + value.id + '][id]" value="' + value.id + '">' + value.placa + '</td><td>' + VCD + '</td><td>-/-</td></tr>');
                    } else if (value.Kit.tipo == 2 || value.Kit.tipo == 4) {
                        var VCT = typeof value.Codigo[0] == 'undefined' ? '<input type="hidden" id="ID' + value.id + 'CT" value="2' + value.Kit.codigo + '"><input type="hidden" name="data[Codigo][' + value.id + '][TR]" id="H' + value.id + 'CT" value=""><input type="text" name="data[Codigo][' + value.id + '][traseira]" id="' + value.id + 'CT" class="pCodigo tableVisivel">' : value.Codigo[0].codigo;
                        $("#tableCodigo").append('<tr><td>' + value.Kit.nome + '</td><td><input type="hidden" name="data[Codigo][' + value.id + '][id]" value="' + value.id + '">' + value.placa + '</td><td>-/-</td><td>' + VCT + '</td></tr>');
                    } else if (value.Kit.tipo == 3) {
                        var VCD = typeof value.Codigo[0] == 'undefined' ? '<input type="hidden" id="ID' + value.id + 'CD" value="1' + value.Kit.codigo + '"><input type="hidden" name="data[Codigo][' + value.id + '][DT]" id="H' + value.id + 'CD" value=""><input type="text" name="data[Codigo][' + value.id + '][dianteira]" id="' + value.id + 'CD" class="pCodigo tableVisivel">' : value.Codigo[0].codigo;
                        var VCT = typeof value.Codigo[1] == 'undefined' ? '<input type="hidden" id="ID' + value.id + 'CT" value="2' + value.Kit.codigo + '"><input type="hidden" name="data[Codigo][' + value.id + '][TR]" id="H' + value.id + 'CT" value=""><input type="text" name="data[Codigo][' + value.id + '][traseira]" id="' + value.id + 'CT" class="pCodigo tableVisivel">' : value.Codigo[1].codigo;
                        $("#tableCodigo").append('<tr><td>' + value.Kit.nome + '</td><td><input type="hidden" name="data[Codigo][' + value.id + '][id]" value="' + value.id + '">' + value.placa + '</td><td>' + VCD + '</td><td>' + VCT + '</td></tr>');
                    }
                    if (data.Pedido.tipo == 0) {
                        if (value.paga == true) {
                            pagas = 1;
                        }
                        if (pagas == 0) {
                            $("#EntregaSituacao").val("0");
                            $("#EntregaSituacao option[value='1']").fadeOut('fast');
                        }
                    }
                    if (data.Entrega != '') {
                        $('.pentregue').fadeIn('fast');
                        $('#concluir').fadeOut();
                        $('#EntregaSituacao').fadeOut();
                        $("#EntregaObservacao").attr("disabled", true);
                        $('#EntregaObservacao').val(data.Entrega[0].observacao);
                    } else {
                        $('.pentregue').fadeOut('fast');
                        $('#concluir').fadeIn();
                        $('#EntregaSituacao').fadeIn();
                        $("#EntregaObservacao").attr("disabled", false);
                        $('#EntregaObservacao').val('');
                    }
                });
            } else {
                $("#EntregaNome").val(data.Pedido.Cliente.nome);
                var renavan = data.KitsPedido.renavan == null || data.KitsPedido.renavan == '' ? '<input type="text" name="data[Placa][' + data.KitsPedido.id + '][renavan]" id="EntregaRenavan" class="tableVisivel">' : data.KitsPedido.renavan;
                var autorizacao = data.KitsPedido.autorizacao == null || data.KitsPedido.autorizacao == '' ? '<input type="text" name="data[Placa][' + data.KitsPedido.id + '][autorizacao]" id="EntregaRenavan" class="tableVisivel">' : data.KitsPedido.autorizacao;
                var entregue = data.KitsPedido.entregue == false ? '<span style="color:red">Não</span>' : '<span style="color:green">Sim</span>';
                var paga = data.KitsPedido.paga == false ? '<span style="color:red">Não</span>' : '<span style="color:green">Sim</span>';
                $("#tableKit").append('<tr><td style="width: 45%;"><input type="hidden" name="data[Entrega][kits_pedido_id]" value="' + data.KitsPedido.id + '">' + data.Kit.nome + '</td><td>' + data.KitsPedido.placa + '</td><td>' + data.KitsPedido.tarjeta + '</td><td>' + renavan + '</td><td>' + autorizacao + '</td><td>' + entregue + '</td><td>' + paga + '</td></tr>');
                if (data.Kit.tipo == 1) {
                    var VCD = typeof data.Codigo[0] == 'undefined' ? '<input type="hidden" id="ID' + data.KitsPedido.id + 'CD" value="1' + data.Kit.codigo + '"><input type="hidden" name="data[Codigo][' + data.KitsPedido.id + '][DT]" id="H' + data.KitsPedido.id + 'CD" value=""><input type="text" name="data[Codigo][' + data.KitsPedido.id + '][dianteira]" id="' + data.KitsPedido.id + 'CD" class="pCodigo tableVisivel">' : data.Codigo[0].codigo;
                    $("#tableCodigo").append('<tr><td>' + data.Kit.nome + '</td><td><input type="hidden" name="data[Codigo][' + data.KitsPedido.id + '][id]" value="' + data.KitsPedido.id + '">' + data.KitsPedido.placa + '</td><td>' + VCD + '</td><td>-/-</td></tr>');
                } else if (data.Kit.tipo == 2 || data.Kit.tipo == 4) {
                    var VCT = typeof data.Codigo[0] == 'undefined' ? '<input type="hidden" id="ID' + data.KitsPedido.id + 'CT" value="2' + data.Kit.codigo + '"><input type="hidden" name="data[Codigo][' + data.KitsPedido.id + '][TR]" id="H' + data.KitsPedido.id + 'CT" value=""><input type="text" name="data[Codigo][' + data.KitsPedido.id + '][traseira]" id="' + data.KitsPedido.id + 'CT" class="pCodigo tableVisivel">' : data.Codigo[0].codigo;
                    $("#tableCodigo").append('<tr><td>' + data.Kit.nome + '</td><td><input type="hidden" name="data[Codigo][' + data.KitsPedido.id + '][id]" value="' + data.KitsPedido.id + '">' + data.KitsPedido.placa + '</td><td>-/-</td><td>' + VCT + '</td></tr>');
                } else if (data.Kit.tipo == 3) {
                    var VCD = typeof data.Codigo[0] == 'undefined' ? '<input type="hidden" id="ID' + data.KitsPedido.id + 'CD" value="1' + data.Kit.codigo + '"><input type="hidden" name="data[Codigo][' + data.KitsPedido.id + '][DT]" id="H' + data.KitsPedido.id + 'CD" value=""><input type="text" name="data[Codigo][' + data.KitsPedido.id + '][dianteira]" id="' + data.KitsPedido.id + 'CD" class="pCodigo tableVisivel">' : data.Codigo[0].codigo;
                    var VCT = typeof data.Codigo[1] == 'undefined' ? '<input type="hidden" id="ID' + data.KitsPedido.id + 'CT" value="2' + data.Kit.codigo + '"><input type="hidden" name="data[Codigo][' + data.KitsPedido.id + '][TR]" id="H' + data.KitsPedido.id + 'CT" value=""><input type="text" name="data[Codigo][' + data.KitsPedido.id + '][traseira]" id="' + data.KitsPedido.id + 'CT" class="pCodigo tableVisivel">' : data.Codigo[1].codigo;
                    $("#tableCodigo").append('<tr><td>' + data.Kit.nome + '</td><td><input type="hidden" name="data[Codigo][' + data.KitsPedido.id + '][id]" value="' + data.KitsPedido.id + '">' + data.KitsPedido.placa + '</td><td>' + VCD + '</td><td>' + VCT + '</td></tr>');
                }
                VAuto = data.KitsPedido.autorizacao;
                if (data.Pedido.tipo == 0) {
                    if (data.KitsPedido.paga == true) {
                        pagas = 1;
                    }
                    if (pagas == 0) {
                        $("#EntregaSituacao").val("0");
                        $("#EntregaSituacao option[value='1']").fadeOut('fast');
                    }
                }
                if (entregue == false) {
                    $('.pentregue').fadeIn('fast');
                    $('#concluir').fadeOut();
                    $('#EntregaSituacao').fadeOut();
                    $("#EntregaObservacao").attr("disabled", true);
                    $('#EntregaObservacao').val(entregue.observacao);
                } else {
                    $('.pentregue').fadeOut('fast');
                    $('#concluir').fadeIn();
                    $('#EntregaSituacao').fadeIn();
                    $("#EntregaObservacao").attr("disabled", false);
                    $('#EntregaObservacao').val();
                }
            }
            validaCodigo();
            //VAuto == 0 ? $('#concluir').remove() : '';
            $('#dvLoading').fadeOut('fast');
        }
    });
});

//*********************** BAIXA EM LOTE NA EMTREGA
function GerarPoximo($id, $var, $produto) {
    var result = $id.split('C');
    var result2 = parseFloat(result[0]) + 1;
    var a = $('#' + $id).val().substring(0, 15);
    var b = $('#' + $id).val().substring(16, 22);
    var c = a + pad(parseFloat(b) - 1, 7);
    if ($('#' + result2 + $var).val() == '') {
        $('#' + result2 + $var).val(c);
        $.ajax({
            url: www_root + 'entregas/pesquisarCodigo?codigo=' + c + '&produto=' + $produto,
            type: 'GET',
            success: function (data) {
                if (data.retorno == false) {
                    $('#H' + result2 + $var).val(data.Codigo.id);
                    $('#erroCodigo').fadeOut('fast');
                    $('#H' + result2 + $var).val(data.Codigo.id);
                    $('#' + result2 + $var).attr('style', "border-color:black!important");
                } else {
                    $('#erroCodigo').text(data.msg);
                    $('#erroCodigo').fadeIn('fast');
                    $('#' + result2 + $var).attr('style', "border-color:red!important");
                }
            }
        });
        GerarPoximo(result2 + $var, $var, $produto);
    }
}
function validaCodigoLote() {
    $('.pCodigoLoteD').blur(function () {
        if ($(this).val() != '') {
            var id = $(this).attr('id');
            var produto = $('#ID' + id).val();
            $('#dvLoading').fadeIn('fast');
            $.ajax({
                url: www_root + 'entregas/pesquisarCodigo?codigo=' + $(this).val() + '&produto=' + produto,
                type: 'GET',
                success: function (data) {
                    if (data.retorno == false) {
                        $('#H' + id).val(data.Codigo.id);
                        $('#erroCodigo').fadeOut('fast');
                        $('#H' + id).val(data.Codigo.id);
                        $('#' + id).attr('style', "border-color:black!important");
                    } else {
                        $('#erroCodigo').text(data.msg);
                        $('#erroCodigo').fadeIn('fast');
                        $('#' + id).attr('style', "border-color:red!important");
                    }
                    GerarPoximo(id, 'CD', produto);
                    $('#dvLoading').fadeOut('fast');
                }
            });
        }
    });
    $('.pCodigoLoteT').blur(function () {
        if ($(this).val() != '') {
            var id = $(this).attr('id');
            var produto = $('#ID' + id).val();
            $('#dvLoading').fadeIn('fast');
            $.ajax({
                url: www_root + 'entregas/pesquisarCodigo?codigo=' + $(this).val() + '&produto=' + produto,
                type: 'GET',
                success: function (data) {
                    if (data.retorno == false) {
                        $('#H' + id).val(data.Codigo.id);
                        $('#erroCodigo').fadeOut('fast');
                        $('#H' + id).val(data.Codigo.id);
                        $('#' + id).attr('style', "border-color:black!important");
                    } else {
                        $('#erroCodigo').text(data.msg);
                        $('#erroCodigo').fadeIn('fast');
                        $('#' + id).attr('style', "border-color:red!important");
                    }
                    GerarPoximo(id, 'CT', produto);
                    $('#dvLoading').fadeOut('fast');
                }
            });
        }
    });
}

$('#pesquisarEntregaLote').click(function () {
    $('#dvLoading').fadeIn('fast');
    $('.alert-success').fadeOut('fast');
    $.ajax({
        url: www_root + 'entregas/pesquisarLote?pedido=' + $('#pedido').val() + '&placa=' + $('#placa').val(),
        type: 'GET',
        success: function (data) {
            $("#tableKit tbody").detach();
            $("#tableCodigo tbody").detach();
            $("#EntregaPedidoId").val(data.Pedido.id);
            $("#EntregaObservacaoPedido").val(data.Pedido.observacao);
            $("#EntregaUnidadeId").val(data.Pedido.unidade_id);
            $('#tipoPedido').html(data.Pedido.tipo == 0 ? '<p class="bg-success avista col-sm-2">A Vista</p>' : '<p class="bg-danger aprazo col-sm-2">A Prazo</p>');
            $('#entrega').fadeIn('fast');
            var VAuto = 0;
            var pagas = 0;
            $("#EntregaNome").val(data.Cliente.nome);
            $.each(data.KitsPedido, function (index, value) {
                VAuto = value.autorizacao == null ? VAuto + 1 : VAuto;
                var entregue = value.entregue == false ? '<span style="color:red">Não</span>' : '<span style="color:green">Sim</span>';
                var paga = value.paga == false ? '<span style="color:red">Não</span>' : '<span style="color:green">Sim</span>';
                if (value.Kit.tipo == 1) {
                    var VCD = typeof value.Codigo[0] == 'undefined' ? '<input type="hidden" id="ID' + value.id + 'CD" value="1' + value.Kit.codigo + '"><input type="hidden" name="data[Codigo][' + value.id + '][DT]" id="H' + value.id + 'CD" value=""><input type="text" name="data[Codigo][' + value.id + '][dianteira]" id="' + value.id + 'CD" class="pCodigoLoteD tableVisivel">' : value.Codigo[0].codigo;
                    $("#tableCodigo").append('<tr><td>' + value.Kit.nome + '</td><td><input type="hidden" name="data[Placa][' + value.id + '][id]" value="' + value.id + '"><input type="hidden" name="data[Codigo][' + value.id + '][id]" value="' + value.id + '">' + value.placa + '</td><td>' + VCD + '</td><td>-/-</td></tr>');
                } else if (value.Kit.tipo == 2 || value.Kit.tipo == 4) {
                    var VCT = typeof value.Codigo[0] == 'undefined' ? '<input type="hidden" id="ID' + value.id + 'CT" value="2' + value.Kit.codigo + '"><input type="hidden" name="data[Codigo][' + value.id + '][TR]" id="H' + value.id + 'CT" value=""><input type="text" name="data[Codigo][' + value.id + '][traseira]" id="' + value.id + 'CT" class="pCodigoLoteT tableVisivel">' : value.Codigo[0].codigo;
                    $("#tableCodigo").append('<tr><td>' + value.Kit.nome + '</td><td><input type="hidden" name="data[Placa][' + value.id + '][id]" value="' + value.id + '"><input type="hidden" name="data[Codigo][' + value.id + '][id]" value="' + value.id + '">' + value.placa + '</td><td>-/-</td><td>' + VCT + '</td></tr>');
                } else if (value.Kit.tipo == 3) {
                    var VCD = typeof value.Codigo[0] == 'undefined' ? '<input type="hidden" id="ID' + value.id + 'CD" value="1' + value.Kit.codigo + '"><input type="hidden" name="data[Codigo][' + value.id + '][DT]" id="H' + value.id + 'CD" value=""><input type="text" name="data[Codigo][' + value.id + '][dianteira]" id="' + value.id + 'CD" class="pCodigoLoteD tableVisivel">' : value.Codigo[0].codigo;
                    var VCT = typeof value.Codigo[1] == 'undefined' ? '<input type="hidden" id="ID' + value.id + 'CT" value="2' + value.Kit.codigo + '"><input type="hidden" name="data[Codigo][' + value.id + '][TR]" id="H' + value.id + 'CT" value=""><input type="text" name="data[Codigo][' + value.id + '][traseira]" id="' + value.id + 'CT" class="pCodigoLoteT tableVisivel">' : value.Codigo[1].codigo;
                    $("#tableCodigo").append('<tr><td>' + value.Kit.nome + '</td><td><input type="hidden" name="data[Placa][' + value.id + '][id]" value="' + value.id + '"><input type="hidden" name="data[Codigo][' + value.id + '][id]" value="' + value.id + '">' + value.placa + '</td><td>' + VCD + '</td><td>' + VCT + '</td></tr>');
                }
                if (data.Pedido.tipo == 0) {
                    if (value.paga == true) {
                        pagas = 1;
                    }
                    pagas == 0 ? $('#concluir').remove() : '';
                }
            });
            validaCodigoLote();
            VAuto == 0 ? $('#concluir').remove() : '';
            $('#dvLoading').fadeOut('fast');
        }
    });
});

$('#baixarEntregaLote').click(function () {
    $('#dvLoading').fadeIn('fast');
    $.ajax({
        url: www_root + 'entregas/baixarLote/',
        data: $('#EntregaLoteForm').serialize(),
        type: 'POST',
        success: function (data) {
            $('#entrega').fadeOut('fast');
            $('#pedido').val('');
            $('#placa').val('');
            $('#EntregaObservacao').val('');
            $('.alert-success').fadeIn('fast');
            $('#dvLoading').fadeOut();
        }
    });
});



$('#baixarEntrega').click(function () {
    $('#dvLoading').fadeIn('fast');
    $.ajax({
        url: www_root + 'entregas/baixar/',
        data: $('#EntregaAddForm').serialize(),
        type: 'POST',
        success: function (data) {
            $('#entrega').fadeOut('fast');
            $('#pedido').val('');
            $('#placa').val('');
            $('#EntregaObservacao').val('');
            $('.alert-success').fadeIn('fast');
            $('#dvLoading').fadeOut();
        }
    });
});


/********************* FINAL FUNÇÕES ENTREGA **********************************/

/********************* INICIO FUNÇÕES PESQUISAR PEDIDO ************************/

$('#pesquisarPedido').click(function () {
    $('#dvLoading').fadeIn('fast');
    $.ajax({
        url: www_root + 'pedidos/pesquisarPedido?pedido=' + $('#pedido').val() + '&placa=' + $('#placa').val() + '&codigo=' + $('#codigo').val(),
        type: 'GET',
        success: function (data) {
            $("#tableKit tbody").detach();
            $("#tableCodigo tbody").detach();
            $("#tablePlaca tbody").detach();
            $('.caixa').fadeOut('fast');
            $('.Ncaixa').fadeOut('fast');
            $('.entregue').fadeOut('fast');
            $('.Nentregue').fadeOut('fast');
            $('#placasM').fadeOut('fast');
            $('#Pesquisar').fadeOut('fast');
            if (data.count == 1) {
                if ($('#pedido').val() != '') {
                    $('#numeroPedido').text(data.Pedido.id);
                    $('#nome').val(data.Cliente.Nome);
                    $('#categoria').val(data.Cliente.Categoria.nome);
                    var vTotal = 0;
                    $.each(data.KitsPedido, function (index, value) {
                        var valorParcial = value.valor_parcial != null ? 'R$ ' + format(value.valor_parcial) : '-';
                        var parcial = value.parcial == 0 ? 'Não' : 'Sim';
                        var renavan = value.renavan == null ? '-' : value.renavan;
                        var autorizacao = value.autorizacao == null ? '-' : value.autorizacao;
                        var entregue = value.entregue == false ? '<span style="color:red">Não</span>' : '<span style="color:green">Sim</span>';
                        var paga = value.paga == false ? '<span style="color:red">Não</span>' : '<span style="color:green">Sim</span>';
                        vTotal = parseFloat(vTotal) + parseFloat(value.valor);
                        $("#tableKit").append('<tr><td>' + value.Kit.nome + '</td><td>' + value.placa + '</td><td>' + value.tarjeta + '</td><td>' + renavan + '</td><td>' + autorizacao + '</td><td>' + parcial + '</td><td>' + valorParcial + '</td><td>' + entregue + '</td><td>' + paga + '</td><td>R$ ' + format(value.valor) + '</td></tr>');
                        if (value.Kit.tipo == 1) {
                            var VCD = typeof value.Codigo[0] == 'undefined' ? '-/-' : value.Codigo[0].codigo;
                            $("#tableCodigo").append('<tr><td>' + value.Kit.nome + '</td><td>' + value.placa + '</td><td>' + VCD + '</td><td>-/-</td></tr>');
                        } else if (value.Kit.tipo == 2 || value.Kit.tipo == 4) {
                            var VCT = typeof value.Codigo[0] == 'undefined' ? '-/-' : value.Codigo[0].codigo;
                            $("#tableCodigo").append('<tr><td>' + value.Kit.nome + '</td><td>' + value.placa + '</td><td>-/-</td><td>' + VCT + '</td></tr>');
                        } else if (value.Kit.tipo == 3) {
                            var VCD = typeof value.Codigo[0] == 'undefined' ? '-/-' : value.Codigo[0].codigo;
                            var VCT = typeof value.Codigo[1] == 'undefined' ? '-/-' : value.Codigo[1].codigo;
                            $("#tableCodigo").append('<tr><td>' + value.Kit.nome + '</td><td>' + value.placa + '</td><td>' + VCD + '</td><td>' + VCT + '</td></tr>');
                        }
                    });
                    var desconto = data.Pedido.desconto == '' ? '0.0' : data.Pedido.desconto;
                    $('.stotal').text('R$ ' + formatReal(vTotal));
                    $('.sdesconto').text('R$ ' + format(desconto));
                    $('.std').text('R$ ' + formatReal(parseFloat(vTotal) - desconto));
                    var dP = data.Pedido.created.split(" ");
                    $('#pus').text(data.Usuario.nome);
                    $('#pda').text(formatdata(dP[0]) + ' às ' + dP[1]);
                    $('#pun').text(data.Unidade.nome);
                    $('#pob').text(data.Pedido.observacao);
                    if (data.Pedido.pendente == true) {
                        $('.concluir').attr('href', www_root + 'pedidos/concluir/' + data.Pedido.id);
                        $('.concluir').fadeIn('fast');
                    }
                    if (data.Pedido.situacao == 1) {
                        $('.data').text('Data: ' + formatdataTime(data.PedidosExcluido[0].created));
                        $('.motivo').text('Motivo: ' + data.PedidosExcluido[0].observacao);
                        $('.PedidoExcluido').fadeIn('fast');

                        $('.imprimir').fadeOut('fast');
                        $('.excluir').fadeOut('fast');
                        $('.cancelar').fadeOut('fast');
                    } else if (data.Pedido.situacao == 2) {
                        $('.dataC').text('Data: ' + formatdataTime(data.PedidosCancelado[0].created));
                        $('.motivoC').text('Motivo: ' + data.PedidosCancelado[0].observacao);
                        $('.PedidoCancelado').fadeIn('fast');

                        $('.imprimir').fadeOut('fast');
                        $('.excluir').fadeOut('fast');
                        $('.cancelar').fadeOut('fast');

                    } else {
                        $('.imprimir').attr('href', www_root + 'pedidos/imprimir/' + data.Pedido.id);
                        $('.excluir').attr('href', www_root + 'Pedidosexcluidos/excluir/' + data.Pedido.id);
                        $('.cancelar').attr('href', www_root + 'Pedidoscancelados/index/' + data.Pedido.id);

                        $('.imprimir').fadeIn('fast');
                        $('.excluir').fadeIn('fast');
                        $('.cancelar').fadeIn('fast');

                        $('.alert').fadeOut('fast');
                    }
                } else {
                    $('#numeroPedido').text(data.Pedido.id);
                    $('#nome').val(data.Pedido.Cliente.Nome);
                    $('#categoria').val(data.Pedido.Cliente.Categoria.nome);
                    var valorParcial = data.KitsPedido.valor_parcial != null ? 'R$ ' + format(data.KitsPedido.valor_parcial) : '-';
                    var parcial = data.KitsPedido.parcial == 0 ? 'Não' : 'Sim';
                    var renavan = data.KitsPedido.renavan == null ? '-' : data.KitsPedido.renavan;
                    var autorizacao = data.KitsPedido.autorizacao == null ? '-' : data.KitsPedido.autorizacao;
                    var entregue = data.KitsPedido.entregue == false ? '<span style="color:red">Não</span>' : '<span style="color:green">Sim</span>';
                    var paga = data.KitsPedido.paga == false ? '<span style="color:red">Não</span>' : '<span style="color:green">Sim</span>';
                    $("#tableKit").append('<tr><td>' + data.Kit.nome + '</td><td>' + data.KitsPedido.placa + '</td><td>' + data.KitsPedido.tarjeta + '</td><td>' + renavan + '</td><td>' + autorizacao + '</td><td>' + parcial + '</td><td>' + valorParcial + '</td><td>' + entregue + '</td><td>' + paga + '</td><td>R$ ' + format(data.KitsPedido.valor) + '</td></tr>');
                    if (data.Kit.tipo == 1) {
                        var VCD = typeof data.Codigo[0] == 'undefined' ? '-/-' : data.Codigo[0].codigo;
                        $("#tableCodigo").append('<tr><td>' + data.Kit.nome + '</td><td>' + data.KitsPedido.placa + '</td><td>' + VCD + '</td><td>-/-</td></tr>');
                    } else if (data.Kit.tipo == 2 || data.Kit.tipo == 4) {
                        var VCT = typeof data.Codigo[0] == 'undefined' ? '-/-' : data.Codigo[0].codigo;
                        $("#tableCodigo").append('<tr><td>' + data.Kit.nome + '</td><td>' + data.KitsPedido.placa + '</td><td>-/-</td><td>' + VCT + '</td></tr>');
                    } else if (data.Kit.tipo == 3) {
                        var VCD = typeof data.Codigo[0] == 'undefined' ? '-/-' : data.Codigo[0].codigo;
                        var VCT = typeof data.Codigo[1] == 'undefined' ? '-/-' : data.Codigo[1].codigo;
                        $("#tableCodigo").append('<tr><td>' + data.Kit.nome + '</td><td>' + data.KitsPedido.placa + '</td><td>' + VCD + '</td><td>' + VCT + '</td></tr>');
                    }
                    var dP = data.Pedido.created.split(" ");
                    $('#pus').text(data.Pedido.Usuario.nome);
                    $('#pda').text(formatdata(dP[0]) + ' às ' + dP[1]);
                    $('#pun').text(data.Pedido.Unidade.nome);
                    $('#pob').text(data.Pedido.observacao);
                    if (data.Pedido.situacao == 1) {
                        $('.data').text('Data: ' + formatdataTime(data.Pedido.PedidosExcluido[0].created));
                        $('.motivo').text('Motivo: ' + data.Pedido.PedidosExcluido[0].observacao);
                        $('.alert').fadeIn('fast');

                        $('.imprimir').fadeOut('fast');
                        $('.excluir').fadeOut('fast');
                        $('.cancelar').fadeOut('fast');
                    } else if (data.Pedido.situacao == 2) {
                        $('.dataC').text('Data: ' + formatdataTime(data.PedidosCancelado[0].created));
                        $('.motivoC').text('Motivo: ' + data.PedidosCancelado[0].observacao);
                        $('.PedidoCancelado').fadeIn('fast');

                        $('.imprimir').fadeOut('fast');
                        $('.excluir').fadeOut('fast');
                        $('.cancelar').fadeOut('fast');

                    } else {
                        $('.imprimir').attr('href', www_root + 'pedidos/imprimir/' + data.Pedido.id);
                        $('.excluir').attr('href', www_root + 'Pedidosexcluidos/excluir/' + data.Pedido.id);
                        $('.cancelar').attr('href', www_root + 'Pedidoscancelados/index/' + data.Pedido.id);

                        $('.imprimir').fadeIn('fast');
                        $('.excluir').fadeIn('fast');
                        $('.cancelar').fadeIn('fast');

                        $('.alert').fadeOut('fast');
                    }
                }
                $('#tipoPedido').html(data.Pedido.tipo == 0 ? '<p class="bg-success avista col-sm-2">A Vista</p>' : '<p class="bg-danger aprazo col-sm-2">A Prazo</p>');
                if (data.Caixa != false) {
                    var dC = data.Caixa.created.split(" ");
                    $('#cQ').text(data.Caixa.Usuario.nome);
                    $('#cD').text(formatdata(dC[0]) + ' às ' + dC[1]);
                    $('#cU').text(data.Caixa.Unidade.nome);
                    $('#cO').text(data.Caixa.observacao);
                    $('.caixa').fadeIn('fast');
                } else {
                    $('.Ncaixa').fadeIn('fast');
                }
                if (data.Entrega != false) {
                    var dE = data.Entrega.created.split(" ");
                    $('#eU').text(data.Entrega.Usuario.nome);
                    $('#eD').text(formatdata(dE[0]) + ' às ' + dE[1]);
                    $('#eUn').text(data.Entrega.Unidade.nome);
                    $('#eOb').text(data.Entrega.observacao);
                    $('.entregue').fadeIn('fast');
                } else {
                    $('.Nentregue').fadeIn('fast');
                }
                $('#Pesquisar').fadeIn('fast');
            } else {
                $.each(data, function (index, value) {
                    if (index != 'count') {
                        $("#tablePlaca").append('<tr><td>' + value.KitsPedido.pedido_id + '</td><td>' + value.KitsPedido.placa + '</td><td>' + formatdataTime(value.KitsPedido.created) + '</td></tr>');
                    }
                });
                $('#placasM').fadeIn('fast');
            }
            $('#dvLoading').fadeOut('fast');
            $('#pedido').val('');
            $('#placa').val('');
            $('#codigo').val('');
        }
    });
});

/********************* FINAL FUNÇÕES PESQUISAR PEDIDO *************************/

/******************** INICIO FUNÇÕES CÓDIGO DE BARRAS *************************/
$('#CodigoCIndexForm').on('submit', function () {
    return false;
});

$('#adicionarCodigo').click(function () {
    $('#dvLoading').fadeIn('fast');
    $('#DCodigo').fadeIn('fast');
    $.ajax({
        url: www_root + 'codigos/codigo/',
        data: $('#CodigoCIndexForm').serialize(),
        type: 'POST',
        success: function (data) {
            if ($('#CodigoCCodigo').val() != '') {
                if (data[0] != false) {
                    $('.erro').fadeOut('fast');
                    $("#tabelaCodigo").append('<tr><td><input name="data[Codigos][id][]" readonly value="' + data[0] + '" style="border: none;background: none;" readonly></td><td>' + data[1] + '</td><td><input style="width: 250px;background: none;border: none;" name="data[Codigos][][codigo]" readonly value="' + data[2] + '" style="border: none;background: none;" readonly></td><td style="text-align: center;"><i class="remover glyphicon glyphicon-remove" style="cursor:pointer;color: red"></i></td></tr>');
                } else {
                    $('.erro').text(data[1]);
                    $('.erro').fadeIn('fast');
                }
                $('#CodigoCCodigo').val('');
                $('#CodigoCCodigo').focus();
            } else {
                $.each(data, function (index, value) {
                    $("#tabelaCodigo").append('<tr><td><input name="data[Codigos][id][]" readonly value="' + value[0] + '" style="border: none;background: none;" readonly></td><td>' + value[1] + '</td><td><input style="width: 250px;background: none;border: none;" name="data[Codigos][][codigo]" readonly value="' + value[2] + '" style="border: none;background: none;" readonly></td><td style="text-align: center;"><i class="remover glyphicon glyphicon-remove" style="cursor:pointer;color: red"></i></td></tr>');
                });
                $('#CodigoCCodigoC').val('');
                $('#CodigoCCodigoC').focus();
            }
            $('#dvLoading').fadeOut('fast');
        }
    });
});

$("#tabelaCodigo").on("click", ".remover", function (e) {
    $(this).closest('tr').remove();
});

$('#cadastrarCodigo').click(function () {
    $('#dvLoading').fadeIn('fast');
    $.ajax({
        url: www_root + 'codigos/cadastrar/',
        data: $('#CodigoIndexForm').serialize(),
        type: 'POST',
        success: function (data) {
            $('#DCodigo').fadeOut('fast');
            $("#tabelaCodigo tbody").detach();
            $('#dvLoading').fadeOut('fast');
        }
    });
});

/********************* FINAL FUNÇÕES CÓDIGO DE BARRAS *************************/

/********************** LANÇAMENTO DE CAIXA ***********************************/
$('#LancamentoBuscaForm').on('submit', function () {
    return false;
});
$('#buscarLancamento').click(function () {
    $('#dvLoading').fadeIn('fast');
    $("#tableLancamento tbody").detach();
    $.ajax({
        url: www_root + 'lancamentos/buscar/',
        data: $('#LancamentoBuscaForm').serialize(),
        type: 'POST',
        success: function (data) {
            var op;
            op = ['', 'Saída', 'Entrada', 'Transferência'];
            $.each(data, function (index, value) {
                $("#tableLancamento").append('<tr><td>' + value['Lancamento']['id'] + '</td><td>' + op[value['Lancamento']['operacao']] + '</td><td>' + value['PlanoConta']['nome'] + '</td><td>' + formatdata(value['Lancamento']['data']) + '</td><td>' + value['UnidadesLancamento']['nome'] + '</td><td>' + value['TipoPagamento']['nome'] + '</td><td>' + value['Lancamento']['historico'] + '</td><td>R$ ' + format(value['Lancamento']['valor']) + '</td><td><a class="btn btn-default" target="_blank" href="' + www_root + 'lancamentos/view/' + value['Lancamento']['id'] + '" role="button"><i class="glyphicon glyphicon-search"></i></a> <a class="btn btn-default" target="_blank" href="' + www_root + 'lancamentos/edit/' + value['Lancamento']['id'] + '" role="button"><i class="glyphicon glyphicon-pencil"></i></a> <a class="btn btn-default"  target="_blank" href="' + www_root + 'lancamentos/delete/' + value['Lancamento']['id'] + '" role="button"> <i class="glyphicon glyphicon-remove"></i></a></td></tr>');
            });
            table();
            $('.divD').fadeIn('fast');
            $('#dvLoading').fadeOut('fast');
        }
    });
});
/******************************************************************************/

/********************************* PRODUÇÃO ***********************************/

$('.concluir').click(function () {
    $.ajax({
        url: www_root + 'producao/concluir?id=' + $(this).attr('value'),
        type: 'POST',
        success: function (data) {
            window.location.reload();
        }
    });
});
$('.cancelar').click(function () {
    $.ajax({
        url: www_root + 'producao/cancelar?id=' + $(this).attr('value'),
        type: 'POST',
        success: function (data) {
            window.location.reload();
        }
    });
});

/******************************************************************************/

/******************************* RELATÓRIOS ***********************************/

//############### Financeiro
//Detalhado
$('#LancamentoDetalhadoForm').on('submit', function () {
    return false;
});
$('#gerarDetalhado').click(function () {
    $('#dvLoading').fadeIn('fast');
    $("#tableLancamentoDetalhado tbody").detach();
    $.ajax({
        url: www_root + 'lancamentos/gerarDetalhado/',
        data: $('#LancamentoDetalhadoForm').serialize(),
        type: 'POST',
        success: function (data) {
            var total = 0;
            $.each(data['Lan'], function (index, value) {
                $("#tableLancamentoDetalhado").append('<tr><td>' + value['Lancamento']['id'] + '</td><td>' + value['PlanoConta']['nome'] + '</td><td>' + formatdata(value['Lancamento']['data']) + '</td><td>' + data['Uni'][value['Lancamento']['unidade_geradora']] + '</td><td>' + value['Lancamento']['historico'] + '</td><td>' + value['TipoPagamento']['nome'] + '</td><td>R$ ' + format(value['Lancamento']['valor']) + '</td></tr>');
                total = parseFloat(total) + parseFloat(value['Lancamento']['valor']);
            });
            if (data['Op'] == 1) {
                $('.alert-danger').text('Total de Despesas: R$ ' + formatReal(total));
                $('.dispesas').fadeIn('fast');
                $('.receitas').fadeOut('fast');
            } else {
                $('.alert-success').text('Total de Receitas: R$ ' + formatReal(total));
                $('.receitas').fadeIn('fast');
                $('.dispesas').fadeOut('fast');
            }
            $('.divDE').fadeIn('fast');
            $('#dvLoading').fadeOut('fast');
            table();
        }
    });
});

//Consolidado
$('#LancamentoConsolidadoForm').on('submit', function () {
    return false;
});
$('#gerarConsolidado').click(function () {
    $('#dvLoading').fadeIn('fast');
    $("#tableLancamentoConsolidado tbody").detach();
    $.ajax({
        url: www_root + 'lancamentos/gerarConsolidado/',
        data: $('#LancamentoConsolidadoForm').serialize(),
        type: 'POST',
        success: function (data) {
            var total = 0;
            $.each(data['Lan'], function (index, value) {
                $("#tableLancamentoConsolidado").append('<tr><td>' + value['PlanoConta']['nome'] + '</td><td>' + data['Uni'][value['Lancamento']['unidade_geradora']] + '</td><td>R$ ' + value['0']['vTotal'] + '</td></tr>');
                var vTotal = value['0']['vTotal'].replace('.', '');
                var vTotal = vTotal.replace(',', '.');
                total = parseFloat(total) + parseFloat(vTotal);
            });
            if (data['Op'] == 1) {
                $('.alert-danger').text('Total de Despesas: R$ ' + formatReal(total));
                $('.dispesas').fadeIn('fast');
                $('.receitas').fadeOut('fast');
            } else {
                $('.alert-success').text('Total de Receitas: R$ ' + formatReal(total));
                $('.receitas').fadeIn('fast');
                $('.dispesas').fadeOut('fast');
            }
            table();
            $('.divCO').fadeIn('fast');
            $('#dvLoading').fadeOut('fast');
        }
    });
});

//########################## Estoque
$('#LogEstoqueProdutosForm').on('submit', function () {
    return false;
});
$('#gerarProduto').click(function () {
    $('#dvLoading').fadeIn('fast');
    $("#tableLogProduto tbody").detach();
    $.ajax({
        url: www_root + 'LogEstoques/gerarProdutos/',
        data: $('#LogEstoqueProdutosForm').serialize(),
        type: 'POST',
        success: function (data) {
            $.each(data, function (index, value) {
                $("#tableLogProduto").append('<tr><td>' + value['Produto']['id'] + '</td><td>' + value['Produto']['nome'] + '</td><td>' + value['0']['pTotal'] + '</td></tr>');
            });
            $('.divPR').fadeIn('fast');
            $('#dvLoading').fadeOut('fast');
            table();
        }
    });
});

$('#KitsPedidosProdutosForm').on('submit', function () {
    return false;
});
$('#gerarProdutoConsolidado').click(function () {
    $('#dvLoading').fadeIn('fast');
    $("#tableLogProduto tbody").detach();
    $.ajax({
        url: www_root + 'KitsPedidos/gerarProdutos/',
        data: $('#KitsPedidosProdutosForm').serialize(),
        type: 'POST',
        success: function (data) {
            $.each(data, function (index, value) {
                $("#tableLogProduto").append('<tr><td>' + value['produto']['nome'] + '</td><td>' + value['produto']['qtd'] + '</td></tr>');
            });
            $('.divPR').fadeIn('fast');
            $('#dvLoading').fadeOut('fast');
            table();
        }
    });
});

//MOVIMENTO DE ESTOQUE
$('#LogEstoqueMovimentoForm').on('submit', function () {
    return false;
});
$('#gerarMovimento').click(function () {
    $('#dvLoading').fadeIn('fast');
    $("#tableLogProduto tbody").detach();
    $.ajax({
        url: www_root + 'LogEstoques/gerarMovimento/',
        data: $('#LogEstoqueMovimentoForm').serialize(),
        type: 'POST',
        success: function (data) {
            $.each(data, function (index, value) {
                var tipo = value['LogEstoque']['tipo'] == 0 ? 'Adição' : 'Baixa';
                var transferencia = value['LogEstoque']['transferencia'] == 0 ? 'Não' : 'Sim';
                var unidade = value['LogEstoque']['transferencia'] == 0 ? '-' : value['UnidadeOrigenDestino']['nome'];
                $("#tableLogProduto").append('<tr><td>' + value['Produto']['nome'] + '</td><td>' + value['LogEstoque']['quantidade'] + '</td><td>' + tipo + '</td><td>' + transferencia + '</td><td>' + unidade + '</td></tr>');
            });
            $('.divPR').fadeIn('fast');
            $('#dvLoading').fadeOut('fast');
            table();
        }
    });
});

//PERDA DE MATERIAL
$('#PerdaRelatorioForm').on('submit', function () {
    return false;
});
$('#gerarPerda').click(function () {
    $('#dvLoading').fadeIn('fast');
    $("#tablePerda tbody").detach();
    $.ajax({
        url: www_root + 'Perdas/gerarPerda/',
        data: $('#PerdaRelatorioForm').serialize(),
        type: 'POST',
        success: function (data) {
            $.each(data[0], function (index, value) {
                value['Usuario']['nome'] = value['Usuario']['id'] == '1' ? 'Outros' : value['Usuario']['nome'];
                $("#tablePerda").append('<tr><td>' + value['Usuario']['nome'] + '</td><td>' + value['Perda']['pedido_id'] + '</td><td>' + value['Produto']['nome'] + '</td><td>' + value['Perda']['quantidade'] + '</td><td>' + formatdataTime(value['Perda']['created']) + '</td><td>' + value['Perda']['motivo'] + '</td><td>' + value['Unidade']['nome'] + '</td></tr>');
            });
            $('.divPR').fadeIn('fast');
            $('#dvLoading').fadeOut('fast');
            table();

            var ArrayGrafico = [];
            var ca = ['Ususario', 'Quantidade', {role: 'annotation'}];
            ArrayGrafico.push(ca);
            $.each(data[1], function (index, value) {
                value['Usuario']['nome'] = value['Usuario']['id'] == '1' ? 'Outros' : value['Usuario']['nome'];
                ArrayGrafico.push([value['Usuario']['nome'], parseInt(value[0]['tq']), value[0]['tq'] + ' Placas']);
            });

            google.charts.load("current", {packages: ['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable(ArrayGrafico);
                var options = {
                    title: "Perda de Material",
                    legend: {position: 'none'}
                };
                var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                chart.draw(data, options);
            }
        }
    });
});

//CONTROLE DE ESTOQUE
$('#EstoqueControleForm').on('submit', function () {
    return false;
});
$('#gerarControle').click(function () {
    $('#dvLoading').fadeIn('fast');
    $("#tableControle tbody").detach();
    $.ajax({
        url: www_root + 'estoques/gerarControle/',
        data: $('#EstoqueControleForm').serialize(),
        type: 'GET',
        success: function (data) {
            $('.divGE').fadeIn('fast');
            $('#dvLoading').fadeOut('fast');
            table();
        }
    });
});


//########################## Vendas
//Pedidos Gerados
$('#PedidosGeradosForm').on('submit', function () {
    return false;
});
$('#gerarGerados').click(function () {
    $('#dvLoading').fadeIn('fast');
    $("#tablePedidosGerados tbody").detach();
    $.ajax({
        url: www_root + 'pedidos/gerarGerados/',
        data: $('#PedidosGeradosForm').serialize(),
        type: 'POST',
        success: function (data) {
            var totalGeral = 0;
            var tp = 0;
            var tv = 0;
            $.each(data, function (index, value) {
                var pro = [];
                var pla = [];
                var val = [];
                var total = 0;
                $.each(value['KitsPedido'], function (ind, value) {
                    pro.push(value['Kit']['nome']);
                    pla.push(value['placa']);
                    val.push('R$ ' + format(value['valor']));
                    total = parseFloat(total) + parseFloat(value['valor']);
                });
                var tipo = value['Pedido']['tipo'] == 0 ? 'À Vista' : 'A Receber';
                var desconto = value['Pedido']['desconto'] != 0 ? 'R$ ' + format(value['Pedido']['desconto']) : '-';
                $("#tablePedidosGerados").append('<tr><td>' + value['Pedido']['id'] + '</td><td>' + pro.join('<br />') + '</td><td>' + pla.join('<br />') + '</td><td>' + formatdataTime(value['Pedido']['created']) + '</td><td>' + val.join('<br />') + '</td><td>' + desconto + '</td><td>R$ ' + formatReal(total - value['Pedido']['desconto']) + '</td><td>' + tipo + '</td></tr>');
                if (value['Pedido']['tipo'] == 0) {
                    tv = parseFloat(tv) + parseFloat(total - value['Pedido']['desconto']);
                } else {
                    tp = parseFloat(tp) + parseFloat(total - value['Pedido']['desconto']);
                }
                totalGeral = parseFloat(totalGeral) + parseFloat(total - value['Pedido']['desconto']);
            });
            $('.tv').text('Total À Vista: R$ ' + formatReal(tv));
            $('.tp').text('Total A Prazo: R$ ' + formatReal(tp));
            $('.tg').text('Total Geral: R$ ' + formatReal(totalGeral));
            $('.divGE').fadeIn('fast');
            $('#dvLoading').fadeOut('fast');
            table();
        }
    });
});

$("#LogEstoqueUnidadeId").change(function () {
    $.ajax({
        url: www_root + 'clientes/selectV/' + $(this).val(),
        success: function (data) {
            var html = '<option value=""> - Todos - </option>';
            $.each(data, function (id, value) {
                html += '<option value="' + value.Cliente.id + '">' + value.Cliente.nome + '</option>';
            });
            $("#LogEstoqueClienteId").html(html);
        }
    });
});

//Pedidos Replace
$("#PedidosReplaceUnidadeId").change(function () {
    $.ajax({
        url: www_root + 'clientes/select/' + $(this).val(),
        success: function (data) {
            var html = '<option value=""> - Todos - </option>';
            $.each(data, function (id, value) {
                html += '<option value="' + value.Cliente.id + '">' + value.Cliente.nome + '</option>';
            });
            $("#PedidosReplaceClienteId").html(html);
        }
    });
});
$("#PedidosReplaceClienteId").change(function () {
    if ($("#PedidosReplaceClienteId").val() != '') {
        $('.situacao').fadeIn('fast');
    } else {
        $("#PedidosReplaceTipo").val('0');
        $('.situacao').fadeOut('fast');
    }
});
$('#PedidosReplaceReplaceForm').on('submit', function () {
    return false;
});

//Pedidos a Receber
$("#PedidosAReceberUnidadeId").change(function () {
    $.ajax({
        url: www_root + 'clientes/select/' + $(this).val(),
        success: function (data) {
            var html = '<option value=""> - Todos - </option>';
            $.each(data, function (id, value) {
                html += '<option value="' + value.Cliente.id + '">' + value.Cliente.nome + '</option>';
            });
            $("#PedidosAReceberClienteId").html(html);
        }
    });
});
$("#PedidosAReceberClienteId").change(function () {
    if ($("#PedidosAReceberClienteId").val() != '') {
        $('.situacao').fadeIn('fast');
    } else {
        $("#PedidosAReceberSituacao").val('0');
        $('.situacao').fadeOut('fast');
    }
});
$('#PedidosAReceberReceberForm').on('submit', function () {
    return false;
});
$('#gerarReceber').click(function () {
    $('#dvLoading').fadeIn('fast');
    $('.uni').fadeOut('fast');
    $('.cli').fadeOut('fast');
    $('.tPago').fadeOut('fast');
    $('.tAberto').fadeOut('fast');
    $("#tableAReceber tbody").detach();
    $.ajax({
        url: www_root + 'pedidos/gerarReceber/',
        data: $('#PedidosAReceberReceberForm').serialize(),
        type: 'POST',
        success: function (data) {
            var tPago = 0;
            var tAberto = 0;
            var valor;
            if ($("#PedidosAReceberClienteId").val() == '') {
                $.each(data, function (index, value) {
                    valor = value['0']['vTotal'] - value['0']['pTotal'];
                    $("#tableAReceber").append('<tr><td>' + value['Pedido']['cliente_id'] + '</td><td>' + value['Pedido']['Cliente']['nome'] + '</td><td>R$ ' + format(valor) + '</td></tr>');
                    tAberto = parseFloat(tAberto) + parseFloat(value['0']['vTotal'] - value['0']['pTotal']);
                });
                var tA = tAberto != '' ? 'Total em Aberto R$: ' + formatReal(tAberto) : 'Total em Aberto R$: 0,0';
                $('.tAberto').text(tA);
                $('.tAberto').fadeIn('fast');
                $('.uni').fadeIn('fast');
                $('.ts-pager').attr('colspan', 3);
            } else {
                $.each(data, function (index, value) {
                    var tipo = value['Pedido']['tipo'] == false ? 'Á Vista' : 'A Receber';
                    var situacao = value['KitsPedido']['paga'] == false ? 'Aberto' : 'Pago';
                    var valor;
                    if (value['KitsPedido']['parcial'] == 1) {
                        valor = value['KitsPedido']['valor'] - value['KitsPedido']['valor_parcial'];
                    } else {
                        valor = value['KitsPedido']['valor'];
                    }

                    $("#tableAReceber").append('<tr><td>' + value['Pedido']['id'] + '</td><td>' + value['Kit']['nome'] + '</td><td>' + value['KitsPedido']['placa'] + '</td><td>R$ ' + format(valor) + '</td><td>' + tipo + '</td><td>' + formatdataTime(value['KitsPedido']['created']) + '</td><td>' + situacao + '</td></tr>');

                    if (value['KitsPedido']['paga'] == false) {
                        tAberto = parseFloat(tAberto) + parseFloat(value['KitsPedido']['valor'] - value['KitsPedido']['valor_parcial']);
                    } else {
                        tPago = parseFloat(tPago) + parseFloat(value['KitsPedido']['valor']);
                    }
                });
                if ($("#PedidosAReceberSituacao").val() == '' || $("#PedidosAReceberSituacao").val() == 1) {
                    var tP = tPago != '' ? 'Total Pago R$: ' + formatReal(tPago) : 'Total Pago R$: 0,0';
                    $('.tPago').text(tP);
                    $('.tPago').fadeIn('fast');
                }
                if ($("#PedidosAReceberSituacao").val() == '' || $("#PedidosAReceberSituacao").val() == 0) {
                    var tA = tAberto != '' ? 'Total em Aberto R$: ' + formatReal(tAberto) : 'Total em Aberto R$: 0,0';
                    $('.tAberto').text(tA);
                    $('.tAberto').fadeIn('fast');
                }
                $('.cli').fadeIn('fast');
                $('.ts-pager').attr('colspan', 7);
            }
            table();
            $('.divREC').fadeIn('fast');
            $('#dvLoading').fadeOut('fast');
        }
    });
});


// RESUMO DE PEDIDOS
$("#ResumoUnidadeId").change(function () {
    $.ajax({
        url: www_root + 'clientes/todos/' + $(this).val(),
        success: function (data) {
            var html = '<option value=""> - Todos - </option>';
            $.each(data, function (id, value) {
                html += '<option value="' + value.Cliente.id + '">' + value.Cliente.nome + '</option>';
            });
            $("#ResumoClienteId").html(html);
        }
    });
});
$('#ResumoResumoForm').on('submit', function () {
    return false;
});
$('#gerarResumo').click(function () {
    $('#dvLoading').fadeIn('fast');
    $("#tableResumo tbody").detach();
    $.ajax({
        url: www_root + 'pedidos/gerarResumo/',
        data: $('#ResumoResumoForm').serialize(),
        type: 'POST',
        success: function (data) {
            var tAberto = 0;
            var tPago = 0;
            $.each(data, function (index, value) {
                var entregue = value['KitsPedido']['entregue'] == 1 ? '<span style="color:green">Entregue</span>' : '<span style="color:red">Em Aberto</span>';
                if (value['KitsPedido']['parcial'] == 1) {
                    var caixa = '<span style="color:#B9B900">Parcial</span>';
                    var valor = value['KitsPedido']['valor'] - value['KitsPedido']['valor_parcial'] - value['Pedido']['desconto'];
                } else {
                    var caixa = value['KitsPedido']['paga'] == 1 ? '<span style="color:green">Paga</span>' : '<span style="color:red">Em Aberto</span>';
                    var valor = value['KitsPedido']['valor'] - value['Pedido']['desconto'];
                }
                var desconto = value['Pedido']['desconto'] == '' ? ' - ' : format(value['Pedido']['desconto']);
                $("#tableResumo").append('<tr><td>' + value['Pedido']['id'] + '</td><td>' + value['Kit']['nome'] + '</td><td>' + value['KitsPedido']['placa'] + '</td><td>' + formatdataTime(value['KitsPedido']['created']) + '</td><td>R$ ' + format(value['KitsPedido']['valor']) + '</td><td>' + desconto + '</td><td>R$ ' + formatReal(valor) + '</td><td>' + caixa + '</td><td>' + entregue + '</td></tr>');
                if (value['KitsPedido']['paga'] == 0) {
                    tAberto = parseFloat(tAberto) + parseFloat(valor);
                } else {
                    tPago = parseFloat(tPago) + parseFloat(valor);
                }
            });
            $('.tv').text('Total Pago: R$ ' + formatReal(tPago));
            $('.tp').text('Total Em Aberto: R$ ' + formatReal(tAberto));
            $('.divRES').fadeIn('fast');
            $('#dvLoading').fadeOut('fast');
            table();
        }
    });
});


//**************************RANK DE VENDAS
$('#PedidosVendasForm').on('submit', function () {
    return false;
});
$('#gerarVendas').click(function () {
    $('#dvLoading').fadeIn('fast');
    $("#tableVendas tbody").detach();
    $.ajax({
        url: www_root + 'pedidos/gerarVendas/',
        data: $('#PedidosVendasForm').serialize(),
        type: 'POST',
        success: function (data) {
            var ArrayGrafico = [];
            var ca = ['Usuário', 'Valor'];
            ArrayGrafico.push(ca);
            $.each(data, function (index, value) {
                $("#tableVendas").append('<tr><td>' + value['usuario'] + '</td><td>R$ ' + formatReal(value['valor']) + '</td></tr>');
                ArrayGrafico.push([value['usuario'], value['valor']]);
            });
            $('.divVE').fadeIn('fast');
            $('#dvLoading').fadeOut('fast');
            table();

            google.charts.load("current", {packages: ["corechart"]});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable(ArrayGrafico);

                var options = {
                    title: 'Rank de vendas'
                };

                var formatter = new google.visualization.NumberFormat({
                    decimalSymbol: ',',
                    groupingSymbol: '.',
                    negativeColor: 'red',
                    negativeParens: true,
                    prefix: 'R$ '
                });
                formatter.format(data, 1);

                var formatter = new google.visualization.NumberFormat({
                    prefix: 'R$: '
                });

                var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                chart.draw(data, options);
            }
        }
    });
});

//**************************RANK DE VENDAS
$('#CodigosRelatorioForm').on('submit', function () {
    return false;
});
$('#gerarCodigos').click(function () {
    $('#dvLoading').fadeIn('fast');
    $("#tableCodigos tbody").detach();
    $.ajax({
        url: www_root + 'codigos/gerarRelatorio/',
        data: $('#CodigosRelatorioForm').serialize(),
        type: 'POST',
        success: function (data) {
            $.each(data, function (index, value) {
                var placa = value['KitsPedido'][0] != null ? value['KitsPedido'][0]['placa'].toUpperCase() : ' - ';
                var situacao = value['Codigo']['situacao'] == 0 ? 'Em Aberto' : 'Entregue';
                $("#tableCodigos").append('<tr><td>' + value['Codigo']['codigo'] + '</td><td>-</td><td>' + placa + '</td><td>' + situacao + '</td></tr>');
            });
            $('.divCO').fadeIn('fast');
            $('#dvLoading').fadeOut('fast');
            table();
        }
    });
});

/******************************************************************************/

/******************* VALIDAÇÃO DOS CAMPOS *********************/

$("#validate").validate({});

$(".obrigatorio").each(function () {
    $(this).rules('add', {
        required: true,
        messages: {
            required: "Campo Obrigatorio"
        }
    });
});

$(".cpf").rules('add', {
    required: true,
    cpf: 'both',
    messages: {
        required: "Campo Obrigatorio"
    }
});




if ($("body").hasClass(".c_email")) {
    $(".c_email").rules('add', {
        required: true,
        email: true,
        messages: {
            required: "Campo Obrigatorio",
            email: "Digite um <strong>email</strong> válido"
        }
    });
}
