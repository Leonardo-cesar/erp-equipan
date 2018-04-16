<div class="niveis form">
    <?php echo $this->Form->create('Estoque', array("class" => "form-horizontal")); ?>
    <fieldset>
        <legend>Ajustar Estoque</legend>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('unidade_id', array('label' => 'Tipo', 'div' => 'col-sm-12', 'options' => array('0' => 'Alimentar', '1' => 'Baixar'))); ?>
        </div>
        <br clear="all" />
        <hr />
        <div class="form-group col-sm-6">
            <?php echo $this->Form->input('produto_id', array('empty' => ' - Selecione - ', 'label' => 'Produtos', 'div' => 'col-sm-12', 'class' => 'selectFind form-control', 'type' => 'select')); ?>
        </div>
        <div class="form-group col-sm-6">
            <?php echo $this->Form->input('kit_id', array('empty' => ' - Selecione - ', 'label' => 'Kits', 'div' => 'col-sm-12', 'class' => 'selectFind form-control', 'type' => 'select')); ?>
        </div>
        <br clear="all" />
        <hr />
        <div class="form-group col-sm-2">
            <?php echo $this->Form->input('Quantidade', array('type' => 'text', 'label' => 'Quantidade', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('unidade_id', array('label' => 'Unidade', 'div' => 'col-sm-12', 'class' => 'obrigatorio form-control')); ?>
        </div>
        <div class="form-group col-sm-2" style="margin-top: 25px;">
            <?php echo $this->Form->input('transferencia', array('label' => 'Transferência', 'div' => 'checkbox col-sm-2')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('unidade_origen', array('label' => 'Unidade de Origen', 'div' => 'col-sm-12', 'class' => 'obrigatorio form-control', 'disabled', 'type' => 'select', 'options' => $unidades, 'empty' => '- Selecione -')); ?>
        </div>
        <br clear="all" />
        <hr />
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('observacao', array('label' => 'Observação', 'div' => 'col-sm-6', 'class' => 'form-control')); ?>
        </div>
        <br clear="all"/>
        <hr />
        <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Salvar</button>
        <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-remove"></i> ' . 'Cancelar', '/categorias', array('class' => "btn btn-danger", 'escape' => FALSE), __('Deseja realmente cancelar o cadastro?')); ?>
        <?php echo $this->Html->link('<i class="glyphicon glyphicon-arrow-left"></i> ' . 'Voltar', '/categorias', array('class' => "btn btn-default", 'escape' => FALSE)) ?>
    </fieldset>
    <?php echo $this->Form->end(); ?>
</div>