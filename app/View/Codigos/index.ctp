<div class="niveis index">
    <h2><?php echo __('Cadastrar Código'); ?></h2>
    <?php echo $this->Form->create('CodigoC', array("class" => "form-horizontal", 'autocomplete' => 'off')); ?>
    <div class="form-group col-sm-12">
        <?php echo $this->Form->input('codigo', array('label' => 'Código Unitário', 'type' => 'text', 'div' => 'col-sm-6', 'class' => 'form-control')); ?>
    </div>
    <div class="form-group col-sm-12">
        <?php echo $this->Form->input('codigo_I', array('label' => 'Código Inicial', 'div' => 'col-sm-6', 'class' => 'form-control')); ?>
        <?php echo $this->Form->input('codigo_F', array('label' => 'Código Final <i style="color: red;font-size:12px">"<u>Limite maximo 400 Placas.</u> Sem o código final, será adiconado 50 placas"</i>', 'div' => 'col-sm-6', 'class' => 'form-control', 'escape' => false)); ?>
    </div>
    <div class="form-group col-sm-12">
        <button type="submit" class="btn btn-primary" id="adicionarCodigo"><i class="glyphicon glyphicon-plus"></i> Adicionar</button>
    </div>
    <?php echo $this->Form->end(); ?>
    <br clear="all" />
    <p class="erro alert alert-danger" role="alert" style="display: none"></p>
    <div id="DCodigo" style="display: none;">
        <br clear="all"/>
        <hr />
        <?php echo $this->Form->create('Codigo', array("class" => "form-horizontal")); ?>
        <div class="table-responsive">
            <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover" id="tabelaCodigo">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Produto</th>
                        <th style="width: 250px">Código</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <br clear="all"/>
        <hr />
        <?php echo $this->Form->input('usuario_id', array('value' => $this->Session->read('Auth.User.id'), 'type' => 'hidden', 'label' => false, 'div' => false)); ?>
        <div class="form-group col-sm-12">
            <?php echo count($UnidadesLogadas) > 1 || $this->Session->read('Auth.User.nivel_id') == 1 ? $this->Form->input('unidade_id', array('label' => 'Selecione a Unidade', 'div' => 'col-sm-4', 'class' => 'obrigatorio form-control', 'empty' => ' - Selecione a Unidade -', 'options' => $UnidadesLogadas)) : $this->Form->input('unidade_id', array('style' => 'display:none', 'label' => false, 'div' => 'false', 'options' => $UnidadesLogadas)); ?>
        </div>
        <br clear="all"/>
        <hr />
        <div class="form-group col-sm-12">
            <a href="javascript:;" class="btn btn-success" id="cadastrarCodigo"><i class="glyphicon glyphicon-ok"></i> Confirmar</a>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>
<br clear="all" />