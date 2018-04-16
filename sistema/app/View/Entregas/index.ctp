<div class="entregas index">
    <h2><?php echo __('Entregas'); ?></h2>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?php echo $this->Paginator->sort('id'); ?></th>
                <th><?php echo $this->Paginator->sort('observacao'); ?></th>
                <th><?php echo $this->Paginator->sort('created'); ?></th>
                <th><?php echo $this->Paginator->sort('modified'); ?></th>
                <th><?php echo $this->Paginator->sort('unidade_id'); ?></th>
                <th><?php echo $this->Paginator->sort('usuario_id'); ?></th>
                <th><?php echo $this->Paginator->sort('pedido_id'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($entregas as $entrega): ?>
                <tr>
                    <td><?php echo h($entrega['Entrega']['id']); ?>&nbsp;</td>
                    <td><?php echo h($entrega['Entrega']['observacao']); ?>&nbsp;</td>
                    <td><?php echo h($entrega['Entrega']['created']); ?>&nbsp;</td>
                    <td><?php echo h($entrega['Entrega']['modified']); ?>&nbsp;</td>
                    <td>
                        <?php echo $this->Html->link($entrega['Unidade']['nome'], array('controller' => 'unidades', 'action' => 'view', $entrega['Unidade']['id'])); ?>
                    </td>
                    <td>
                        <?php echo $this->Html->link($entrega['Usuario']['nome'], array('controller' => 'usuarios', 'action' => 'view', $entrega['Usuario']['id'])); ?>
                    </td>
                    <td>
                        <?php echo $this->Html->link($entrega['Pedido']['id'], array('controller' => 'pedidos', 'action' => 'view', $entrega['Pedido']['id'])); ?>
                    </td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('action' => 'view', $entrega['Entrega']['id'])); ?>
                        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $entrega['Entrega']['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $entrega['Entrega']['id']), array(), __('Are you sure you want to delete # %s?', $entrega['Entrega']['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?>	</p>
    <div class="paging">
        <?php
        echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
        ?>
    </div>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('New Entrega'), array('action' => 'add')); ?></li>
        <li><?php echo $this->Html->link(__('List Unidades'), array('controller' => 'unidades', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Unidade'), array('controller' => 'unidades', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Usuarios'), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Usuario'), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Pedidos'), array('controller' => 'pedidos', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Pedido'), array('controller' => 'pedidos', 'action' => 'add')); ?> </li>
    </ul>
</div>
