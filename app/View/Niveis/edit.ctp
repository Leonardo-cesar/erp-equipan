<div class="niveis form">
<?php echo $this->Form->create('Nivei', array("class"=>"form-horizontal")); ?>
    <?php echo $this->Form->input('id'); ?>
    <fieldset>
        <legend><?php echo __('Editar Nível ') . $this->request->data['Nivei']['nome']; ?></legend>
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('nome', array('label' => 'Nome', 'Placeholder' => 'EX. Coordenador', 'div' => 'col-sm-4', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('ativo', array('label' => 'Ativar', 'checked' => 'checked', 'div' => 'checkbox col-sm-4')); ?>
        </div>
        <br clear="all">
        <hr />
        <button type="submit" class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i> Editar</button>
        <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-remove"></i> ' .'Cancelar','/niveis' ,array('class' => "btn btn-danger", 'escape' => FALSE), __('Deseja realmente cancelar a edição?')); ?>
        <?php echo $this->Html->link('<i class="glyphicon glyphicon-arrow-left"></i> ' .'Voltar','/niveis' ,array('class' => "btn btn-default", 'escape' => FALSE)) ?>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>
