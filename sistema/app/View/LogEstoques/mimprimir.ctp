<h4 style="text-align: center;font-weight: bold">Período: <?php echo $this->Session->read('LogEstoque.Movimento.dataInicial') ?> à <?php echo $this->Session->read('LogEstoque.Movimento.dataFinal') ?> </h4>
<h4 style="text-align: center;font-weight: bold">Tipo: <?php echo $tipo ?></h4>
<h4 style="text-align: center;font-weight: bold">Unidade: <?php echo $unidade ?></h4>
<h4 style="text-align: center;font-weight: bold">Produto: <?php echo $produto ?></h4>
<hr />
<table class="table table-bordered">
    <thead>
        <tr>
        <tr>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Tipo</th>
            <th>Transferência</th>
            <th>Origem/Destino</th>
        </tr>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($log as $produto) { ?>
            <tr>
                <td><?php echo $produto['Produto']['nome'] ?></td>
                <td><?php echo $produto['LogEstoque']['quantidade'] ?></td>
                <td><?php echo $produto['LogEstoque']['tipo'] == 1 ? 'Baixa' : 'Adição' ?></td>
                <td><?php echo $produto['LogEstoque']['transferencia'] == 1 ? 'Sim' : 'Não' ?></td>
                <td><?php echo $produto['LogEstoque']['transferencia'] == 1 ? $produto['UnidadeOrigenDestino']['nome'] : ' -' ?></td>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot></tfoot>
</table>