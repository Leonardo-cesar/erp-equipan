<div class="unidadesLancamentos view">
<h2><?php echo __('Unidades Lancamento'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($unidadesLancamento['UnidadesLancamento']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($unidadesLancamento['UnidadesLancamento']['nome']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tipo'); ?></dt>
		<dd>
			<?php echo h($unidadesLancamento['UnidadesLancamento']['tipo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ativo'); ?></dt>
		<dd>
			<?php echo h($unidadesLancamento['UnidadesLancamento']['ativo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($unidadesLancamento['UnidadesLancamento']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($unidadesLancamento['UnidadesLancamento']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Unidades Lancamento'), array('action' => 'edit', $unidadesLancamento['UnidadesLancamento']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Unidades Lancamento'), array('action' => 'delete', $unidadesLancamento['UnidadesLancamento']['id']), array(), __('Are you sure you want to delete # %s?', $unidadesLancamento['UnidadesLancamento']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Unidades Lancamentos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unidades Lancamento'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Unidades Unidades Lancamentos'), array('controller' => 'unidades_unidades_lancamentos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unidades Unidades Lancamento'), array('controller' => 'unidades_unidades_lancamentos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Unidades Unidades Lancamentos'); ?></h3>
	<?php if (!empty($unidadesLancamento['UnidadesUnidadesLancamento'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Unidade Id'); ?></th>
		<th><?php echo __('Unidades Lancamento Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($unidadesLancamento['UnidadesUnidadesLancamento'] as $unidadesUnidadesLancamento): ?>
		<tr>
			<td><?php echo $unidadesUnidadesLancamento['id']; ?></td>
			<td><?php echo $unidadesUnidadesLancamento['unidade_id']; ?></td>
			<td><?php echo $unidadesUnidadesLancamento['unidades_lancamento_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'unidades_unidades_lancamentos', 'action' => 'view', $unidadesUnidadesLancamento['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'unidades_unidades_lancamentos', 'action' => 'edit', $unidadesUnidadesLancamento['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'unidades_unidades_lancamentos', 'action' => 'delete', $unidadesUnidadesLancamento['id']), array(), __('Are you sure you want to delete # %s?', $unidadesUnidadesLancamento['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Unidades Unidades Lancamento'), array('controller' => 'unidades_unidades_lancamentos', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
