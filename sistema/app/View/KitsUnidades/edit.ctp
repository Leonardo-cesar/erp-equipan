<div class="kitsUnidades form">
<?php echo $this->Form->create('KitsUnidade'); ?>
	<fieldset>
		<legend><?php echo __('Edit Kits Unidade'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('kit_id');
		echo $this->Form->input('unidade_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('KitsUnidade.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('KitsUnidade.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Kits Unidades'), array('action' => 'index')); ?></li>
	</ul>
</div>
