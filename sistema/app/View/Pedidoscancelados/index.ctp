<div class="pedidos form">
    <fieldset>
        <legend>Cancelar Pedido</legend>
        <div id="entrega">
            <?php echo $this->Form->create('Pedidoscancelado', array("class" => "form-horizontal")); ?>
            <div class="col-sm-12" style=" text-align: center;">
                <span class="col-sm-12" style="font-size: 20px;font-weight: bold;">Você tem certeza que deseja CANCELAR o Pedido?</span>
                <span class="col-sm-12" style="font-size: 16px;font-weight: bold;color: red;"><?php echo $id ?></span>
            </div>
            <br clear="all" />
            <hr />
            <div class="form-group col-sm-12">
                <?php echo $this->Form->input('observacao', array('type' => 'textarea', 'div' => 'col-sm-6', 'label' => 'Observações', 'class' => 'form-control')); ?>
            </div>
            <div id="concluir" >
                <br clear="all" />
                <hr />
                <?php echo $this->Form->input('usuario_id', array('type' => 'hidden', 'div' => false, 'label' => false, 'value' => $this->Session->read('Auth.User.id'))); ?>
                <button type="submit" class="btn btn-danger"><i class="glyphicon glyphicon-ok"></i> Confirmar cancelamento</button>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </fieldset>
</div>