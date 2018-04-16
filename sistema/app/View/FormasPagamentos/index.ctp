<div class="formasPagamentos index">
	<h2><?php echo __('Formas Pagamentos'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('nome'); ?></th>
			<th><?php echo $this->Paginator->sort('ativo'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($formasPagamentos as $formasPagamento): ?>
	<tr>
		<td><?php echo h($formasPagamento['FormasPagamento']['id']); ?>&nbsp;</td>
		<td><?php echo h($formasPagamento['FormasPagamento']['nome']); ?>&nbsp;</td>
		<td><?php echo h($formasPagamento['FormasPagamento']['ativo']); ?>&nbsp;</td>
		<td><?php echo h($formasPagamento['FormasPagamento']['created']); ?>&nbsp;</td>
		<td><?php echo h($formasPagamento['FormasPagamento']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $formasPagamento['FormasPagamento']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $formasPagamento['FormasPagamento']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $formasPagamento['FormasPagamento']['id']), array(), __('Are you sure you want to delete # %s?', $formasPagamento['FormasPagamento']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Formas Pagamento'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Caixas'), array('controller' => 'caixas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Caixa'), array('controller' => 'caixas', 'action' => 'add')); ?> </li>
	</ul>
</div>
