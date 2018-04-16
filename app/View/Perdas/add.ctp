<div class="perdas form">
    <?php echo $this->Form->create('Perda', array("class" => "form-horizontal")); ?>
    <fieldset>
        <legend>Informar Perda</legend>
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('produto_id', array('div' => 'col-sm-6', 'class' => 'form-control')); ?>
            <?php echo $this->Form->input('quantidade', array('div' => 'col-sm-6', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group col-sm-12">
            <?php echo count($UnidadesLogadas) > 1 || $this->Session->read('Auth.User.nivel_id') == 1 ? $this->Form->input('unidade_id', array('label' => 'Unidade', 'div' => 'col-sm-4', 'class' => 'obrigatorio form-control', 'empty' => ' - Selecione a Unidade -', 'options' => $UnidadesLogadas)) : $this->Form->input('unidade_id', array('style' => 'display:none', 'label' => false, 'div' => 'false', 'options' => $UnidadesLogadas)); ?>
            <?php echo $this->Form->input('pedido_id', array('type' => 'text', 'div' => 'col-sm-4', 'class' => 'form-control')); ?>
            <?php echo $this->Form->input('usuario_id', array('div' => 'col-sm-4', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('motivo', array('label' => 'Motivo', 'div' => 'col-sm-6', 'class' => 'form-control')); ?>
        </div>
        <br clear="all"/>
        <hr />
        <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Cadastrar</button>
    </fieldset>
    <?php echo $this->Form->end(); ?>
</div>