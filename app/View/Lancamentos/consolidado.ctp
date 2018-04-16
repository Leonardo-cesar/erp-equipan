<div class="pedidos form">
    <fieldset>
        <legend>Relatorio de Lançamentos Consolidado</legend>
        <?php echo $this->Form->create('Lancamento', array("class" => "form-horizontal")); ?>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('unidade_geradora', array('empty' => ' - Selecione - ', 'div' => 'col-sm-12', 'label' => 'Unidade', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('operacao', array('type' => 'select', 'empty' => ' - Selecione - ', 'options' => array('1' => 'Saída', '2' => 'Entrada', '3' => 'Transferência'), 'div' => 'col-sm-12', 'label' => 'Operação', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('plano_conta_id', array('empty' => ' - Selecione - ', 'div' => 'col-sm-12', 'label' => 'Plano de Contas', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('dataInicial', array('type' => 'text', 'div' => 'col-sm-12', 'label' => 'De', 'class' => 'datepicker form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('dataFinal', array('type' => 'text', 'div' => 'col-sm-12', 'label' => 'Até', 'class' => 'datepicker form-control')); ?>
        </div>
        <br clear="all"/>
        <button type="submit" class="btn btn-success" id="gerarConsolidado"><i class="glyphicon glyphicon-refresh"></i> Gerar</button>
        <br clear="all"/>
        <?php echo $this->Form->end(); ?>
        <div class="divCO form-group col-sm-12" style="display: none">
            <br clear="all"/>
            <hr />
            <br clear="all"/>
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-print"></i> Imprimir', '/lancamentos/cimprimir/', array('escape' => false, 'class' => 'btn btn-primary', 'target' => '_blank')) ?>
            <?php echo $this->Html->link('<i class="glyphicon glyphicon glyphicon-download-alt"></i> Excel', '/lancamentos/excelConsolidado/', array('escape' => false, 'class' => 'btn btn-info', 'target' => '_blank')) ?>
            <br />
            <br />
            <table class='TableJquery' id="tableLancamentoConsolidado">
                <thead>
                    <tr>
                        <th>Plano de Contas</th>
                        <th>Unidade</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Plano de Contas</th>
                        <th>Unidade</th>
                        <th>Valor</th>
                    </tr>
                    <tr>
                        <th colspan="3" class="ts-pager form-horizontal">
                            <button type="button" class="btn first"><i class="icon-step-backward glyphicon glyphicon-step-backward"></i></button>
                            <button type="button" class="btn prev"><i class="icon-arrow-left glyphicon glyphicon-backward"></i></button>
                            <span class="pagedisplay"></span>
                            <button type="button" class="btn next"><i class="icon-arrow-right glyphicon glyphicon-forward"></i></button>
                            <button type="button" class="btn last"><i class="icon-step-forward glyphicon glyphicon-step-forward"></i></button>
                            <select class="pagesize input-mini" title="Select page size">
                                <option selected="selected" value="50">50</option>
                                <option value="100">100</option>
                                <option value="150">150</option>
                                <option value="200">200</option>
                            </select>
                            <select class="pagenum input-mini" title="Select page number"></select>
                        </th>
                    </tr>
                    <tr class="dispesas" style="display: none"><th colspan="3"><div class="alert alert-danger" style="text-align: center;" role="alert"></div></th></tr>
                    <tr class="receitas" style="display: none"><th colspan="3"><div class="alert alert-success" style="text-align: center;" role="alert"></div></th></tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>
        </div>
    </fieldset>
</div>