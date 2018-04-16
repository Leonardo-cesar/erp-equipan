<div class="pedidosexcluidos view">
<h2><?php echo __('Pedidosexcluido'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($pedidosexcluido['Pedidosexcluido']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Observacao'); ?></dt>
		<dd>
			<?php echo h($pedidosexcluido['Pedidosexcluido']['observacao']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($pedidosexcluido['Pedidosexcluido']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($pedidosexcluido['Pedidosexcluido']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pedido'); ?></dt>
		<dd>
			<?php echo $this->Html->link($pedidosexcluido['Pedido']['id'], array('controller' => 'pedidos', 'action' => 'view', $pedidosexcluido['Pedido']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Pedidosexcluido'), array('action' => 'edit', $pedidosexcluido['Pedidosexcluido']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Pedidosexcluido'), array('action' => 'delete', $pedidosexcluido['Pedidosexcluido']['id']), array(), __('Are you sure you want to delete # %s?', $pedidosexcluido['Pedidosexcluido']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Pedidosexcluidos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pedidosexcluido'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pedidos'), array('controller' => 'pedidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pedido'), array('controller' => 'pedidos', 'action' => 'add')); ?> </li>
	</ul>
</div>
