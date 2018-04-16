<?php echo $this->assign('title', 'Relatorio_de_Pedidos_Gerados'); ?>
<span style="text-align: center;font-weight: bold">Per&iacute;odo: <?php echo date("d/m/Y", strtotime($this->request->data['Pedidos']['dataInicial'])) ?> &agrave; <?php echo date("d/m/Y", strtotime($this->request->data['Pedidos']['dataFinal'])) ?> </span><br />
<span style="text-align: center;font-weight: bold">Unidade: <?php echo $unidade['Unidade']['nome'] ?></span><br />
<?php if ($cliente != NULL) { ?>
    <span style="text-align: center;font-weight: bold">Cliente: <?php echo $cliente['Cliente']['nome'] ?></span>
<?php } ?>
<table border=1 cellspacing=0 cellpadding=2 bordercolor="666633"> 
    <thead>
        <tr>
            <th>N</th>
            <th>Produtos</th>
            <th>Placa</th>
            <th>Data</th>
            <th>Valor</th>
            <th>Desconto</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $tv = 0;
        $tp = 0;
        $totalGeral = 0;
        ?>
        <?php foreach ($pedidos as $key => $pedido) { ?>
            <?php
            $total = 0;
            foreach ($pedido['KitsPedido'] as $placa) {
                $pro[$key][] = $placa['Kit']['nome'];
                $pla[$key][] = $placa['placa'];
                $val[$key][] = 'R$ ' . number_format($placa['valor'], 2, ',', '.');
                $total = $total + $placa['valor'];
            }
            $desconto = $pedido['Pedido']['desconto'] != 0 ? 'R$ ' . number_format($pedido['Pedido']['desconto']) : '-';
            if ($pedido['Pedido']['tipo'] == 0) {
                $tv = $tv + ($total - $pedido['Pedido']['desconto']);
            } else {
                $tp = $tp + ($total - $pedido['Pedido']['desconto']);
            }
            $totalGeral = $totalGeral + ($total - $pedido['Pedido']['desconto']);
            ?>
            <tr>
                <td><?php echo $pedido['Pedido']['id'] ?></td>
                <td><?php echo implode($pro[$key], '<br />') ?></td>
                <td><?php echo implode($pla[$key], '<br />') ?></td>
                <td><?php echo date('d/m/Y', strtotime($pedido['Pedido']['created'])) ?></td>
                <td><?php echo implode($val[$key], '<br />') ?></td>
                <td><?php echo $desconto ?></td>
                <td>R$ <?php echo number_format($total - $pedido['Pedido']['desconto'], 2, ',', '.') ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<h5 style="font-weight: bold">
    Total &Agrave; Vista: R$ <?php echo number_format($tv, 2, ',', '.') ?><br />
    Total A Receber: R$<?php echo number_format($tp, 2, ',', '.') ?><br />
    Total Gerado: R$<?php echo number_format($totalGeral, 2, ',', '.') ?>
</h5>