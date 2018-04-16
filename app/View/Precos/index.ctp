<div class="niveis form">
    <?php echo $this->Form->create('Preco', array("class" => "form-horizontal")); ?>
    <fieldset>
         <h2><?php echo __('Preços'); ?></h2>
         <hr />
         <div class="alert alert-success" role="alert" style="display: none;"></div>
        <div class="form-group col-sm-6">
            <?php echo $this->Form->input('unidade_id', array('label' => 'Unidade', 'div' => 'col-sm-12', 'class' => 'form-control', 'empty' => ' -- Selecione --   ')); ?>
        </div>
        <div class="form-group col-sm-6">
            <?php echo $this->Form->input('kit_id', array('label' => 'Produtos', 'div' => 'col-sm-12', 'class' => 'form-control', 'type' => 'select', 'empty' => ' -- Selecione -- ')); ?>
        </div>
        <div style="display: none;" id="precosCategoria">
            <br clear="all"/>
            <hr />
            <?php foreach ($categorias as $key => $categoria) { ?>
                <div class="form-group col-sm-3">
                    <?php echo $this->Form->input('categorias', array('name' => 'data[Categoria][' . $key . ']', 'id' => 'categoria' . $key, 'label' => $categoria, 'div' => 'col-sm-12', 'class' => 'form-control maskMoney', 'type' => 'text')); ?>
                </div>
            <?php } ?>
            <br clear="all"/>
            <hr />
            <a href="javascript:;" class="btn btn-success" id="addPreco"><i class="glyphicon glyphicon-ok"></i> Salvar</a>
            <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-remove"></i> ' . 'Cancelar', '/categorias', array('class' => "btn btn-danger", 'escape' => FALSE), __('Deseja realmente cancelar o cadastro?')); ?>
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-arrow-left"></i> ' . 'Voltar', '/categorias', array('class' => "btn btn-default", 'escape' => FALSE)) ?>
        </div>
    </fieldset>
    <?php echo $this->Form->end(); ?>
</div>
