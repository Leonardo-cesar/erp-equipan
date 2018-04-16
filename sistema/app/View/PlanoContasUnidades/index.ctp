<div class="planoContasUnidades index">
	<h2><?php echo __('Plano Contas Unidades'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('plano_conta_id'); ?></th>
			<th><?php echo $this->Paginator->sort('unidade_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($planoContasUnidades as $planoContasUnidade): ?>
	<tr>
		<td><?php echo h($planoContasUnidade['PlanoContasUnidade']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($planoContasUnidade['PlanoConta']['nome'], array('controller' => 'plano_contas', 'action' => 'view', $planoContasUnidade['PlanoConta']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($planoContasUnidade['Unidade']['nome'], array('controller' => 'unidades', 'action' => 'view', $planoContasUnidade['Unidade']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $planoContasUnidade['PlanoContasUnidade']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $planoContasUnidade['PlanoContasUnidade']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $planoContasUnidade['PlanoContasUnidade']['id']), array(), __('Are you sure you want to delete # %s?', $planoContasUnidade['PlanoContasUnidade']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Plano Contas Unidade'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Plano Contas'), array('controller' => 'plano_contas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Plano Conta'), array('controller' => 'plano_contas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Unidades'), array('controller' => 'unidades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unidade'), array('controller' => 'unidades', 'action' => 'add')); ?> </li>
	</ul>
</div>
