<div class="kitsUnidades view">
<h2><?php echo __('Kits Unidade'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($kitsUnidade['KitsUnidade']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Kit Id'); ?></dt>
		<dd>
			<?php echo h($kitsUnidade['KitsUnidade']['kit_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unidade Id'); ?></dt>
		<dd>
			<?php echo h($kitsUnidade['KitsUnidade']['unidade_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Kits Unidade'), array('action' => 'edit', $kitsUnidade['KitsUnidade']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Kits Unidade'), array('action' => 'delete', $kitsUnidade['KitsUnidade']['id']), array(), __('Are you sure you want to delete # %s?', $kitsUnidade['KitsUnidade']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Kits Unidades'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Kits Unidade'), array('action' => 'add')); ?> </li>
	</ul>
</div>
