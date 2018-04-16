<div class="formasPagamentos view">
<h2><?php echo __('Formas Pagamento'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($formasPagamento['FormasPagamento']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd>
			<?php echo h($formasPagamento['FormasPagamento']['nome']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ativo'); ?></dt>
		<dd>
			<?php echo h($formasPagamento['FormasPagamento']['ativo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($formasPagamento['FormasPagamento']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($formasPagamento['FormasPagamento']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Formas Pagamento'), array('action' => 'edit', $formasPagamento['FormasPagamento']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Formas Pagamento'), array('action' => 'delete', $formasPagamento['FormasPagamento']['id']), array(), __('Are you sure you want to delete # %s?', $formasPagamento['FormasPagamento']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Formas Pagamentos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Formas Pagamento'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Caixas'), array('controller' => 'caixas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Caixa'), array('controller' => 'caixas', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Caixas'); ?></h3>
	<?php if (!empty($formasPagamento['Caixa'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Pedido Id'); ?></th>
		<th><?php echo __('Formas Pagamento Id'); ?></th>
		<th><?php echo __('Usuario Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($formasPagamento['Caixa'] as $caixa): ?>
		<tr>
			<td><?php echo $caixa['id']; ?></td>
			<td><?php echo $caixa['created']; ?></td>
			<td><?php echo $caixa['modified']; ?></td>
			<td><?php echo $caixa['pedido_id']; ?></td>
			<td><?php echo $caixa['formas_pagamento_id']; ?></td>
			<td><?php echo $caixa['usuario_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'caixas', 'action' => 'view', $caixa['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'caixas', 'action' => 'edit', $caixa['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'caixas', 'action' => 'delete', $caixa['id']), array(), __('Are you sure you want to delete # %s?', $caixa['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Caixa'), array('controller' => 'caixas', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
