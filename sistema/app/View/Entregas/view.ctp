<div class="entregas view">
<h2><?php echo __('Entrega'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($entrega['Entrega']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Observacao'); ?></dt>
		<dd>
			<?php echo h($entrega['Entrega']['observacao']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($entrega['Entrega']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($entrega['Entrega']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unidade'); ?></dt>
		<dd>
			<?php echo $this->Html->link($entrega['Unidade']['nome'], array('controller' => 'unidades', 'action' => 'view', $entrega['Unidade']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Usuario'); ?></dt>
		<dd>
			<?php echo $this->Html->link($entrega['Usuario']['nome'], array('controller' => 'usuarios', 'action' => 'view', $entrega['Usuario']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pedido'); ?></dt>
		<dd>
			<?php echo $this->Html->link($entrega['Pedido']['id'], array('controller' => 'pedidos', 'action' => 'view', $entrega['Pedido']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Entrega'), array('action' => 'edit', $entrega['Entrega']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Entrega'), array('action' => 'delete', $entrega['Entrega']['id']), array(), __('Are you sure you want to delete # %s?', $entrega['Entrega']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Entregas'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Entrega'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Unidades'), array('controller' => 'unidades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unidade'), array('controller' => 'unidades', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Usuarios'), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usuario'), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pedidos'), array('controller' => 'pedidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pedido'), array('controller' => 'pedidos', 'action' => 'add')); ?> </li>
	</ul>
</div>
