<div class="kitsProdutos index">
	<h2><?php echo __('Kits Produtos'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('kit_id'); ?></th>
			<th><?php echo $this->Paginator->sort('produto_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($kitsProdutos as $kitsProduto): ?>
	<tr>
		<td><?php echo h($kitsProduto['KitsProduto']['id']); ?>&nbsp;</td>
		<td><?php echo h($kitsProduto['KitsProduto']['kit_id']); ?>&nbsp;</td>
		<td><?php echo h($kitsProduto['KitsProduto']['produto_id']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $kitsProduto['KitsProduto']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $kitsProduto['KitsProduto']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $kitsProduto['KitsProduto']['id']), array(), __('Are you sure you want to delete # %s?', $kitsProduto['KitsProduto']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Kits Produto'), array('action' => 'add')); ?></li>
	</ul>
</div>
