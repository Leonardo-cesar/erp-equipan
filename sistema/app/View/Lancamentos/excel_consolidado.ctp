<?php echo $this->assign('title', 'Relatorio_de_Lançamentos_Consolidado'); ?>
<span style="text-align: center;font-weight: bold">Per&iacute;odo: <?php echo $this->Session->read('Lancamentos.Consolidado.dataInicial') ?> &agrave; <?php echo $this->Session->read('Lancamentos.Consolidado.dataFinal') ?> </span><br />
<span style="text-align: center;font-weight: bold">Opera&ccedil;&atilde;o: <?php echo utf8_decode($lancamentos['Op']) ?></span><br />
<span style="text-align: center;font-weight: bold">Unidade: <?php echo $lancamentos['Uni'][$this->Session->read('Lancamentos.Consolidado.unidade_geradora')] ?></span><br />
<table border=1 cellspacing=0 cellpadding=2 bordercolor="666633"> 
    <thead>
        <tr>
            <th>Plano de Contas</th>
            <th>Unidade</th>
            <th>Valor</th>
        </tr>
    </thead>
    <tbody>
        <?php $total = 0; ?>
        <?php foreach ($lancamentos['Lan'] as $lancamento) { ?>
            <tr>
                <td><?php echo utf8_decode($lancamento['PlanoConta']['nome']) ?></td>
                <td><?php echo $lancamentos['Uni'][$lancamento['Lancamento']['unidade_geradora']] ?></td>
                <td>R$ <?php echo $lancamento['0']['vTotal'] ?></td>
            </tr>
            <?php
            $vtotal = str_replace('.', '', $lancamento['0']['vTotal']);
            $vtotal = str_replace(',', '.', $vtotal);
            $total = $total + $vtotal;
            ?>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <th  colspan="3">Total de <?php echo $this->Session->read('Lancamentos.Consolidado.operacao') == 1 ? 'Despesas' : 'Receita' ?>: R$ <?php echo number_format($total, 2, ',', '.') ?></th>
        </tr>
    </tfoot>
</table>