<?php echo $this->assign('title', 'Relatorio_de_Produtos'); ?>
<span style="text-align: center;font-weight: bold">Per&iacute;odo: <?php echo $this->Session->read('LogEstoque.Movimento.dataInicial') ?> &agrave; <?php echo $this->Session->read('LogEstoque.Movimento.dataFinal') ?> </span><br />
<span style="text-align: center;font-weight: bold">Tipo: <?php echo $tipo ?></span><br />
<span style="text-align: center;font-weight: bold">Unidade: <?php echo $unidade ?></span><br />
<table border=1 cellspacing=0 cellpadding=2 bordercolor="666633"> 
    <thead>
        <tr>
        <tr>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Tipo</th>
            <th>Transfer&ecirc;ncia</th>
            <th>Origem/Destino</th>
        </tr>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($log as $produto) { ?>
            <tr>
                <td><?php echo utf8_decode($produto['Produto']['nome']) ?></td>
                <td><?php echo $produto['LogEstoque']['quantidade'] ?></td>
                <td><?php echo $produto['LogEstoque']['tipo'] == 1 ? 'Baixa' : 'Adi&ccedil;&atilde;o' ?></td>
                <td><?php echo $produto['LogEstoque']['transferencia'] == 1 ? 'Sim' : 'N&atilde;o' ?></td>
                <td><?php echo $produto['LogEstoque']['transferencia'] == 1 ? $produto['UnidadeOrigenDestino']['nome'] : ' -' ?></td>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot></tfoot>
</table>