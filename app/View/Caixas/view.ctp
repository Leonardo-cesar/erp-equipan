<div class="caixas view">
<h2><?php echo __('Caixa'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($caixa['Caixa']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($caixa['Caixa']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($caixa['Caixa']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pedido'); ?></dt>
		<dd>
			<?php echo $this->Html->link($caixa['Pedido']['id'], array('controller' => 'pedidos', 'action' => 'view', $caixa['Pedido']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Formas Pagamento'); ?></dt>
		<dd>
			<?php echo $this->Html->link($caixa['FormasPagamento']['nome'], array('controller' => 'formas_pagamentos', 'action' => 'view', $caixa['FormasPagamento']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Usuario'); ?></dt>
		<dd>
			<?php echo $this->Html->link($caixa['Usuario']['nome'], array('controller' => 'usuarios', 'action' => 'view', $caixa['Usuario']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Caixa'), array('action' => 'edit', $caixa['Caixa']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Caixa'), array('action' => 'delete', $caixa['Caixa']['id']), array(), __('Are you sure you want to delete # %s?', $caixa['Caixa']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Caixas'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Caixa'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pedidos'), array('controller' => 'pedidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pedido'), array('controller' => 'pedidos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Formas Pagamentos'), array('controller' => 'formas_pagamentos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Formas Pagamento'), array('controller' => 'formas_pagamentos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Usuarios'), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usuario'), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
	</ul>
</div>
