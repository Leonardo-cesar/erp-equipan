<?php echo $this->assign('title', 'Relatorio_de_Lançamentos_Detalhado'); ?>
<span style="text-align: center;font-weight: bold">Per&iacute;odo:: <?php echo $this->Session->read('Lancamentos.Detalhado.dataInicial') ?> &agrave; <?php echo $this->Session->read('Lancamentos.Detalhado.dataFinal') ?> </span><br />
<span style="text-align: center;font-weight: bold">Opera&ccedil;&atilde;o: <?php echo utf8_decode($lancamentos['Op']) ?></span><br />
<span style="text-align: center;font-weight: bold">Unidade: <?php echo $lancamentos['Uni'][$this->Session->read('Lancamentos.Detalhado.unidade_geradora')] ?></span><br />
<table border=1 cellspacing=0 cellpadding=2 bordercolor="666633"> 
    <thead>
        <tr>
            <th>N</th>
            <th>P/Contas</th>
            <th>Data</th>
            <th>Uni. Geradora</th>
            <th>Hist&oacute;rico</th>
            <th>For. Pagamento</th>
            <th>Valor</th>
        </tr>
    </thead>
    <tbody>
        <?php $total = 0; ?>
        <?php foreach ($lancamentos['Lan'] as $lancamento) { ?>
            <tr>
                <td><?php echo $lancamento['Lancamento']['id'] ?></td>
                <td><?php echo utf8_decode($lancamento['PlanoConta']['nome']) ?></td>
                <td><?php echo date('d/m/Y', strtotime($lancamento['Lancamento']['data'])) ?></td>
                <td><?php echo $lancamentos['Uni'][$lancamento['Lancamento']['unidade_geradora']] ?></td>
                <td><?php echo utf8_decode($lancamento['Lancamento']['historico']) ?></td>
                <td><?php echo utf8_decode($lancamento['TipoPagamento']['nome']) ?></td>
                <td>R$ <?php echo number_format($lancamento['Lancamento']['valor'], 2, ',', '.') ?></td>
            </tr>
            <?php $total = $total + $lancamento['Lancamento']['valor']; ?>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <th  colspan="7">Total de <?php echo $this->Session->read('Lancamentos.Detalhado.operacao') == 1 ? 'Despesas' : 'Receita' ?>: R$ <?php echo number_format($total, 2, ',', '.') ?></th>
        </tr>
    </tfoot>
</table>