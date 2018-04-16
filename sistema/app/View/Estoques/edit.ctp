<div class="estoques form">
    <?php echo $this->Form->create('Estoque'); ?>
    <fieldset>
        <legend><?php echo __('Edit Estoque'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('quantidade');
        echo $this->Form->input('tipo');
        echo $this->Form->input('observacao');
        echo $this->Form->input('produto_id');
        echo $this->Form->input('pedido_id');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Estoque.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Estoque.id'))); ?></li>
        <li><?php echo $this->Html->link(__('List Estoques'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('List Produtos'), array('controller' => 'produtos', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Produto'), array('controller' => 'produtos', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Pedidos'), array('controller' => 'pedidos', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Pedido'), array('controller' => 'pedidos', 'action' => 'add')); ?> </li>
    </ul>
</div>
