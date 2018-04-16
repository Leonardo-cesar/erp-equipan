<?php echo $this->assign('title', 'Relatorio_de_Produtos'); ?>
<span style="text-align: center;font-weight: bold">Per&iacute;odo: <?php echo $this->Session->read('LogEstoque.Produtos.dataInicial') ?> &agrave; <?php echo $this->Session->read('LogEstoque.Produtos.dataFinal') ?> </span><br />
<span style="text-align: center;font-weight: bold">Unidade: <?php echo $unidade['Unidade']['nome'] ?></span>
<table border=1 cellspacing=0 cellpadding=2 bordercolor="666633"> 
    <thead>
        <tr>
        <tr>
            <th>N</th>
            <th>Produto</th>
            <th>Quantidade</th>
        </tr>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($log as $produto) { ?>
            <tr>
                <td><?php echo $produto['Produto']['id'] ?></td>
                <td><?php echo utf8_decode($produto['Produto']['nome']) ?></td>
                <td><?php echo $produto[0]['pTotal'] ?></td>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot></tfoot>
</table>