<div class="niveis form">
    <?php echo $this->Form->create('Kit', array("class" => "form-horizontal")); ?>
    <fieldset>
        <legend>Preços</legend>
        <div class="form-group col-sm-6">
            <?php echo $this->Form->input('kit_id', array('label' => 'Produtos', 'div' => 'col-sm-12', 'class' => 'form-control', 'type' => 'select', 'options' => $produtos)); ?>
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


<div class="precos form">
    <?php echo $this->Form->create('Preco'); ?>
    <fieldset>
        <legend><?php echo __('Add Preco'); ?></legend>
        <?php
        echo $this->Form->input('valor');
        echo $this->Form->input('categoria_id');
        echo $this->Form->input('kit_id');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('List Precos'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('List Categorias'), array('controller' => 'categorias', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Categoria'), array('controller' => 'categorias', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Kits'), array('controller' => 'kits', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Kit'), array('controller' => 'kits', 'action' => 'add')); ?> </li>
    </ul>
</div>
