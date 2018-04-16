<h4 style="text-align: center;font-weight: bold">Período: <?php echo $this->Session->read('Lancamentos.Detalhado.dataInicial') ?> à <?php echo $this->Session->read('Lancamentos.Detalhado.dataFinal') ?> </h4>
<h4 style="text-align: center;font-weight: bold">Operação: <?php echo $lancamentos['Op'] ?></h4>
<h4 style="text-align: center;font-weight: bold">Unidade: <?php echo $lancamentos['Uni'][$this->Session->read('Lancamentos.Detalhado.unidade_geradora')] ?></h4>
<hr />
<table class="table table-bordered" >
    <thead>
        <tr>
            <th>N°</th>
            <th>P/Contas</th>
            <th>Data</th>
            <th>Uni. Geradora</th>
            <th>Histórico</th>
            <th>For. Pagamento</th>
            <th>Valor</th>
        </tr>
    </thead>
    <tbody>
        <?php $total = 0; ?>
        <?php foreach ($lancamentos['Lan'] as $lancamento) { ?>
            <tr>
                <td><?php echo $lancamento['Lancamento']['id'] ?></td>
                <td><?php echo $lancamento['PlanoConta']['nome'] ?></td>
                <td><?php echo date('d/m/Y', strtotime($lancamento['Lancamento']['data'])) ?></td>
                <td><?php echo $lancamentos['Uni'][$lancamento['Lancamento']['unidade_geradora']] ?></td>
                <td><?php echo $lancamento['Lancamento']['historico'] ?></td>
                <td><?php echo $lancamento['TipoPagamento']['nome'] ?></td>
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