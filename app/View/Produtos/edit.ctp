<div class="niveis form">
    <?php echo $this->Form->create('Produto', array("class" => "form-horizontal")); ?>
    <?php echo $this->Form->input('id'); ?>
    <fieldset>
        <legend>Editar Categoria</legend>
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('nome', array('label' => 'Nome', 'div' => 'col-sm-4', 'class' => 'form-control')); ?>
            <?php echo $this->Form->input('codigo', array('label' => 'Código', 'div' => 'col-sm-4', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('observacao', array('label' => 'Observação', 'div' => 'col-sm-4', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('ativo', array('label' => 'Ativar', 'div' => 'checkbox col-sm-2')); ?>
        </div>
        <br clear="all"/>
        <hr />
        <button type="submit" class="btn btn-warning"><i class="glyphicon glyphicon-ok"></i> Editar</button>
        <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-remove"></i> ' . 'Cancelar', '/produtos', array('class' => "btn btn-danger", 'escape' => FALSE), __('Deseja realmente cancelar o cadastro?')); ?>
        <?php echo $this->Html->link('<i class="glyphicon glyphicon-arrow-left"></i> ' . 'Voltar', '/produtos', array('class' => "btn btn-default", 'escape' => FALSE)) ?>
    </fieldset>
    <?php echo $this->Form->end(); ?>
</div>