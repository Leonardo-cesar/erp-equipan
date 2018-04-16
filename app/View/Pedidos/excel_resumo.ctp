<?php echo $this->assign('title', 'Relatorio_de_Resumo_de_Pedidos'); ?>
<span style="text-align: center;font-weight: bold">Per&iacute;odo: <?php echo date("d/m/Y", strtotime($this->request->data['Resumo']['dataInicial'])) ?> &agrave; <?php echo date("d/m/Y", strtotime($this->request->data['Resumo']['dataFinal'])) ?> </span><br />
<span style="text-align: center;font-weight: bold">Unidade: <?php echo $unidade['Unidade']['nome'] ?></span><br />
<?php if ($cliente != NULL) { ?>
    <span style="text-align: center;font-weight: bold">Cliente: <?php echo $cliente ?></span><br />
<?php } ?>
<span style="text-align: center;font-weight: bold">Tipo: <?php echo $tipo ?></span><br />
<span style="text-align: center;font-weight: bold">Caixa: <?php echo $caixa ?></span><br />
<span style="text-align: center;font-weight: bold">Entrega: <?php echo $entrega ?></span><br />
<table border=1 cellspacing=0 cellpadding=2 bordercolor="666633"> 
    <thead>
        <tr>
            <th>Pedido</th>
            <th>Produtos</th>
            <th>Placa</th>
            <th>Data</th>
            <th>Valor</th>
            <th>Des.</th>
            <th>Total</th>
            <th>Caixa</th>
            <th>Entrega</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $tAberto = 0;
        $tPago = 0;
        ?>
        <?php foreach ($data as $pedido) { ?>
            <?php
            $entregue = $pedido['KitsPedido']['entregue'] == true ? '<span style="color:green">Entregue</span>' : '<span style="color:red">Em Aberto</span>';
            if ($pedido['KitsPedido']['parcial'] == 1) {
                $caixa = '<span style="color:#B9B900">Parcial</span>';
                $valor = $pedido['KitsPedido']['valor'] - $pedido['KitsPedido']['valor_parcial'] - $pedido['Pedido']['desconto'];
            } else {
                $caixa = $pedido['KitsPedido']['paga'] == true ? '<span style="color:green">Paga</span>' : '<span style="color:red">Em Aberto</span>';
                $valor = $pedido['KitsPedido']['valor'] - $pedido['Pedido']['desconto'];
            }
            $desconto = $pedido['Pedido']['desconto'] == '' ? ' - ' : number_format($pedido['Pedido']['desconto'], 2, ',', '.');
            ?>
            <tr>
                <td><?php echo $pedido['Pedido']['id'] ?></td>
                <td><?php echo $pedido['Kit']['nome'] ?></td>
                <td><?php echo $pedido['KitsPedido']['placa'] ?></td>
                <td><?php echo date('d/m/Y', strtotime($pedido['KitsPedido']['created'])) ?></td>
                <td><?php echo number_format($pedido['KitsPedido']['valor'], 2, ',', '.') ?></td>
                <td><?php echo $desconto ?></td>
                <td><?php echo number_format($valor, 2, ',', '.') ?></td>
                <td><?php echo $caixa ?></td>
                <td><?php echo $entregue ?></td>
            </tr>
            <?php
            if ($pedido['KitsPedido']['paga'] == 0) {
                $tAberto = $tAberto + $valor;
            } else {
                $tPago = $tPago + $valor;
            }
            ?>
        <?php } ?>
    </tbody>
</table>
<h5 style="font-weight: bold">
    Total Pago: R$ <?php echo number_format($tPago, 2, ',', '.') ?><br />
    Total Em Aberto: R$<?php echo number_format($tAberto, 2, ',', '.') ?><br />
</h5>