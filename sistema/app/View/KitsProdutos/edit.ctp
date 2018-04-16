<div class="kitsProdutos form">
<?php echo $this->Form->create('KitsProduto'); ?>
	<fieldset>
		<legend><?php echo __('Edit Kits Produto'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('kit_id');
		echo $this->Form->input('produto_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('KitsProduto.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('KitsProduto.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Kits Produtos'), array('action' => 'index')); ?></li>
	</ul>
</div>
