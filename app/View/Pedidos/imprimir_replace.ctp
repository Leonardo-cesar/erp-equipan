<h4 style="text-align: center;font-weight: bold">Período: <?php echo $this->Session->read('PedidosReplace.Replace.dataInicial') ?> à <?php echo $this->Session->read('PedidosReplace.Replace.dataFinal') ?> </h3>
<?php if (isset($cliente)) { ?>
    <h4 style="text-align: center;font-weight: bold">Cliente: <?php echo $cliente['Cliente']['nome'] ?></h4>
<?php } ?>
<h4 style="text-align: center;font-weight: bold">Unidade: <?php echo $unidade['Unidade']['nome'] ?></h4>
<h4 style="text-align: center;font-weight: bold">Tipo: <?php echo $this->Session->read('PedidosReplace.Replace.tipo') != '' ? $this->Session->read('PedidosReplace.Replace.tipo') == false ? 'À Vista' : 'A Receber' : ' Todos' ?></h4>
<h4 style="text-align: center;font-weight: bold">Situação: <?php echo $this->Session->read('PedidosReplace.Replace.situacao') != '' ? $this->Session->read('PedidosReplace.Replace.situacao') == false ? 'Aberto' : 'Pago' : 'Todos' ?></h4>
<hr />
<table class="table table-bordered">
    <thead>
            <tr>
                <th>Pedido</th>
                <th>Produtos</th>
                <th>Placas</th>
                <th>Valor</th>
                <th>Tipo</th>
                <th>Data</th>
                <th>Situação</th>
            </tr>
    </thead>
    <tbody>
        <?php
        $ta = 0;
        $tp = 0;
        ?>
        <?php foreach ($data as $pedido) { ?>
            <?php if ($this->Session->read('PedidosReplace.Replace.cliente_id') == '') { ?>
                <tr>
                    <td><?php echo $pedido['Pedido']['cliente_id'] ?></td>
                    <td><?php echo $pedido['Pedido']['Cliente']['nome'] ?></td>
                    <td>R$ <?php echo $pedido['0']['vTotal'] ?></td>
                </tr>
                <?php $vt = str_replace('.', '', $pedido['0']['vTotal']); ?>
                <?php $vt = str_replace(',', '.', $vt); ?>
                <?php $ta = $ta + $vt; ?>
            <?php } else { ?>
                <tr>
                    <td><?php echo $pedido['Pedido']['id'] ?></td>
                    <td><?php echo $pedido['Kit']['nome'] ?></td>
                    <td><?php echo $pedido['KitsPedido']['placa'] ?></td>
                    <td>R$: <?php echo number_format($pedido['KitsPedido']['valor'], 2, ',', '.') ?></td>
                    <td><?php echo $pedido['Pedido']['tipo'] == false ? 'Á Vista' : 'A Receber' ?></td>
                    <td><?php echo date('d/m/Y', strtotime($pedido['KitsPedido']['created'])) ?></td>
                    <td><?php echo $pedido['KitsPedido']['paga'] == false ? 'Aberto' : 'Paga' ?></td>
                </tr>
                <?php if ($pedido['KitsPedido']['paga'] == 1) { ?>
                    <?php $tp = $tp + $pedido['KitsPedido']['valor']; ?>
                <?php } else { ?>
                    <?php $ta = $ta + $pedido['KitsPedido']['valor']; ?>
                <?php } ?>
            <?php } ?>
        <?php } ?>
    </tbody>
</table>
<h5 style="font-weight: bold">Total em Aberto: R$ <?php echo number_format($this->request->query['valor'], 2, ',', '.') ?></h5>