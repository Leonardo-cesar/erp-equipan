<div class="niveis form">
    <fieldset>
        <legend>Adicionar Produto</legend>
        <?php echo $this->Form->create('OcProduto', array("class" => "form-horizontal form-cliente", 'id' => 'validate', 'type' => 'file')); ?>
        
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('descricao', array('label' => 'Descrição', 'div' => 'col-sm-12', 'class' => 'obrigatorio form-control')); ?>
        </div>
        <div class="form-group col-sm-6">
            <?php echo $this->Form->input('unidade', array('label' => 'Unidade', 'div' => 'col-sm-12', 'class' => 'c_email form-control')); ?>
        </div>
        <div class="form-group col-sm-6">
            <?php echo $this->Form->input('valor', array('type' => 'text', 'label' => 'valor', 'div' => 'col-sm-12', 'class' => 'maskMoney form-control')); ?>
        </div>
        <?php echo $this->Form->input('usuario_id', array('label' => false, 'div' => false, 'value' => $this->Session->read('Auth.User.id'), 'style' => 'display:none;', 'type' => 'text')); ?>
        <div class="form-group col-sm-12">
            <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Salvar</button>
        </div>
        <?php echo $this->Form->end(); ?>
    </fieldset>
</div>
