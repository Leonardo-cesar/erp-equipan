<?php echo $this->assign('title', 'Relatorio_de_Perda_de_Material'); ?>
<span style="text-align: center;font-weight: bold">Per&iacute;odo: <?php echo $this->Session->read('Perda.relatorio.dataInicial') ?> &agrave; <?php echo $this->Session->read('Perda.relatorio.dataFinal') ?> </span><br />
<span style="text-align: center;font-weight: bold">Unidade: <?php echo $unidade ?></span><br />
<span style="text-align: center;font-weight: bold">Produto: <?php echo $produto ?></span>
<table border=1 cellspacing=0 cellpadding=2 bordercolor="666633"> 
    <thead>
        <tr>
            <th>Pedido</th>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Data</th>
            <th>Motivo</th>
            <th>Unidade</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($perdas as $perda) { ?>
            <tr>
                <td><?php echo $perda['Perda']['pedido_id'] ?></td>
                <td><?php echo utf8_decode($perda['Produto']['nome']) ?></td>
                <td><?php echo $perda['Perda']['quantidade'] ?></td>
                <td><?php echo date('d/m/Y', strtotime($perda['Perda']['created'])) ?></td>
                <td><?php echo utf8_decode($perda['Perda']['motivo']) ?></td>
                <td><?php echo utf8_decode($perda['Unidade']['nome']) ?></td>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot></tfoot>
</table>