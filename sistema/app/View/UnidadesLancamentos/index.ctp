<div class="unidadesLancamentos index">
	<h2><?php echo __('Unidades Lancamentos'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('nome'); ?></th>
			<th><?php echo $this->Paginator->sort('tipo'); ?></th>
			<th><?php echo $this->Paginator->sort('ativo'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($unidadesLancamentos as $unidadesLancamento): ?>
	<tr>
		<td><?php echo h($unidadesLancamento['UnidadesLancamento']['id']); ?>&nbsp;</td>
		<td><?php echo h($unidadesLancamento['UnidadesLancamento']['nome']); ?>&nbsp;</td>
		<td><?php echo h($unidadesLancamento['UnidadesLancamento']['tipo']); ?>&nbsp;</td>
		<td><?php echo h($unidadesLancamento['UnidadesLancamento']['ativo']); ?>&nbsp;</td>
		<td><?php echo h($unidadesLancamento['UnidadesLancamento']['created']); ?>&nbsp;</td>
		<td><?php echo h($unidadesLancamento['UnidadesLancamento']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $unidadesLancamento['UnidadesLancamento']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $unidadesLancamento['UnidadesLancamento']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $unidadesLancamento['UnidadesLancamento']['id']), array(), __('Are you sure you want to delete # %s?', $unidadesLancamento['UnidadesLancamento']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Unidades Lancamento'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Unidades Unidades Lancamentos'), array('controller' => 'unidades_unidades_lancamentos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unidades Unidades Lancamento'), array('controller' => 'unidades_unidades_lancamentos', 'action' => 'add')); ?> </li>
	</ul>
</div>
