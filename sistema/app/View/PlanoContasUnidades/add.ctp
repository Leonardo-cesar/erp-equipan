<div class="planoContasUnidades form">
<?php echo $this->Form->create('PlanoContasUnidade'); ?>
	<fieldset>
		<legend><?php echo __('Add Plano Contas Unidade'); ?></legend>
	<?php
		echo $this->Form->input('plano_conta_id');
		echo $this->Form->input('unidade_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Plano Contas Unidades'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Plano Contas'), array('controller' => 'plano_contas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Plano Conta'), array('controller' => 'plano_contas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Unidades'), array('controller' => 'unidades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unidade'), array('controller' => 'unidades', 'action' => 'add')); ?> </li>
	</ul>
</div>
