<div class="lancamentos index">
	<h2><?php echo __('Lancamentos'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('operacao'); ?></th>
			<th><?php echo $this->Paginator->sort('data'); ?></th>
			<th><?php echo $this->Paginator->sort('historico'); ?></th>
			<th><?php echo $this->Paginator->sort('valor'); ?></th>
			<th><?php echo $this->Paginator->sort('valor_p'); ?></th>
			<th><?php echo $this->Paginator->sort('situacao'); ?></th>
			<th><?php echo $this->Paginator->sort('observacao'); ?></th>
			<th><?php echo $this->Paginator->sort('ativo'); ?></th>
			<th><?php echo $this->Paginator->sort('tipo_pagamento_id'); ?></th>
			<th><?php echo $this->Paginator->sort('plano_conta_id'); ?></th>
			<th><?php echo $this->Paginator->sort('unidade_id'); ?></th>
			<th><?php echo $this->Paginator->sort('usuario_id'); ?></th>
			<th><?php echo $this->Paginator->sort('unidade_geradora_id'); ?></th>
			<th><?php echo $this->Paginator->sort('unidade_pagadora_id'); ?></th>
			<th><?php echo $this->Paginator->sort('unidade_recebedora_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($lancamentos as $lancamento): ?>
	<tr>
		<td><?php echo h($lancamento['Lancamento']['id']); ?>&nbsp;</td>
		<td><?php echo h($lancamento['Lancamento']['operacao']); ?>&nbsp;</td>
		<td><?php echo h($lancamento['Lancamento']['data']); ?>&nbsp;</td>
		<td><?php echo h($lancamento['Lancamento']['historico']); ?>&nbsp;</td>
		<td><?php echo h($lancamento['Lancamento']['valor']); ?>&nbsp;</td>
		<td><?php echo h($lancamento['Lancamento']['valor_p']); ?>&nbsp;</td>
		<td><?php echo h($lancamento['Lancamento']['situacao']); ?>&nbsp;</td>
		<td><?php echo h($lancamento['Lancamento']['observacao']); ?>&nbsp;</td>
		<td><?php echo h($lancamento['Lancamento']['ativo']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($lancamento['TipoPagamento']['nome'], array('controller' => 'tipo_pagamentos', 'action' => 'view', $lancamento['TipoPagamento']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($lancamento['PlanoConta']['nome'], array('controller' => 'plano_contas', 'action' => 'view', $lancamento['PlanoConta']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($lancamento['Unidade']['nome'], array('controller' => 'unidades', 'action' => 'view', $lancamento['Unidade']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($lancamento['Usuario']['nome'], array('controller' => 'usuarios', 'action' => 'view', $lancamento['Usuario']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($lancamento['UnidadeGeradora']['nome'], array('controller' => 'unidades', 'action' => 'view', $lancamento['UnidadeGeradora']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($lancamento['UnidadePagadora']['nome'], array('controller' => 'unidades', 'action' => 'view', $lancamento['UnidadePagadora']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($lancamento['UnidadeRecebedora']['nome'], array('controller' => 'unidades', 'action' => 'view', $lancamento['UnidadeRecebedora']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $lancamento['Lancamento']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $lancamento['Lancamento']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $lancamento['Lancamento']['id']), array(), __('Are you sure you want to delete # %s?', $lancamento['Lancamento']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Lancamento'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Tipo Pagamentos'), array('controller' => 'tipo_pagamentos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tipo Pagamento'), array('controller' => 'tipo_pagamentos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Plano Contas'), array('controller' => 'plano_contas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Plano Conta'), array('controller' => 'plano_contas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Unidades'), array('controller' => 'unidades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unidade'), array('controller' => 'unidades', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Usuarios'), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usuario'), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
	</ul>
</div>
