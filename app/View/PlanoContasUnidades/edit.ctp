<div class="planoContasUnidades form">
<?php echo $this->Form->create('PlanoContasUnidade'); ?>
	<fieldset>
		<legend><?php echo __('Edit Plano Contas Unidade'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('plano_conta_id');
		echo $this->Form->input('unidade_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('PlanoContasUnidade.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('PlanoContasUnidade.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Plano Contas Unidades'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Plano Contas'), array('controller' => 'plano_contas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Plano Conta'), array('controller' => 'plano_contas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Unidades'), array('controller' => 'unidades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unidade'), array('controller' => 'unidades', 'action' => 'add')); ?> </li>
	</ul>
</div>
