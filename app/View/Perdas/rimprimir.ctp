<h4 style="text-align: center;font-weight: bold">Período: <?php echo $this->Session->read('Perda.relatorio.dataInicial') ?> à <?php echo $this->Session->read('Perda.relatorio.dataFinal') ?> </h4>
<h4 style="text-align: center;font-weight: bold">Unidade: <?php echo $unidade ?></h4>
<h4 style="text-align: center;font-weight: bold">Produto: <?php echo $produto ?></h4>
<hr />
<table class="table table-bordered">
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
                <td><?php echo $perda['Produto']['nome'] ?></td>
                <td><?php echo $perda['Perda']['quantidade'] ?></td>
                <td><?php echo date('d/m/Y', strtotime($perda['Perda']['created'])) ?></td>
                <td><?php echo $perda['Perda']['motivo']?></td>
                <td><?php echo $perda['Unidade']['nome'] ?></td>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot></tfoot>
</table>