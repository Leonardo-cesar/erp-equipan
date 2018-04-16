<div class="pedidos form">
    <?php echo $this->Form->create('Lancamento', array("class" => "form-horizontal")); ?>
    <fieldset>
        <legend>Lançamento de Caixa</legend>
        <div class="cliente">
            <p class="tituloLancamento col-sm-12">Número do Lançamento</p>
            <span class="numeroLancamento col-sm-12"><?php echo $id ?></span>
            <br clear="all"/>
            <hr />
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('operacao', array('disabled', 'type' => 'select', 'empty' => ' - Selecione - ', 'options' => array('1' => 'Saída', '2' => 'Entrada', '3' => 'Transferência'), 'label' => 'Operação', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('plano_conta_id', array('disabled', 'label' => 'Plano de Contas', 'empty' => ' - Selecione - ', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('data', array('disabled', 'type' => 'text', 'div' => 'col-sm-12', 'class' => 'datepicker form-control')); ?>
            </div>
            <div class="form-group col-sm-11">
                <?php echo $this->Form->input('historico', array('disabled', 'div' => 'col-sm-12', 'class' => 'form-control', 'rows' => 4)); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('unidade_geradora', array('disabled', 'label' => 'Unidade Geradora', 'empty' => ' - Selecione - ', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('unidade_pagadora', array('disabled', 'label' => 'Unidade Pagadora', 'empty' => ' - Selecione - ', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('unidade_recebedora', array('disabled', 'label' => 'Unidade Recebedora', 'empty' => ' - Selecione - ', 'div' => 'col-sm-12', 'class' => 'form-control', 'type' => 'select')); ?>
            </div>
            <div class="form-group col-sm-3">
                <?php echo $this->Form->input('valor', array('disabled', 'label' => 'Valor', 'div' => 'col-sm-12', 'class' => 'maskMoney form-control')); ?>
            </div>
            <div class="form-group col-sm-3">
                <?php echo $this->Form->input('valor_p', array('disabled', 'label' => 'Valor Pago', 'div' => 'col-sm-12', 'class' => 'maskMoney form-control')); ?>
            </div>
            <div class="form-group col-sm-3">
                <?php echo $this->Form->input('situacao', array('disabled', 'type' => 'select', 'empty' => ' - Selecione - ', 'options' => array('1' => 'Quitado', '2' => 'Pendende'), 'label' => 'Situação', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-3">
                <?php echo $this->Form->input('tipo_pagamento_id', array('disabled', 'label' => 'Forma de Pagamento', 'empty' => ' - Selecione - ', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-12">
                <?php echo $this->Form->input('observacao', array('disabled', 'label' => 'Observação', 'div' => 'col-sm-12', 'class' => 'form-control', 'rows' => 4)); ?>
            </div>
        </div>
    </fieldset>
    <?php echo $this->Form->end(); ?>
</div>