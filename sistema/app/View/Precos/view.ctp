<div class="precos view">
    <h2><?php echo __('Preco'); ?></h2>
    <dl>
        <dt><?php echo __('Id'); ?></dt>
        <dd>
            <?php echo h($preco['Preco']['id']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Valor'); ?></dt>
        <dd>
            <?php echo h($preco['Preco']['valor']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Created'); ?></dt>
        <dd>
            <?php echo h($preco['Preco']['created']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Modified'); ?></dt>
        <dd>
            <?php echo h($preco['Preco']['modified']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Categoria'); ?></dt>
        <dd>
            <?php echo $this->Html->link($preco['Categoria']['nome'], array('controller' => 'categorias', 'action' => 'view', $preco['Categoria']['id'])); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Kit'); ?></dt>
        <dd>
            <?php echo $this->Html->link($preco['Kit']['nome'], array('controller' => 'kits', 'action' => 'view', $preco['Kit']['id'])); ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Edit Preco'), array('action' => 'edit', $preco['Preco']['id'])); ?> </li>
        <li><?php echo $this->Form->postLink(__('Delete Preco'), array('action' => 'delete', $preco['Preco']['id']), array(), __('Are you sure you want to delete # %s?', $preco['Preco']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__('List Precos'), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Preco'), array('action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Categorias'), array('controller' => 'categorias', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Categoria'), array('controller' => 'categorias', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Kits'), array('controller' => 'kits', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Kit'), array('controller' => 'kits', 'action' => 'add')); ?> </li>
    </ul>
</div>
