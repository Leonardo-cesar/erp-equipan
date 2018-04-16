<div class="niveis form">
    <fieldset>
        <legend>Adicionar Cliente</legend>
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('tipo', array('label' => 'Tipo', 'div' => 'col-sm-4', 'class' => 'obrigatorio form-control', 'options' => array(0 => 'Cliente', 1 => 'Representante'))); ?>
        </div>
        <br clear="all"/>
        <hr />
        <?php echo $this->Form->create('Cliente', array("class" => "form-horizontal form-cliente", 'id' => 'validate', 'type' => 'file')); ?>
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('categoria_id', array('label' => 'Categoria', 'div' => 'col-sm-4', 'class' => 'obrigatorio form-control', 'empty' => ' - Selecione a Categoria -')); ?>
            <?php echo count($UnidadesLogadas) > 1 || $this->Session->read('Auth.User.nivel_id') == 1 ? $this->Form->input('unidade_id', array('label' => 'Unidade', 'div' => 'col-sm-4', 'class' => 'obrigatorio form-control', 'empty' => ' - Selecione a Unidade -', 'options' => $UnidadesLogadas)) : $this->Form->input('unidade_id', array('style' => 'display:none', 'label' => false, 'div' => 'false', 'options' => $UnidadesLogadas)); ?>
        </div>
        <br clear="all"/>
        <hr />
        <div class="form-group col-sm-6">
            <?php echo $this->Form->input('nome', array('label' => 'Nome', 'div' => 'col-sm-12', 'class' => 'obrigatorio form-control')); ?>
        </div>
        <div class="form-group col-sm-6">
            <?php echo $this->Form->input('email', array('label' => 'Email', 'div' => 'col-sm-12', 'class' => 'c_email form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('telefone', array('type' => 'text', 'label' => 'Telefone', 'div' => 'col-sm-12', 'class' => 'obrigatorio form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('telefone2', array('type' => 'text', 'label' => 'Telefone 2', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('celular', array('type' => 'text', 'label' => 'Celular', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
        </div>
        <br clear="all"/>
        <hr />
        <div class="form-group col-sm-4" style="margin-left: 4px;">
            <?php echo $this->Form->radio('tipo', array('F' => 'Pessoa Física', 'J' => 'Pessoa Jurídica'), array('value' => 'F')); ?>
        </div>
        <div class="pj" style="display: none;">
            <br clear="all"/>
            <hr />
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('cnpj', array('label' => 'CNPJ', 'div' => 'col-sm-12', 'class' => 'cnpj form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('i_estadual', array('type' => 'text', 'label' => 'Inscrição Estadual', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('cpf_responsavel', array('type' => 'text', 'label' => 'CPF Responsavel', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-6">
                <?php echo $this->Form->input('responsavel', array('label' => 'Responsavel', 'div' => 'col-sm-12', 'class' => 'obrigatorio form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('site', array('label' => 'Site', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
        </div>
        <div class="pf">
            <br clear="all"/>
            <hr />
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('cpf', array('label' => 'CPF', 'div' => 'col-sm-12', 'class' => 'cpf form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('rg', array('type' => 'text', 'label' => 'RG', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('data_nascimento', array('type' => 'text', 'label' => 'Data de Nascimento', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
        </div>
        <br clear="all"/>
        <hr />
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('endereco', array('type' => 'text', 'label' => 'Endereço', 'div' => 'col-sm-8', 'class' => 'obrigatorio form-control')); ?>
        </div>
        <div class="form-group col-sm-3">
            <?php echo $this->Form->input('numero', array('type' => 'text', 'label' => 'Número', 'div' => 'col-sm-12', 'class' => 'obrigatorio form-control')); ?>
        </div>
        <div class="form-group col-sm-9">
            <?php echo $this->Form->input('complemento', array('type' => 'text', 'label' => 'Complemento', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('bairro', array('label' => 'Bairro', 'div' => 'col-sm-12', 'class' => 'obrigatorio form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('cidade', array('label' => 'Cidade', 'div' => 'col-sm-12', 'class' => 'obrigatorio form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('estado', array('label' => 'Estado', 'div' => 'col-sm-12', 'class' => 'obrigatorio form-control')); ?>
        </div>
        <br clear="all"/>
        <hr />
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('prazo', array('disabled', 'label' => 'Liberar compra  por crédito', 'checked' => 'checked', 'div' => 'checkbox col-sm-4')); ?>
        </div>
        <div class="form-group col-sm-12">
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-asterisk"></i> ' . 'Informar senha para liberação', 'javascritp:;', array('style' => 'margin-left: 15px;', 'class' => 'alert alert-info', 'id' => 'liberar', 'data-toggle' => "modal", 'data-target' => ".bs-example-modal-sm", 'escape' => FALSE)) ?>
            <div class="alert alert-success col-sm-3" role="alert" id="liberado" style="margin-left: 15px;display:none;margin-bottom: 0;"></div>
        </div>
        <br clear="all"/>
        <hr />
        <div class="form-group col-sm-4">
            <?php echo $this->Form->file('arquivo1'); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->file('arquivo2'); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->file('arquivo3'); ?>
        </div>
        <br clear="all"/>
        <hr />
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('ativo', array('label' => 'Ativar', 'checked' => 'checked', 'div' => 'checkbox col-sm-2')); ?>
        </div>
        <br clear="all"/>
        <hr />
        <?php echo $this->Form->input('usuario_id', array('label' => false, 'div' => false, 'value' => $this->Session->read('Auth.User.id'), 'style' => 'display:none;', 'type' => 'text')); ?>
        <div class="form-group col-sm-12">
            <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Salvar</button>
            <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-remove"></i> ' . 'Cancelar', '/unidades', array('class' => "btn btn-danger", 'escape' => FALSE), __('Deseja realmente cancelar o cadastro?')); ?>
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-arrow-left"></i> ' . 'Voltar', '/unidades', array('class' => "btn btn-default", 'escape' => FALSE)) ?>
        </div>
        <?php echo $this->Form->end(); ?>

        <?php echo $this->Form->create('Cliente', array("class" => "form-horizontal form-representante", 'id' => 'validate', 'type' => 'file', 'style' => 'display: none;')); ?>
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('cliente', array('type' => 'text', 'label' => 'Cliente Responsável', 'div' => 'col-sm-4', 'class' => 'bCliente form-control', 'empty' => ' - Selecione o Cliente -')); ?>
            <?php echo $this->Form->input('cliente_id', array('type' => 'hidden')); ?>
            <?php echo count($UnidadesLogadas) > 1 || $this->Session->read('Auth.User.nivel_id') == 1 ? $this->Form->input('unidade_id', array('label' => 'Unidade', 'div' => 'col-sm-4', 'class' => 'obrigatorio form-control', 'empty' => ' - Selecione a Unidade -', 'options' => $UnidadesLogadas)) : $this->Form->input('unidade_id', array('style' => 'display:none', 'label' => false, 'div' => 'false', 'options' => $UnidadesLogadas)); ?>
        </div>
        <br clear="all"/>
        <hr />
        <div class="form-group col-sm-6">
            <?php echo $this->Form->input('nome', array('label' => 'Nome', 'div' => 'col-sm-12', 'class' => 'obrigatorio form-control')); ?>
        </div>
        <div class="form-group col-sm-6">
            <?php echo $this->Form->input('email', array('label' => 'Email', 'div' => 'col-sm-12', 'class' => 'c_email form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('telefone', array('type' => 'text', 'label' => 'Telefone', 'div' => 'col-sm-12', 'class' => 'obrigatorio tel form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('telefone2', array('type' => 'text', 'label' => 'Telefone 2', 'div' => 'col-sm-12', 'class' => 'tel form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('celular', array('type' => 'text', 'label' => 'Celular', 'div' => 'col-sm-12', 'class' => 'tel form-control')); ?>
        </div>
        <br clear="all"/>
        <hr />
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('cnpj', array('label' => 'CNPJ', 'div' => 'col-sm-4', 'class' => 'cnpj form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('cpf', array('label' => 'CPF', 'div' => 'col-sm-12', 'class' => 'cpf form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('rg', array('type' => 'text', 'label' => 'RG', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('data_nascimento', array('type' => 'text', 'label' => 'Data de Nascimento', 'div' => 'col-sm-12', 'class' => 'dataNascimento form-control')); ?>
        </div>
        <br clear="all"/>
        <hr />
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('endereco', array('type' => 'text', 'label' => 'Endereço', 'div' => 'col-sm-8', 'class' => 'obrigatorio form-control')); ?>
        </div>
        <div class="form-group col-sm-3">
            <?php echo $this->Form->input('numero', array('type' => 'text', 'label' => 'Número', 'div' => 'col-sm-12', 'class' => 'obrigatorio form-control')); ?>
        </div>
        <div class="form-group col-sm-9">
            <?php echo $this->Form->input('complemento', array('type' => 'text', 'label' => 'Complemento', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('bairro', array('label' => 'Bairro', 'div' => 'col-sm-12', 'class' => 'obrigatorio form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('cidade', array('label' => 'Cidade', 'div' => 'col-sm-12', 'class' => 'obrigatorio form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('estado', array('label' => 'Estado', 'div' => 'col-sm-12', 'class' => 'obrigatorio form-control')); ?>
        </div>
        <br clear="all"/>
        <hr />
        <div class="form-group col-sm-4">
            <?php echo $this->Form->file('arquivo1'); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->file('arquivo2'); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->file('arquivo3'); ?>
        </div>
        <br clear="all"/>
        <hr />
        <?php echo $this->Form->input('usuario_id', array('label' => false, 'div' => false, 'value' => $this->Session->read('Auth.User.id'), 'style' => 'display:none;', 'type' => 'text')); ?>
        <div class="form-group col-sm-12">
            <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Salvar</button>
            <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-remove"></i> ' . 'Cancelar', '/unidades', array('class' => "btn btn-danger", 'escape' => FALSE), __('Deseja realmente cancelar o cadastro?')); ?>
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-arrow-left"></i> ' . 'Voltar', '/unidades', array('class' => "btn btn-default", 'escape' => FALSE)) ?>
        </div>
        <?php echo $this->Form->end(); ?>
    </fieldset>
</div>

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Autorização</h4>
            </div>
            <div class="modal-body">
                <?php echo $this->Form->create('Liberar'); ?>
                <?php echo $this->Form->input('usuario', array('label' => 'Usuário', 'type' => 'text', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
                <br clear="all" />
                <?php echo $this->Form->input('senha', array('label' => 'Senha', 'div' => 'col-sm-12', 'class' => 'form-control', 'type' => 'password')); ?>
                <?php echo $this->Form->end(); ?>
                <br clear="all" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="liberarPrazo">Liberar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>