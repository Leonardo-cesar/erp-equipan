<div class="kitsUnidades form">
<?php echo $this->Form->create('KitsUnidade'); ?>
	<fieldset>
		<legend><?php echo __('Add Kits Unidade'); ?></legend>
	<?php
		echo $this->Form->input('kit_id');
		echo $this->Form->input('unidade_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Kits Unidades'), array('action' => 'index')); ?></li>
	</ul>
</div>
