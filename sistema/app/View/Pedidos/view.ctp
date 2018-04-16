<div class="pedidos view">
    <h2><?php echo __('Pedido'); ?></h2>
    <dl>
        <dt><?php echo __('Id'); ?></dt>
        <dd>
            <?php echo h($pedido['Pedido']['id']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Valor'); ?></dt>
        <dd>
            <?php echo h($pedido['Pedido']['valor']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Desconto'); ?></dt>
        <dd>
            <?php echo h($pedido['Pedido']['desconto']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Tipo'); ?></dt>
        <dd>
            <?php echo h($pedido['Pedido']['tipo']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Situacao'); ?></dt>
        <dd>
            <?php echo h($pedido['Pedido']['situacao']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Observacao'); ?></dt>
        <dd>
            <?php echo h($pedido['Pedido']['observacao']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Usuario Desconto'); ?></dt>
        <dd>
            <?php echo $this->Html->link($pedido['UsuarioDesconto']['nome'], array('controller' => 'usuarios', 'action' => 'view', $pedido['UsuarioDesconto']['id'])); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Created'); ?></dt>
        <dd>
            <?php echo h($pedido['Pedido']['created']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Modified'); ?></dt>
        <dd>
            <?php echo h($pedido['Pedido']['modified']); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Usuario'); ?></dt>
        <dd>
            <?php echo $this->Html->link($pedido['Usuario']['nome'], array('controller' => 'usuarios', 'action' => 'view', $pedido['Usuario']['id'])); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Cliente'); ?></dt>
        <dd>
            <?php echo $this->Html->link($pedido['Cliente']['nome'], array('controller' => 'clientes', 'action' => 'view', $pedido['Cliente']['id'])); ?>
            &nbsp;
        </dd>
        <dt><?php echo __('Unidade'); ?></dt>
        <dd>
            <?php echo $this->Html->link($pedido['Unidade']['nome'], array('controller' => 'unidades', 'action' => 'view', $pedido['Unidade']['id'])); ?>
            &nbsp;
        </dd>
    </dl>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('Edit Pedido'), array('action' => 'edit', $pedido['Pedido']['id'])); ?> </li>
        <li><?php echo $this->Form->postLink(__('Delete Pedido'), array('action' => 'delete', $pedido['Pedido']['id']), array(), __('Are you sure you want to delete # %s?', $pedido['Pedido']['id'])); ?> </li>
        <li><?php echo $this->Html->link(__('List Pedidos'), array('action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Pedido'), array('action' => 'add')); ?> </li>
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
<div class="related">
    <h3><?php echo __('Related Caixas'); ?></h3>
    <?php if (!empty($pedido['Caixa'])): ?>
        <table cellpadding = "0" cellspacing = "0">
            <tr>
                <th><?php echo __('Id'); ?></th>
                <th><?php echo __('Created'); ?></th>
                <th><?php echo __('Modified'); ?></th>
                <th><?php echo __('Pedido Id'); ?></th>
                <th><?php echo __('Formas Pagamento Id'); ?></th>
                <th><?php echo __('Usuario Id'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
            <?php foreach ($pedido['Caixa'] as $caixa): ?>
                <tr>
                    <td><?php echo $caixa['id']; ?></td>
                    <td><?php echo $caixa['created']; ?></td>
                    <td><?php echo $caixa['modified']; ?></td>
                    <td><?php echo $caixa['pedido_id']; ?></td>
                    <td><?php echo $caixa['formas_pagamento_id']; ?></td>
                    <td><?php echo $caixa['usuario_id']; ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('controller' => 'caixas', 'action' => 'view', $caixa['id'])); ?>
                        <?php echo $this->Html->link(__('Edit'), array('controller' => 'caixas', 'action' => 'edit', $caixa['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'caixas', 'action' => 'delete', $caixa['id']), array(), __('Are you sure you want to delete # %s?', $caixa['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('New Caixa'), array('controller' => 'caixas', 'action' => 'add')); ?> </li>
        </ul>
    </div>
</div>
<div class="related">
    <h3><?php echo __('Related Estoques'); ?></h3>
    <?php if (!empty($pedido['Estoque'])): ?>
        <table cellpadding = "0" cellspacing = "0">
            <tr>
                <th><?php echo __('Id'); ?></th>
                <th><?php echo __('Quantidade'); ?></th>
                <th><?php echo __('Tipo'); ?></th>
                <th><?php echo __('Observacao'); ?></th>
                <th><?php echo __('Created'); ?></th>
                <th><?php echo __('Modified'); ?></th>
                <th><?php echo __('Produto Id'); ?></th>
                <th><?php echo __('Pedido Id'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
            <?php foreach ($pedido['Estoque'] as $estoque): ?>
                <tr>
                    <td><?php echo $estoque['id']; ?></td>
                    <td><?php echo $estoque['quantidade']; ?></td>
                    <td><?php echo $estoque['tipo']; ?></td>
                    <td><?php echo $estoque['observacao']; ?></td>
                    <td><?php echo $estoque['created']; ?></td>
                    <td><?php echo $estoque['modified']; ?></td>
                    <td><?php echo $estoque['produto_id']; ?></td>
                    <td><?php echo $estoque['pedido_id']; ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('controller' => 'estoques', 'action' => 'view', $estoque['id'])); ?>
                        <?php echo $this->Html->link(__('Edit'), array('controller' => 'estoques', 'action' => 'edit', $estoque['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'estoques', 'action' => 'delete', $estoque['id']), array(), __('Are you sure you want to delete # %s?', $estoque['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('New Estoque'), array('controller' => 'estoques', 'action' => 'add')); ?> </li>
        </ul>
    </div>
</div>
<div class="related">
    <h3><?php echo __('Related Perdas'); ?></h3>
    <?php if (!empty($pedido['Perda'])): ?>
        <table cellpadding = "0" cellspacing = "0">
            <tr>
                <th><?php echo __('Id'); ?></th>
                <th><?php echo __('Motivo'); ?></th>
                <th><?php echo __('Created'); ?></th>
                <th><?php echo __('Modified'); ?></th>
                <th><?php echo __('Produto Id'); ?></th>
                <th><?php echo __('Pedido Id'); ?></th>
                <th><?php echo __('Usuario Id'); ?></th>
                <th><?php echo __('Unidade Id'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
            <?php foreach ($pedido['Perda'] as $perda): ?>
                <tr>
                    <td><?php echo $perda['id']; ?></td>
                    <td><?php echo $perda['motivo']; ?></td>
                    <td><?php echo $perda['created']; ?></td>
                    <td><?php echo $perda['modified']; ?></td>
                    <td><?php echo $perda['produto_id']; ?></td>
                    <td><?php echo $perda['pedido_id']; ?></td>
                    <td><?php echo $perda['usuario_id']; ?></td>
                    <td><?php echo $perda['unidade_id']; ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('controller' => 'perdas', 'action' => 'view', $perda['id'])); ?>
                        <?php echo $this->Html->link(__('Edit'), array('controller' => 'perdas', 'action' => 'edit', $perda['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'perdas', 'action' => 'delete', $perda['id']), array(), __('Are you sure you want to delete # %s?', $perda['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('New Perda'), array('controller' => 'perdas', 'action' => 'add')); ?> </li>
        </ul>
    </div>
</div>
<div class="related">
    <h3><?php echo __('Related Kits'); ?></h3>
    <?php if (!empty($pedido['Kit'])): ?>
        <table cellpadding = "0" cellspacing = "0">
            <tr>
                <th><?php echo __('Id'); ?></th>
                <th><?php echo __('Nome'); ?></th>
                <th><?php echo __('Observacao'); ?></th>
                <th><?php echo __('Ativo'); ?></th>
                <th><?php echo __('Created'); ?></th>
                <th><?php echo __('Modified'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
            <?php foreach ($pedido['Kit'] as $kit): ?>
                <tr>
                    <td><?php echo $kit['id']; ?></td>
                    <td><?php echo $kit['nome']; ?></td>
                    <td><?php echo $kit['observacao']; ?></td>
                    <td><?php echo $kit['ativo']; ?></td>
                    <td><?php echo $kit['created']; ?></td>
                    <td><?php echo $kit['modified']; ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('controller' => 'kits', 'action' => 'view', $kit['id'])); ?>
                        <?php echo $this->Html->link(__('Edit'), array('controller' => 'kits', 'action' => 'edit', $kit['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'kits', 'action' => 'delete', $kit['id']), array(), __('Are you sure you want to delete # %s?', $kit['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('New Kit'), array('controller' => 'kits', 'action' => 'add')); ?> </li>
        </ul>
    </div>
</div>
