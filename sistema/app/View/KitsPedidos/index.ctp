<div class="kitsPedidos index">
	<h2><?php echo __('Kits Pedidos'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('kit_id'); ?></th>
			<th><?php echo $this->Paginator->sort('pedido_id'); ?></th>
			<th><?php echo $this->Paginator->sort('placa'); ?></th>
			<th><?php echo $this->Paginator->sort('tarjeta'); ?></th>
			<th><?php echo $this->Paginator->sort('renavan'); ?></th>
			<th><?php echo $this->Paginator->sort('autorizacao'); ?></th>
			<th><?php echo $this->Paginator->sort('entregue'); ?></th>
			<th><?php echo $this->Paginator->sort('paga'); ?></th>
			<th><?php echo $this->Paginator->sort('observacao'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('usuario_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($kitsPedidos as $kitsPedido): ?>
	<tr>
		<td><?php echo h($kitsPedido['KitsPedido']['id']); ?>&nbsp;</td>
		<td><?php echo h($kitsPedido['KitsPedido']['kit_id']); ?>&nbsp;</td>
		<td><?php echo h($kitsPedido['KitsPedido']['pedido_id']); ?>&nbsp;</td>
		<td><?php echo h($kitsPedido['KitsPedido']['placa']); ?>&nbsp;</td>
		<td><?php echo h($kitsPedido['KitsPedido']['tarjeta']); ?>&nbsp;</td>
		<td><?php echo h($kitsPedido['KitsPedido']['renavan']); ?>&nbsp;</td>
		<td><?php echo h($kitsPedido['KitsPedido']['autorizacao']); ?>&nbsp;</td>
		<td><?php echo h($kitsPedido['KitsPedido']['entregue']); ?>&nbsp;</td>
		<td><?php echo h($kitsPedido['KitsPedido']['paga']); ?>&nbsp;</td>
		<td><?php echo h($kitsPedido['KitsPedido']['observacao']); ?>&nbsp;</td>
		<td><?php echo h($kitsPedido['KitsPedido']['created']); ?>&nbsp;</td>
		<td><?php echo h($kitsPedido['KitsPedido']['modified']); ?>&nbsp;</td>
		<td><?php echo h($kitsPedido['KitsPedido']['usuario_id']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $kitsPedido['KitsPedido']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $kitsPedido['KitsPedido']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $kitsPedido['KitsPedido']['id']), array(), __('Are you sure you want to delete # %s?', $kitsPedido['KitsPedido']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Kits Pedido'), array('action' => 'add')); ?></li>
	</ul>
</div>
