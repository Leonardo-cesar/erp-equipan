<h4 style="text-align: center;font-weight: bold">Período: <?php echo $this->Session->read('LogEstoque.Produtos.dataInicial') ?> à <?php echo $this->Session->read('LogEstoque.Produtos.dataFinal') ?> </h4>
<h4 style="text-align: center;font-weight: bold">Unidade: <?php echo $unidade['Unidade']['nome'] ?></h4>
<hr />
<table class="table table-bordered">
    <thead>
        <tr>
        <tr>
            <th>N°</th>
            <th>Produto</th>
            <th>Quantidade</th>
        </tr>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($log as $produto) { ?>
            <tr>
                <td><?php echo $produto['Produto']['id'] ?></td>
                <td><?php echo $produto['Produto']['nome'] ?></td>
                <td><?php echo $produto[0]['pTotal'] ?></td>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot></tfoot>
</table>