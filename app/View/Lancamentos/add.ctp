<div class="pedidos form">
    <?php echo $this->Form->create('Lancamento', array("class" => "form-horizontal")); ?>
    <fieldset>
        <legend>Lançamento de Caixa</legend>
        <div class="cliente">
            <p class="tituloLancamento col-sm-12">Número do Lançamento</p>
            <span class="numeroLancamento col-sm-12"><?php echo $id['Lancamento']['id']+1 ?></span>
            <br clear="all"/>
            <hr />
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('operacao', array('type' => 'select', 'empty' => ' - Selecione - ', 'options' => array('1' => 'Saída', '2' => 'Entrada', '3' => 'Transferência'), 'label' => 'Operação', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('plano_conta_id', array('label' => 'Plano de Contas', 'empty' => ' - Selecione - ', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('data', array('type' => 'text', 'div' => 'col-sm-12', 'class' => 'datepicker form-control')); ?>
            </div>
            <div class="form-group col-sm-11">
                <?php echo $this->Form->input('historico', array('div' => 'col-sm-12', 'class' => 'form-control', 'rows' => 4)); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('unidade_geradora', array('label' => 'Unidade Geradora', 'empty' => ' - Selecione - ', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('unidade_pagadora', array('label' => 'Unidade Pagadora', 'empty' => ' - Selecione - ', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('unidade_recebedora', array('label' => 'Unidade Recebedora', 'empty' => ' - Selecione - ', 'div' => 'col-sm-12', 'class' => 'form-control', 'type' => 'select')); ?>
            </div>
            <div class="form-group col-sm-3">
                <?php echo $this->Form->input('valor', array('label' => 'Valor', 'div' => 'col-sm-12', 'class' => 'maskMoney form-control')); ?>
            </div>
            <div class="form-group col-sm-3">
                <?php echo $this->Form->input('valor_p', array('label' => 'Valor Pago', 'div' => 'col-sm-12', 'class' => 'maskMoney form-control')); ?>
            </div>
            <div class="form-group col-sm-3">
                <?php echo $this->Form->input('situacao', array('type' => 'select', 'empty' => ' - Selecione - ', 'options' => array('1' => 'Quitado', '2' => 'Pendende'), 'label' => 'Situação', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-3">
                <?php echo $this->Form->input('tipo_pagamento_id', array('label' => 'Forma de Pagamento', 'empty' => ' - Selecione - ', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-12">
                <?php echo $this->Form->input('observacao', array('label' => 'Observação', 'div' => 'col-sm-12', 'class' => 'form-control', 'rows' => 4)); ?>
            </div>
            <br clear="all" />
            <hr />
            <?php echo $this->Form->input('usuario_id', array('type' => 'hidden', 'label' => false, 'div' => false, 'value' => $this->Session->read('Auth.User.id'))); ?>
            <?php echo $this->Form->input('ativo', array('type' => 'hidden', 'label' => false, 'div' => false, 'value' => 1)); ?>
            <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Cadastrar Lançamento</button>
        </div>
    </fieldset>
    <?php echo $this->Form->end(); ?>
</div>