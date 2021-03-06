<div class="niveis index">
    <h2><?php echo __('Produtos'); ?></h2>
    <?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> ' . __('Cadastrar Novo'), array('action' => 'add'), array('class' => 'btn btn-success', 'escape' => false)); ?>&nbsp;
    <br clear="all"/>
    <br clear="all"/>
    <?php echo $this->Session->flash('produtos') ?> 
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="id"><?php echo $this->Paginator->sort('id'); ?></th>
                    <th><?php echo $this->Paginator->sort('nome'); ?></th>
                    <th><?php echo $this->Paginator->sort('codigo'); ?></th>
                    <th class="actions"><?php echo __('Opções'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if ($produtos) { ?>
                    <?php foreach ($produtos as $produto) { ?>
                        <tr>
                            <td><?php echo h($produto['Produto']['id']); ?>&nbsp;</td>
                            <td><?php echo h($produto['Produto']['nome']); ?>&nbsp;</td>
                            <td><?php echo h($produto['Produto']['codigo']); ?>&nbsp;</td>
                            <td class="actions">
                                <?php echo $this->Html->link('<i class="glyphicon glyphicon-search"></i> ' . __('Ver'), array('action' => 'view', $produto['Produto']['id']), array('type' => "button", 'class' => "btn btn-info btn-xs", 'escape' => FALSE)); ?>
                                <?php echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i> ' . __('Editar'), array('action' => 'edit', $produto['Produto']['id']), array('type' => "button", 'class' => "btn btn-warning btn-xs", 'escape' => FALSE)); ?>
                                <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-remove"></i> ' . __('Deletar'), array('action' => 'delete', $produto['Produto']['id']), array('type' => "button", 'class' => "btn btn-danger btn-xs", 'escape' => FALSE), __('Deseja deletar o Produto?', $produto['Produto']['id'])); ?>
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
