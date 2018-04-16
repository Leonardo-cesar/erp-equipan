<div class="pedidosexcluidos form">
<?php echo $this->Form->create('Pedidosexcluido'); ?>
	<fieldset>
		<legend><?php echo __('Add Pedidosexcluido'); ?></legend>
	<?php
		echo $this->Form->input('observacao');
		echo $this->Form->input('pedido_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Pedidosexcluidos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Pedidos'), array('controller' => 'pedidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pedido'), array('controller' => 'pedidos', 'action' => 'add')); ?> </li>
	</ul>
</div>
