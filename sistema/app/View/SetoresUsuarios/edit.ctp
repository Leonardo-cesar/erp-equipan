<div class="setoresUsuarios form">
<?php echo $this->Form->create('SetoresUsuario'); ?>
	<fieldset>
		<legend><?php echo __('Edit Setores Usuario'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('setor_id');
		echo $this->Form->input('usuario_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SetoresUsuario.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('SetoresUsuario.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Setores Usuarios'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Setores'), array('controller' => 'setores', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Setore'), array('controller' => 'setores', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Usuarios'), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usuario'), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
	</ul>
</div>
