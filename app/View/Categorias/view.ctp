<div class="niveis view">
    <h2><?php echo __('Categoria'); ?></h2>
    <table class="table table-hover table-bordered">
        <tr>
            <td><?php echo __('Id'); ?></td>
            <td><?php echo h($categoria['Categoria']['id']); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Nome'); ?></td>
            <td><?php echo h($categoria['Categoria']['nome']); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Ativo'); ?></td>
            <td><?php echo $categoria['Categoria']['ativo'] == 1 ? 'Ativo' : 'Desativado'; ?></td>
        </tr>
        <tr>
            <td><?php echo __('Criado as '); ?></td>
            <td><?php echo date("d/m/Y H:i:s", strtotime($categoria['Categoria']['created'])); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Modificado as'); ?></td>
            <td><?php echo date("d/m/Y H:i:s", strtotime($categoria['Categoria']['modified'])); ?></td>
        </tr>
    </table>
</div>
<hr />
<?php echo $this->Html->link('<i class="glyphicon glyphicon-arrow-left"></i> ' . 'Voltar', array('action' => 'index'), array('class' => 'btn btn-default', 'escape' => false)); ?>&nbsp;
<?php echo $this->Html->link('<i class="glyphicon glyphicon-ok"></i> ' . __('Cadastrar Novo'), array('action' => 'add'), array('class' => 'btn btn-success', 'escape' => false)); ?>&nbsp;
<?php echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i> ' . __('Editar'), array('action' => 'edit', $categoria['Categoria']['id']), array('class' => 'btn btn-warning', 'escape' => false)); ?>&nbsp;
<?php echo $this->Form->postLink('<i class="glyphicon glyphicon-remove"></i> ' . __('Deletar'), array('action' => 'delete', $categoria['Categoria']['id']), array('class' => 'btn btn-danger', 'escape' => false), __('Deseja deletar a Categoria?', $categoria['Categoria']['id'])); ?>&nbsp;