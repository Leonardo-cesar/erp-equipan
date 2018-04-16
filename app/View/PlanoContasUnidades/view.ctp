<div class="planoContasUnidades view">
<h2><?php echo __('Plano Contas Unidade'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($planoContasUnidade['PlanoContasUnidade']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Plano Conta'); ?></dt>
		<dd>
			<?php echo $this->Html->link($planoContasUnidade['PlanoConta']['nome'], array('controller' => 'plano_contas', 'action' => 'view', $planoContasUnidade['PlanoConta']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unidade'); ?></dt>
		<dd>
			<?php echo $this->Html->link($planoContasUnidade['Unidade']['nome'], array('controller' => 'unidades', 'action' => 'view', $planoContasUnidade['Unidade']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Plano Contas Unidade'), array('action' => 'edit', $planoContasUnidade['PlanoContasUnidade']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Plano Contas Unidade'), array('action' => 'delete', $planoContasUnidade['PlanoContasUnidade']['id']), array(), __('Are you sure you want to delete # %s?', $planoContasUnidade['PlanoContasUnidade']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Plano Contas Unidades'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Plano Contas Unidade'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Plano Contas'), array('controller' => 'plano_contas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Plano Conta'), array('controller' => 'plano_contas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Unidades'), array('controller' => 'unidades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unidade'), array('controller' => 'unidades', 'action' => 'add')); ?> </li>
	</ul>
</div>
