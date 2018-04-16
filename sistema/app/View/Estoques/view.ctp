<div class="estoques view">
    <h2><?php echo __('Estoque'); ?></h2>
    <dl>
        <dt><?php echo __('Id'); ?></dt>
        <dd>
            <?php echo h($estoque['Estoque']['id']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Quantidade'); ?></dt>
        <dd>
            <?php echo h($estoque['Estoque']['quantidade']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Tipo'); ?></dt>
        <dd>
            <?php echo h($estoque['Estoque']['tipo']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Observacao'); ?></dt>
        <dd>
            <?php echo h($estoque['Estoque']['observacao']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Created'); ?></dt>
        <dd>
            <?php echo h($estoque['Estoque']['created']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Modified'); ?></dt>
        <dd>
            <?php echo h($estoque['Estoque']['modified']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Produto'); ?></dt>
        <dd>
            <?php echo $this->Html->link($estoque['Produto']['nome'], array('controller' => 'produtos', 'action' => 'view', $estoque['Produto']['id'])); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Pedido'); ?></dt>
        <dd>
            <?php echo $this->Html->link($estoque['Pedido']['id'], array('controller' => 'pedidos', 'action' => 'view', $estoque['Pedido']['id'])); ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Edit Estoque'), array('action' => 'edit', $estoque['Estoque']['id'])); ?> </li>
        <li><?php echo $this->Form->postLink(__('Delete Estoque'), array('action' => 'delete', $estoque['Estoque']['id']), array(), __('Are you sure you want to delete # %s?', $estoque['Estoque']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__('List Estoques'), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Estoque'), array('action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Produtos'), array('controller' => 'produtos', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Produto'), array('controller' => 'produtos', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Pedidos'), array('controller' => 'pedidos', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Pedido'), array('controller' => 'pedidos', 'action' => 'add')); ?> </li>
    </ul>
</div>
