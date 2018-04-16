<div class="kitsPedidos form">
<?php echo $this->Form->create('KitsPedido'); ?>
	<fieldset>
		<legend><?php echo __('Add Kits Pedido'); ?></legend>
	<?php
		echo $this->Form->input('kit_id');
		echo $this->Form->input('pedido_id');
		echo $this->Form->input('placa');
		echo $this->Form->input('tarjeta');
		echo $this->Form->input('renavan');
		echo $this->Form->input('autorizacao');
		echo $this->Form->input('entregue');
		echo $this->Form->input('paga');
		echo $this->Form->input('observacao');
		echo $this->Form->input('usuario_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Kits Pedidos'), array('action' => 'index')); ?></li>
	</ul>
</div>
