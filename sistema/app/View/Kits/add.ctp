<div class="niveis form">
    <?php echo $this->Form->create('Kit', array("class" => "form-horizontal")); ?>
    <fieldset>
        <legend>Adicionar Kit</legend>
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('nome', array('label' => 'Nome', 'div' => 'col-sm-6', 'class' => 'form-control')); ?>
        </div>
        <br clear="all" />
        <hr />
        <div class="form-group col-sm-6">
            <?php echo $this->Form->input('produtos', array('label' => 'Produtos', 'div' => 'col-sm-12', 'class' => 'form-control', 'type' => 'select', 'options' => $produtos)); ?>
        </div>
        <div class="form-group col-sm-2">
            <a href="javascript:;" class="btn btn-success btn-xs add-kit" id="addkit"><i class="glyphicon glyphicon-plus"></i> Adicionar</a>
        </div>
        <div class="form-group col-sm-12">
            <table class="table table-bordered" id="tableKit" style="display: none;margin-left: 15px;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Produto</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <br clear="all" />
        <hr />
        <div class="form-group col-sm-12" style="margin-left: 0" id="unidade">
            <?php echo $this->Form->input('Unidade', array('label' => 'Unidade', 'multiple' => 'checkbox', 'class' => 'checkbox')); ?>
        </div>
        <br clear="all" />
        <hr />
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('observacao', array('label' => 'Observação', 'div' => 'col-sm-6', 'class' => 'form-control')); ?>
        </div>
        <br clear="all" />
        <hr />
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('ativo', array('label' => 'Ativar', 'checked' => 'checked', 'div' => 'checkbox col-sm-2')); ?>
        </div>
        <br clear="all"/>
        <hr />
        <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Salvar</button>
        <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-remove"></i> ' . 'Cancelar', '/categorias', array('class' => "btn btn-danger", 'escape' => FALSE), __('Deseja realmente cancelar o cadastro?')); ?>
        <?php echo $this->Html->link('<i class="glyphicon glyphicon-arrow-left"></i> ' . 'Voltar', '/categorias', array('class' => "btn btn-default", 'escape' => FALSE)) ?>
    </fieldset>
    <?php echo $this->Form->end(); ?>
</div>