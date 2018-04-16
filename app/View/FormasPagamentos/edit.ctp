<div class="formasPagamentos form">
<?php echo $this->Form->create('FormasPagamento'); ?>
	<fieldset>
		<legend><?php echo __('Edit Formas Pagamento'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nome');
		echo $this->Form->input('ativo');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('FormasPagamento.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('FormasPagamento.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Formas Pagamentos'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Caixas'), array('controller' => 'caixas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Caixa'), array('controller' => 'caixas', 'action' => 'add')); ?> </li>
	</ul>
</div>
