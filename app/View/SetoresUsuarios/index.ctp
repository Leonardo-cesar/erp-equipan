<div class="setoresUsuarios index">
	<h2><?php echo __('Setores Usuarios'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('setor_id'); ?></th>
			<th><?php echo $this->Paginator->sort('usuario_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($setoresUsuarios as $setoresUsuario): ?>
	<tr>
		<td><?php echo h($setoresUsuario['SetoresUsuario']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($setoresUsuario['Setore']['nome'], array('controller' => 'setores', 'action' => 'view', $setoresUsuario['Setore']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($setoresUsuario['Usuario']['nome'], array('controller' => 'usuarios', 'action' => 'view', $setoresUsuario['Usuario']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $setoresUsuario['SetoresUsuario']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $setoresUsuario['SetoresUsuario']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $setoresUsuario['SetoresUsuario']['id']), array(), __('Are you sure you want to delete # %s?', $setoresUsuario['SetoresUsuario']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Setores Usuario'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Setores'), array('controller' => 'setores', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Setore'), array('controller' => 'setores', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Usuarios'), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usuario'), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
	</ul>
</div>
