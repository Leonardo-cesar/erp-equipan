<div class="perdas index">
    <h2><?php echo __('Perdas'); ?></h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>id</th>
                <th>Produto</th>
                <th>Pedido</th>
                <th>Usuario</th>
                <th>Unidade</th>
                <th>Motivo</th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($perdas as $perda): ?>
                <tr>
                    <td><?php echo h($perda['Perda']['id']); ?>&nbsp;</td>
                    <td>
                        <?php echo $this->Html->link($perda['Produto']['nome'], array('controller' => 'produtos', 'action' => 'view', $perda['Produto']['id'])); ?>
                    </td>
                    <td>
                        <?php echo $this->Html->link($perda['Pedido']['id'], array('controller' => 'pedidos', 'action' => 'view', $perda['Pedido']['id'])); ?>
                    </td>
                    <td>
                        <?php echo $this->Html->link($perda['Usuario']['nome'], array('controller' => 'usuarios', 'action' => 'view', $perda['Usuario']['id'])); ?>
                    </td>
                    <td>
                        <?php echo $this->Html->link($perda['Unidade']['nome'], array('controller' => 'unidades', 'action' => 'view', $perda['Unidade']['id'])); ?>
                    </td>
                    <td><?php echo h($perda['Perda']['motivo']); ?>&nbsp;</td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('action' => 'view', $perda['Perda']['id'])); ?>
                        <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $perda['Perda']['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $perda['Perda']['id']), array(), __('Are you sure you want to delete # %s?', $perda['Perda']['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>