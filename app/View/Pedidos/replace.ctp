<div class="pedidos form">
    <fieldset>
        <legend>Pedidos a Receber</legend>
        <?php echo $this->Form->create('PedidosReplace', array("class" => "form-horizontal")); ?>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('dataInicial', array('type' => 'text', 'div' => 'col-sm-12', 'label' => 'De', 'class' => 'datepicker form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('dataFinal', array('type' => 'text', 'div' => 'col-sm-12', 'label' => 'Até', 'class' => 'datepicker form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo count($UnidadesLogadas) > 1 || $this->Session->read('Auth.User.nivel_id') == 1 ? $this->Form->input('unidade_id', array('label' => 'Unidade', 'class' => 'form-control', 'div' => 'col-sm-12', 'empty' => ' - Selecione a Unidade -', 'options' => $UnidadesLogadas)) : $this->Form->input('unidade_id', array('label' => 'Unidade', 'div' => 'col-sm-12', 'class' => 'obrigatorio form-control', 'options' => $UnidadesLogadas)); ?>
        </div>
        <br clear="all"/>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('cliente_id', array('type' => 'select', 'empty' => ' - Todos - ', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group col-sm-3">
            <?php echo $this->Form->input('tipo', array('type' => 'select', 'empty' => ' - Todos - ', 'options' => array('0' => 'À Vista', '1' => 'A Receber'), 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group col-sm-3 situacao" style="display: none">
            <?php echo $this->Form->input('situacao', array('type' => 'select', 'empty' => ' - Todos - ', 'default' => '0', 'options' => array('0' => 'Aberto'), 'div' => 'col-sm-12', 'label' => 'Situação', 'class' => 'form-control')); ?>
        </div>
        <br clear="all"/>
        <button type="submit" class="btn btn-success" id="gerarReplace"><i class="glyphicon glyphicon-refresh"></i> Gerar</button>
        <br clear="all"/>
        <?php echo $this->Form->end(); ?>
        <div class="divREC form-group col-sm-12" style="display: none">
            <br clear="all"/>
            <hr />
            <br clear="all"/>
            <?php echo $this->Html->link('<i class="glyphicon glyphicon glyphicon-download-alt"></i> Excel', '/pedidos/excelReceber/', array('escape' => false, 'class' => 'btn btn-info', 'target' => '_blank')) ?>
            <br />
            <br />
            <table class='table table-striped table-bordered' id="tableReplace">
                <thead>
                    <tr>
                        <th>Pedido</th>
                        <th>Produtos</th>
                        <th>Placas</th>
                        <th>Valor</th>
                        <th>Desc.</th>
                        <th>T/D</th>
                        <th>Tipo</th>
                        <th>Data</th>
                        <th>Situação</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <br clear="all" />
            <div class="col-sm-12">
                <div class="col-sm-6 alert alert-danger" role="alert">Total de desconto: R$ <i id="td">0,0</i></div><br clear="all" />
                <div class="col-sm-6 alert alert-success" role="alert">Total com o desconto: R$ <i id="tcd">0,0</i></div>
                <br clear="all" />
                <hr />
                <?php echo $this->Html->link('<i class="glyphicon glyphicon-print"></i> Imprimir', '/pedidos/imprimirReplace/', array('escape' => false,'id' => 'imprimirReplace', 'class' => 'btn btn-primary', 'target' => '_blank')) ?>
            </div>
        </div>
    </fieldset>
</div>
<script>
function getTotal(column = 1) {
    let result = 0;
    let columns = $("#tableReplace tr td:nth-child(" + column + ")");

    columns.each(i => {
        result += parseFloat($(columns[i]).text());
    });

    return result;
}

$('#gerarReplace').click(function () {
    $('#dvLoading').fadeIn('fast');
    $('.uni').fadeOut('fast');
    $('.cli').fadeOut('fast');
    $('.tPago').fadeOut('fast');
    $('.tAberto').fadeOut('fast');
    $("#tableReplace tbody").detach();
    $.ajax({
        url: www_root + 'pedidos/gerarReplace/',
        data: $('#PedidosReplaceReplaceForm').serialize(),
        type: 'POST',
        success: function (data) {
            var tPago = 0;
            var tAberto = 0;
            var valor;
            $.each(data, function (index, value) {
                var tipo = value['Pedido']['tipo'] == false ? 'Á Vista' : 'A Receber';
                var situacao = value['KitsPedido']['paga'] == false ? 'Aberto' : 'Pago';
                var valor;
                if (value['KitsPedido']['parcial'] == 1) {
                    valor = value['KitsPedido']['valor'] - value['KitsPedido']['valor_parcial'];
                } else {
                    valor = value['KitsPedido']['valor'];
                }

                $("#tableReplace").append('<tr><td>' + value['Pedido']['id'] + '</td><td>' + value['Kit']['nome'] + '</td><td>' + value['KitsPedido']['placa'] + '</td><td><input class="Repv" id="vid' + value['KitsPedido']['id'] + '" value=' + valor + ' type="hidden">R$ ' + format(valor) + '</td><td style="width: 10%;"><input name="desc" class="maskMoney RepDesc"  id="' + value['KitsPedido']['id'] + '" value="0,0" style="width: 60%;" type="text"><i style="display:none" id="tdesc' + value['KitsPedido']['id'] + '">0,00</i></td><td style="width: 10%;"><input name="totalDesc"  id="tdid' + value['KitsPedido']['id'] + '" value="0,00" type="hidden"><i id="ttdid' + value['KitsPedido']['id'] + '">0,00</i></td><td>' + tipo + '</td><td>' + formatdataTime(value['KitsPedido']['created']) + '</td><td>' + situacao + '</td></tr>');

                tAberto = parseFloat(tAberto) + parseFloat(value['KitsPedido']['valor'] - value['KitsPedido']['valor_parcial']);
            });
            var ta = tAberto;
            $("#tcd").html(formatReal(tAberto));
            $(".maskMoney").maskMoney({showSymbol: true, decimal: ",", thousands: "."});
            $('.divREC').fadeIn('fast');
            $('#dvLoading').fadeOut('fast');
            $(".RepDesc").keyup(function () {
                var id = $(this).attr('id');
                var des = $('#' + id).val();
                var valo = $('#vid' + id).val();
                var desc = des.replace(',', ".");
                var valor = valo.replace(',', ".");
                var total = parseFloat(valor) - parseFloat(desc);
                $('#tdesc' + id).text(desc);
                $('#tdid' + id).val(formatReal(total));
                $('#ttdid' + id).text(formatReal(total));
                $("#td").html(formatReal(getTotal(5)));
                $("#tcd").html(formatReal(ta - getTotal(5)));
                var l = window.location;
                var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
                $("#imprimirReplace").attr("href", base_url + "/imprimirReplace?valor=" + (ta - getTotal(5)));
            });
        }
    });
});
</script>