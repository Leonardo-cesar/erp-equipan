<h4 style="text-align: center;font-weight: bold">Período: <?php echo $this->Session->read('Lancamentos.Consolidado.dataInicial') ?> à <?php echo $this->Session->read('Lancamentos.Consolidado.dataFinal') ?> </h3>
<h4 style="text-align: center;font-weight: bold">Operação: <?php echo $lancamentos['Op'] ?></h3>
<h4 style="text-align: center;font-weight: bold">Unidade: <?php echo $lancamentos['Uni'][$this->Session->read('Lancamentos.Consolidado.unidade_geradora')] ?></h3>
<hr />
<table class="table table-bordered">
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
                <td><?php echo $lancamento['PlanoConta']['nome'] ?></td>
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
            <th  colspan="7">Total de <?php echo $this->Session->read('Lancamentos.Consolidado.operacao') == 1 ? 'Despesas' : 'Receita' ?>: R$ <?php echo number_format($total, 2, ',', '.') ?></th>
        </tr>
    </tfoot>
</table>