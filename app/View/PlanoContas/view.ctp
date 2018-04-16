<div class="planoContas view">
<h2><?php echo __('Plano Conta'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($planoConta['PlanoConta']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($planoConta['PlanoConta']['nome']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ativo'); ?></dt>
		<dd>
			<?php echo h($planoConta['PlanoConta']['ativo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($planoConta['PlanoConta']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($planoConta['PlanoConta']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Plano Conta'), array('action' => 'edit', $planoConta['PlanoConta']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Plano Conta'), array('action' => 'delete', $planoConta['PlanoConta']['id']), array(), __('Are you sure you want to delete # %s?', $planoConta['PlanoConta']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Plano Contas'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Plano Conta'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Lancamentos'), array('controller' => 'lancamentos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lancamento'), array('controller' => 'lancamentos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Unidades'), array('controller' => 'unidades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unidade'), array('controller' => 'unidades', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Lancamentos'); ?></h3>
	<?php if (!empty($planoConta['Lancamento'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Operacao'); ?></th>
		<th><?php echo __('Data'); ?></th>
		<th><?php echo __('Historico'); ?></th>
		<th><?php echo __('Valor'); ?></th>
		<th><?php echo __('Valor P'); ?></th>
		<th><?php echo __('Situacao'); ?></th>
		<th><?php echo __('Observacao'); ?></th>
		<th><?php echo __('Ativo'); ?></th>
		<th><?php echo __('Tipo Pagamento Id'); ?></th>
		<th><?php echo __('Plano Conta Id'); ?></th>
		<th><?php echo __('Unidade Id'); ?></th>
		<th><?php echo __('Usuario Id'); ?></th>
		<th><?php echo __('Unidade Geradora Id'); ?></th>
		<th><?php echo __('Unidade Pagadora Id'); ?></th>
		<th><?php echo __('Unidade Recebedora Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($planoConta['Lancamento'] as $lancamento): ?>
		<tr>
			<td><?php echo $lancamento['id']; ?></td>
			<td><?php echo $lancamento['operacao']; ?></td>
			<td><?php echo $lancamento['data']; ?></td>
			<td><?php echo $lancamento['historico']; ?></td>
			<td><?php echo $lancamento['valor']; ?></td>
			<td><?php echo $lancamento['valor_p']; ?></td>
			<td><?php echo $lancamento['situacao']; ?></td>
			<td><?php echo $lancamento['observacao']; ?></td>
			<td><?php echo $lancamento['ativo']; ?></td>
			<td><?php echo $lancamento['tipo_pagamento_id']; ?></td>
			<td><?php echo $lancamento['plano_conta_id']; ?></td>
			<td><?php echo $lancamento['unidade_id']; ?></td>
			<td><?php echo $lancamento['usuario_id']; ?></td>
			<td><?php echo $lancamento['unidade_geradora_id']; ?></td>
			<td><?php echo $lancamento['unidade_pagadora_id']; ?></td>
			<td><?php echo $lancamento['unidade_recebedora_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'lancamentos', 'action' => 'view', $lancamento['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'lancamentos', 'action' => 'edit', $lancamento['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'lancamentos', 'action' => 'delete', $lancamento['id']), array(), __('Are you sure you want to delete # %s?', $lancamento['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Lancamento'), array('controller' => 'lancamentos', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Unidades'); ?></h3>
	<?php if (!empty($planoConta['Unidade'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Nome'); ?></th>
		<th><?php echo __('Ativa'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($planoConta['Unidade'] as $unidade): ?>
		<tr>
			<td><?php echo $unidade['id']; ?></td>
			<td><?php echo $unidade['nome']; ?></td>
			<td><?php echo $unidade['ativa']; ?></td>
			<td><?php echo $unidade['created']; ?></td>
			<td><?php echo $unidade['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'unidades', 'action' => 'view', $unidade['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'unidades', 'action' => 'edit', $unidade['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'unidades', 'action' => 'delete', $unidade['id']), array(), __('Are you sure you want to delete # %s?', $unidade['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Unidade'), array('controller' => 'unidades', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
