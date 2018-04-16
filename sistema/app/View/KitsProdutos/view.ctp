<div class="kitsProdutos view">
<h2><?php echo __('Kits Produto'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($kitsProduto['KitsProduto']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kit Id'); ?></dt>
		<dd>
			<?php echo h($kitsProduto['KitsProduto']['kit_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Produto Id'); ?></dt>
		<dd>
			<?php echo h($kitsProduto['KitsProduto']['produto_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Kits Produto'), array('action' => 'edit', $kitsProduto['KitsProduto']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Kits Produto'), array('action' => 'delete', $kitsProduto['KitsProduto']['id']), array(), __('Are you sure you want to delete # %s?', $kitsProduto['KitsProduto']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Kits Produtos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Kits Produto'), array('action' => 'add')); ?> </li>
	</ul>
</div>
