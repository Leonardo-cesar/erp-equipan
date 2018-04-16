<div class="precos form">
    <?php echo $this->Form->create('Preco'); ?>
    <fieldset>
        <legend><?php echo __('Edit Preco'); ?></legend>
        <?php
        echo $this->Form->input('id');
        echo $this->Form->input('valor');
        echo $this->Form->input('categoria_id');
        echo $this->Form->input('kit_id');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Preco.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Preco.id'))); ?></li>
        <li><?php echo $this->Html->link(__('List Precos'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('List Categorias'), array('controller' => 'categorias', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Categoria'), array('controller' => 'categorias', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Kits'), array('controller' => 'kits', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Kit'), array('controller' => 'kits', 'action' => 'add')); ?> </li>
    </ul>
</div>
