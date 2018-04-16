<div class="pedidos form">
    <?php echo $this->Form->create('Pedido'); ?>
    <fieldset>
        <legend><?php echo __('Edit Pedido'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('valor');
        echo $this->Form->input('desconto');
        echo $this->Form->input('tipo');
        echo $this->Form->input('situacao');
        echo $this->Form->input('observacao');
        echo $this->Form->input('usuario_desconto_id');
        echo $this->Form->input('usuario_id');
        echo $this->Form->input('cliente_id');
        echo $this->Form->input('unidade_id');
        echo $this->Form->input('Kit');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Pedido.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Pedido.id'))); ?></li>
        <li><?php echo $this->Html->link(__('List Pedidos'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('List Usuarios'), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Usuario Desconto'), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Clientes'), array('controller' => 'clientes', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Cliente'), array('controller' => 'clientes', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Unidades'), array('controller' => 'unidades', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Unidade'), array('controller' => 'unidades', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Caixas'), array('controller' => 'caixas', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Caixa'), array('controller' => 'caixas', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Estoques'), array('controller' => 'estoques', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Estoque'), array('controller' => 'estoques', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Perdas'), array('controller' => 'perdas', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Perda'), array('controller' => 'perdas', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Kits'), array('controller' => 'kits', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Kit'), array('controller' => 'kits', 'action' => 'add')); ?> </li>
    </ul>
</div>
