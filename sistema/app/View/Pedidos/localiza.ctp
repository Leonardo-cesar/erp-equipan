<div class="pedidos form">
    <?php echo $this->Form->create('Pedido', array("class" => "form-horizontal", 'action' => 'confirmarLocaliza')); ?>
    <?php echo $this->Session->flash('pedido') ?> 
    <fieldset>
        <legend>Gerar Pedido</legend>
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('cliente', array('type' => 'select', 'label' => 'Selecione o Cliente', 'div' => 'col-sm-5', 'id' => 'clienteLocaliza', 'empty' => ' - Selecione - ', 'class' => 'form-control', 'options' => $clientes)); ?>
            <?php echo $this->Form->input('unidade_id', array('label' => false, 'div' => false, 'type' => 'hidden', 'value' => '10')); ?>
        </div>
        <div class="cliente" style="display: none;">
            <br clear="all"/>
            <hr />
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('cliente_id', array('readonly', 'type' => 'text', 'label' => 'Número', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('nome', array('readonly', 'type' => 'text', 'label' => 'Nome', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <?php echo $this->Form->input('categoria_id', array('disabled', 'type' => 'hidden', 'label' => false, 'div' => false)); ?>
            <br clear="all"/>
            <hr />
            <div class="form-group col-sm-6">
                <?php echo $this->Form->input('kit', array('label' => 'Kits', 'div' => 'col-sm-12', 'class' => 'form-control', 'type' => 'select', 'options' => $kits, 'empty' => '-- Selecione o KIT --')); ?>
            </div>
            <div class="form-group col-sm-3">
                <?php echo $this->Form->input('tarjeta', array('type' => 'text', 'label' => 'Tarjeta', 'div' => 'col-sm-12', 'class' => 'form-control', 'style' => 'text-transform:uppercase')); ?>
            </div>
            <div class="form-group col-sm-3">
                <?php echo $this->Form->input('valor', array('type' => 'text', 'label' => 'Valor', 'div' => 'col-sm-12', 'class' => 'maskMoney form-control')); ?>
            </div>
            <div class="form-group col-sm-12">
                <?php echo $this->Form->input('renavam', array('type' => 'textarea', 'label' => 'Renavam', 'div' => 'col-sm-12', 'class' => 'form-control', 'style' => 'text-transform:uppercase')); ?>
            </div>
            <div class="form-group col-sm-12">
                <?php echo $this->Form->input('placas', array('type' => 'textarea', 'label' => 'Placas', 'div' => 'col-sm-12', 'class' => 'form-control', 'style' => 'text-transform:uppercase')); ?>
            </div>
            <div class="form-group col-sm-12">
                <span style="margin-left: 15px;font-size: 16px;font-weight: bold;">Total de Placas: <i style="color: red"><?php echo $this->Form->input('qtdTotal', array('readonly', 'type' => 'text', 'id' => 'qtdPlaca', 'div' => false, 'value' => '0', 'label' => false, 'style' => 'border: none;color: red;')); ?><br /></i></span>
                <span style="margin-left: 15px;font-size: 16px;font-weight: bold;">Valor Total:  <i style="color: red">R$ <?php echo $this->Form->input('Vtotal', array('readonly', 'type' => 'text', 'id' => 'vtPlaca', 'div' => false, 'value' => '00,00', 'label' => false, 'style' => 'border: none;color: red;')); ?></i></span>
            </div>
            <div class="form-group col-sm-12">
                <a href="javascript:;" style="margin-left: 15px;" class="btn btn-warning" id="replace"><i class="glyphicon glyphicon-refresh"></i> Replace</a>
            </div>
            <br clear="all"/>   
            <hr />
            <div class="form-group col-sm-3">
                <?php echo $this->Form->input('created', array('type' => 'text', 'value' => date("d/m/Y"), 'label' => 'Data', 'div' => 'col-sm-12', 'class' => 'datepicker form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <label>Tipo de Pedido</label>
                <p style="color: red;font-weight: bold;font-size: 18px;background: #ffc9c9;margin: 0;padding: 5px;">A Prazo</p>
                <?php echo $this->Form->input('tipo', array('type' => 'hidden', 'value' => 1)); ?>
            </div>
            <br clear="all" />
            <hr />
            <div class="form-group col-sm-6">
                <?php echo $this->Form->input('observacao', array('type' => 'textarea', 'label' => 'Observação', 'rows' => '8', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <br clear="all" />
            <hr />
            <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-shopping-cart"></i> Gerar Pedido</button>
        </div>
    </fieldset>
    <?php echo $this->Form->end(); ?>
</div>