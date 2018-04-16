<div class="setoresUsuarios view">
<h2><?php echo __('Setores Usuario'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($setoresUsuario['SetoresUsuario']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Setore'); ?></dt>
		<dd>
			<?php echo $this->Html->link($setoresUsuario['Setore']['nome'], array('controller' => 'setores', 'action' => 'view', $setoresUsuario['Setore']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Usuario'); ?></dt>
		<dd>
			<?php echo $this->Html->link($setoresUsuario['Usuario']['nome'], array('controller' => 'usuarios', 'action' => 'view', $setoresUsuario['Usuario']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Setores Usuario'), array('action' => 'edit', $setoresUsuario['SetoresUsuario']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Setores Usuario'), array('action' => 'delete', $setoresUsuario['SetoresUsuario']['id']), array(), __('Are you sure you want to delete # %s?', $setoresUsuario['SetoresUsuario']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Setores Usuarios'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Setores Usuario'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Setores'), array('controller' => 'setores', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Setore'), array('controller' => 'setores', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Usuarios'), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usuario'), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
	</ul>
</div>
