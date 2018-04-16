<div class="kitsPedidos view">
<h2><?php echo __('Kits Pedido'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($kitsPedido['KitsPedido']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kit Id'); ?></dt>
		<dd>
			<?php echo h($kitsPedido['KitsPedido']['kit_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pedido Id'); ?></dt>
		<dd>
			<?php echo h($kitsPedido['KitsPedido']['pedido_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Placa'); ?></dt>
		<dd>
			<?php echo h($kitsPedido['KitsPedido']['placa']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tarjeta'); ?></dt>
		<dd>
			<?php echo h($kitsPedido['KitsPedido']['tarjeta']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Renavan'); ?></dt>
		<dd>
			<?php echo h($kitsPedido['KitsPedido']['renavan']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Autorizacao'); ?></dt>
		<dd>
			<?php echo h($kitsPedido['KitsPedido']['autorizacao']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Entregue'); ?></dt>
		<dd>
			<?php echo h($kitsPedido['KitsPedido']['entregue']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Paga'); ?></dt>
		<dd>
			<?php echo h($kitsPedido['KitsPedido']['paga']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Observacao'); ?></dt>
		<dd>
			<?php echo h($kitsPedido['KitsPedido']['observacao']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($kitsPedido['KitsPedido']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($kitsPedido['KitsPedido']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Usuario Id'); ?></dt>
		<dd>
			<?php echo h($kitsPedido['KitsPedido']['usuario_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Kits Pedido'), array('action' => 'edit', $kitsPedido['KitsPedido']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Kits Pedido'), array('action' => 'delete', $kitsPedido['KitsPedido']['id']), array(), __('Are you sure you want to delete # %s?', $kitsPedido['KitsPedido']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Kits Pedidos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Kits Pedido'), array('action' => 'add')); ?> </li>
	</ul>
</div>
