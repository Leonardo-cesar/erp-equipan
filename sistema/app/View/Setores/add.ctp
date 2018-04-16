<div class="niveis form">
<?php echo $this->Form->create('Setore', array("class"=>"form-horizontal")); ?>
    <fieldset>
        <legend><?php echo __('Adcionar Setor'); ?></legend>
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('nome', array('label' => 'Nome', 'Placeholder' => 'EX. Vendas', 'div' => 'col-sm-4', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('ativo', array('label' => 'Ativar', 'checked' => 'checked', 'div' => 'checkbox col-sm-4')); ?>
        </div>
        <br clear="all">
        <hr />
        <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Salvar</button>
        <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-remove"></i> ' .'Cancelar','/setores' ,array('class' => "btn btn-danger", 'escape' => FALSE), __('Deseja realmente cancelar o cadastro?')); ?>
        <?php echo $this->Html->link('<i class="glyphicon glyphicon-arrow-left"></i> ' .'Voltar','/setores' ,array('class' => "btn btn-default", 'escape' => FALSE)) ?>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>