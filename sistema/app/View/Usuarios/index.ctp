<div class="niveis index">
    <h2><?php echo __('Usuários'); ?></h2>
    <?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> ' . __('Cadastrar Novo'), array('action' => 'add'), array('class' => 'btn btn-success', 'escape' => false)); ?>&nbsp;
    <br clear="all"/>
    <br clear="all"/>
    <?php echo $this->Session->flash('usuario') ?> 
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="id"><?php echo $this->Paginator->sort('id'); ?></th>
                    <th><?php echo $this->Paginator->sort('nome'); ?></th>
                    <th><?php echo $this->Paginator->sort('nivel_id', 'Nível'); ?></th>
                    <th><?php echo $this->Paginator->sort('unidade_id', 'Unidade'); ?></th>
                    <th><?php echo $this->Paginator->sort('ativo', 'Situação'); ?></th>
                    <th class="actions"><?php echo __('Opções'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if ($usuarios) { ?>
                    <?php foreach ($usuarios as $usuario) { ?>
                        <tr>
                            <td><?php echo h($usuario['Usuario']['id']); ?>&nbsp;</td>
                            <td><?php echo h($usuario['Usuario']['nome']); ?>&nbsp;</td>
                            <td><?php echo $this->Html->link($usuario['Nivei']['nome'], array('controller' => 'niveis', 'action' => 'view', $usuario['Nivei']['id'])); ?>&nbsp;</td>
                            <td>
                                <?php
                                if ($usuario['Nivei']['id'] != 1) {
                                    foreach ($usuario['Unidade'] as $unidade) {
                                        $unidades[$usuario['Usuario']['id']][] = $this->Html->link($unidade['nome'], array('controller' => 'unidades', 'action' => 'view', $unidade['id']));
                                    }
                                    echo implode(', ', $unidades[$usuario['Usuario']['id']]);
                                } else {
                                    echo "Todas";
                                }
                                ?>&nbsp;</td>
                            <td><?php echo $usuario['Usuario']['ativo'] == 0 ? 'Desativado' : 'Ativo'; ?>&nbsp;</td>
                            <td class="actions">
                                <?php echo $this->Html->link('<i class="glyphicon glyphicon-search"></i> ' . __('Ver'), array('action' => 'view', $usuario['Usuario']['id']), array('type' => "button", 'class' => "btn btn-info btn-xs", 'escape' => FALSE)); ?>
                                <?php echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i> ' . __('Editar'), array('action' => 'edit', $usuario['Usuario']['id']), array('type' => "button", 'class' => "btn btn-warning btn-xs", 'escape' => FALSE)); ?>
                                <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-remove"></i> ' . __('Deletar'), array('action' => 'delete', $usuario['Usuario']['id']), array('type' => "button", 'class' => "btn btn-danger btn-xs", 'escape' => FALSE), __('Deseja deletar o usuário?', $usuario['Usuario']['id'])); ?>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr><td colspan="4">Nenhum registro encontrado</td></tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php if ($this->Paginator->numbers()) { ?>
        <div class="pagination pagination-large">
            <ul class="pagination">
                <?php
                echo $this->Paginator->prev(__('<<'), array('tag' => 'li'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
                echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'currentClass' => 'active', 'tag' => 'li', 'first' => 1));
                echo $this->Paginator->next(__('>>'), array('tag' => 'li', 'currentClass' => 'disabled'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
                ?>
            </ul>
        </div>
    <?php } ?>
</div>