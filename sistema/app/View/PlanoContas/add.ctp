<div class="planoContas form">
<?php echo $this->Form->create('PlanoConta'); ?>
	<fieldset>
		<legend><?php echo __('Add Plano Conta'); ?></legend>
	<?php
		echo $this->Form->input('nome');
		echo $this->Form->input('ativo');
		echo $this->Form->input('Unidade');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Plano Contas'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Lancamentos'), array('controller' => 'lancamentos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Lancamento'), array('controller' => 'lancamentos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Unidades'), array('controller' => 'unidades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unidade'), array('controller' => 'unidades', 'action' => 'add')); ?> </li>
	</ul>
</div>
