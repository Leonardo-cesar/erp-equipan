<div class="perdas view">
    <h2><?php echo __('Perda'); ?></h2>
    <dl>
        <dt><?php echo __('Id'); ?></dt>
        <dd>
            <?php echo h($perda['Perda']['id']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Motivo'); ?></dt>
        <dd>
            <?php echo h($perda['Perda']['motivo']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Created'); ?></dt>
        <dd>
            <?php echo h($perda['Perda']['created']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Modified'); ?></dt>
        <dd>
            <?php echo h($perda['Perda']['modified']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Produto'); ?></dt>
        <dd>
            <?php echo $this->Html->link($perda['Produto']['nome'], array('controller' => 'produtos', 'action' => 'view', $perda['Produto']['id'])); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Pedido'); ?></dt>
        <dd>
            <?php echo $this->Html->link($perda['Pedido']['id'], array('controller' => 'pedidos', 'action' => 'view', $perda['Pedido']['id'])); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Usuario'); ?></dt>
        <dd>
            <?php echo $this->Html->link($perda['Usuario']['nome'], array('controller' => 'usuarios', 'action' => 'view', $perda['Usuario']['id'])); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Unidade'); ?></dt>
        <dd>
            <?php echo $this->Html->link($perda['Unidade']['nome'], array('controller' => 'unidades', 'action' => 'view', $perda['Unidade']['id'])); ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Edit Perda'), array('action' => 'edit', $perda['Perda']['id'])); ?> </li>
        <li><?php echo $this->Form->postLink(__('Delete Perda'), array('action' => 'delete', $perda['Perda']['id']), array(), __('Are you sure you want to delete # %s?', $perda['Perda']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__('List Perdas'), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Perda'), array('action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Produtos'), array('controller' => 'produtos', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Produto'), array('controller' => 'produtos', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Pedidos'), array('controller' => 'pedidos', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Pedido'), array('controller' => 'pedidos', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Usuarios'), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Usuario'), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Unidades'), array('controller' => 'unidades', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Unidade'), array('controller' => 'unidades', 'action' => 'add')); ?> </li>
    </ul>
</div>
