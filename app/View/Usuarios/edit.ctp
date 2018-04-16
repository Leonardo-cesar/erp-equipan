<div class="niveis form">
    <?php echo $this->Form->create('Usuario', array("class" => "form-horizontal")); ?>
    <?php echo $this->Form->input('id'); ?>
    <fieldset>
        <legend>Nível</legend>
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('nivel_id', array('label' => 'Nível', 'div' => 'col-sm-4', 'class' => 'form-control', 'options' => $niveis, 'empty' => ' - Selecione o Nível -')); ?>
        </div>
        <div class="form-group col-sm-12" style="margin-left: 0;display: <?php echo $this->request->data['Nivei']['id'] == 1 || $this->request->data['Nivei']['id'] == 2 ? 'none' : '' ?>" id="setor">
            <?php echo $this->Form->input('Setore', array('label' => 'Setores', 'multiple' => 'checkbox', 'class' => 'checkbox')); ?>
        </div>
        <div class="form-group col-sm-12" style="margin-left: 0;display: <?php echo $this->request->data['Nivei']['id'] == 1 ? 'none' : '' ?>" id="unidade">
            <?php echo $this->Form->input('Unidade', array('label' => 'Unidade', 'multiple' => 'checkbox', 'class' => 'checkbox')); ?>
        </div>
        <legend>Dados</legend>
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('nome', array('label' => 'Nome', 'div' => 'col-sm-4', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('email', array('label' => 'Email', 'div' => 'col-sm-4', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('data_aniversario', array('type' => 'text', 'label' => 'Data de Aniversário', 'div' => 'col-sm-2', 'class' => 'form-control')); ?>
        </div>
        <hr/>
        <legend>Acesso</legend>
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('usuario', array('label' => 'Usuário', 'div' => 'col-sm-4', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('senha', array('label' => 'Senha', 'div' => 'col-sm-4', 'class' => 'form-control', 'type' => 'password', 'value' => '')); ?>
        </div>
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('c_senha', array('label' => 'Confirma Senha', 'div' => 'col-sm-4', 'class' => 'form-control', 'type' => 'password')); ?>
        </div>
        <hr />
        <legend>Ativo</legend>
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('ativo', array('label' => 'Ativar', 'checked' => 'checked', 'div' => 'checkbox col-sm-2')); ?>
        </div>
        <br clear="all"/>
        <hr />
        <button type="submit" class="btn btn-warning"><i class="glyphicon glyphicon-ok"></i> Editar</button>
        <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-remove"></i> ' . 'Cancelar', '/unidades', array('class' => "btn btn-danger", 'escape' => FALSE), __('Deseja realmente cancelar o cadastro?')); ?>
        <?php echo $this->Html->link('<i class="glyphicon glyphicon-arrow-left"></i> ' . 'Voltar', '/unidades', array('class' => "btn btn-default", 'escape' => FALSE)) ?>
    </fieldset>
    <?php echo $this->Form->end(); ?>
</div>
