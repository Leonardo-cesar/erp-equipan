<div class="entregas form">
<?php echo $this->Form->create('Entrega'); ?>
	<fieldset>
		<legend><?php echo __('Edit Entrega'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('observacao');
		echo $this->Form->input('unidade_id');
		echo $this->Form->input('usuario_id');
		echo $this->Form->input('pedido_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Entrega.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Entrega.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Entregas'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Unidades'), array('controller' => 'unidades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unidade'), array('controller' => 'unidades', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Usuarios'), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usuario'), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pedidos'), array('controller' => 'pedidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pedido'), array('controller' => 'pedidos', 'action' => 'add')); ?> </li>
	</ul>
</div>
