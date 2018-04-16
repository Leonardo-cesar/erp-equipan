<div class="niveis form">
    <fieldset>
        <?php echo $this->Form->create('Fornecedore', array("class" => "form-horizontal")); ?>
        <legend>Adicionar Fornecedor</legend>
        <div class="form-group col-sm-6">
            <?php echo $this->Form->input('nome', array('label' => 'Nome', 'div' => 'col-sm-12', 'class' => 'obrigatorio form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('contato', array('type' => 'text', 'label' => 'Contato', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('email', array('label' => 'Email', 'div' => 'col-sm-12', 'class' => 'c_email form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('telefone', array('type' => 'text', 'label' => 'Telefone', 'div' => 'col-sm-12', 'class' => 'obrigatorio form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('cidade', array('type' => 'text', 'label' => 'Cidade', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
        </div>
         <div class="form-group col-sm-4">
            <?php echo $this->Form->input('qualificacao', array('type' => 'select', 'label' => 'Qualificação', 'div' => 'col-sm-12', 'class' => 'form-control', 'empty' => ' -- Selecione -- ', 'options' => array('1' => 'Hitórico de Fornecimento', '2'=>'Exclusivo no Mercado', '5' => 'Visita Técnica ou Amostra', '4' => 'Indicação por empresas idoneas/parceiras', '5' => 'Possue Pelo menos 3 indicações de clientes', '6' => 'Se o fornecedor possui ISO 9001, ISO 14001 ou outro'))); ?>
        </div>
         <div class="form-group col-sm-4">
            <?php echo $this->Form->input('insumo', array('type' => 'text', 'label' => 'Insumo', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
        </div>
        <br clear="all"/>
        <hr />
        <?php echo $this->Form->input('usuario_id', array('label' => false, 'div' => false, 'value' => $this->Session->read('Auth.User.id'), 'style' => 'display:none;', 'type' => 'text')); ?>
        <?php echo $this->Form->input('ativo', array('type' => 'hidden', 'value' => 1)); ?>
        <div class="form-group col-sm-12">
            <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Salvar</button>
        </div>
        <?php echo $this->Form->end(); ?>

    </fieldset>
</div>
