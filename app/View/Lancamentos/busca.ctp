<div class="pedidos form">
    <fieldset>
        <legend>Buscar Lançamento</legend>
        <?php echo $this->Session->flash('lancamentoB') ?>
        <?php echo $this->Form->create('Lancamento', array("class" => "form-horizontal")); ?>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('id', array('type' => 'text', 'value' => '', 'div' => 'col-sm-12', 'label' => 'Número', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('operacao', array('type' => 'select', 'empty' => ' - Selecione - ', 'options' => array('1' => 'Saída', '2' => 'Entrada', '3' => 'Transferência'), 'div' => 'col-sm-12', 'label' => 'Operação', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('plano_conta_id', array('empty' => ' - Selecione - ', 'div' => 'col-sm-12', 'label' => 'Plano de Contas', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('unidade_geradora', array('empty' => ' - Selecione - ', 'div' => 'col-sm-12', 'label' => 'Unidade', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('valor', array('type' => 'text', 'div' => 'col-sm-12', 'label' => 'Valor', 'class' => 'maskMoney form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('tipo_pagamento_id', array('empty' => ' - Selecione - ', 'div' => 'col-sm-12', 'label' => 'Forma de Pagamento', 'class' => 'form-control')); ?>
        </div>
        <br clear="all"/>
        <hr />
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('dataInicial', array('type' => 'text', 'div' => 'col-sm-12', 'label' => 'De', 'class' => 'datepicker form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('dataFinal', array('type' => 'text', 'div' => 'col-sm-12', 'label' => 'Até', 'class' => 'datepicker form-control')); ?>
        </div>
        <br clear="all"/>
        <button type="submit" class="btn btn-primary" id="buscarLancamento"><i class="glyphicon glyphicon-search"></i> Buscar Lançamento</button>
        <br clear="all"/>
        <?php echo $this->Form->end(); ?>
        <div class="divD form-group col-sm-12" style="display: none">
            <br clear="all"/>
            <hr />
            <br clear="all"/>
            <table class='TableJquery' id="tableLancamento">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Operação</th>
                        <th>P/Contas</th>
                        <th>Data</th>
                        <th>Uni. Geradora</th>
                        <th>For. Pagamento</th>
                        <th>Histórico</th>
                        <th>Valor</th>
                        <th>OP</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Operação</th>
                        <th>P/Contas</th>
                        <th>Data</th>
                        <th>Uni. Geradora</th>
                        <th>For. Pagamento</th>
                        <th>Histórico</th>
                        <th>Valor</th>
                        <th>OP</th>
                    </tr>
                    <tr>
                        <th colspan="9" class="ts-pager form-horizontal">
                            <button type="button" class="btn first"><i class="icon-step-backward glyphicon glyphicon-step-backward"></i></button>
                            <button type="button" class="btn prev"><i class="icon-arrow-left glyphicon glyphicon-backward"></i></button>
                            <span class="pagedisplay"></span> <!-- this can be any element, including an input -->
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
                </tfoot>
                <tbody>
                </tbody>
            </table>
        </div>
    </fieldset>
</div>