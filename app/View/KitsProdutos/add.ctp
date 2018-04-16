<div class="kitsProdutos form">
<?php echo $this->Form->create('KitsProduto'); ?>
	<fieldset>
		<legend><?php echo __('Add Kits Produto'); ?></legend>
	<?php
		echo $this->Form->input('kit_id');
		echo $this->Form->input('produto_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Kits Produtos'), array('action' => 'index')); ?></li>
	</ul>
</div>
