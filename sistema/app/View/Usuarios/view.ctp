<div class="niveis view">
    <h2><?php echo __('Usuário'); ?></h2>
    <table class="table table-hover table-bordered">
        <tr>
            <td><?php echo __('Id'); ?></td>
            <td><?php echo h($usuario['Usuario']['id']); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Nome'); ?></td>
            <td><?php echo h($usuario['Usuario']['nome']); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Email'); ?></td>
            <td><?php echo h($usuario['Usuario']['email']); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Usuário'); ?></td>
            <td><?php echo h($usuario['Usuario']['usuario']); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Data de Aniversário'); ?></td>
            <td><?php echo h($usuario['Usuario']['data_aniversario']); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Último acesso'); ?></td>
            <td><?php echo h($usuario['Usuario']['ultimo_acesso']); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Unidade'); ?></td>
            <td>
                <?php foreach ($usuario['Unidade'] as $unidade) { ?>
                    <?php $un[] = $unidade['nome'] ?>
                <?php } ?>
                <?php echo implode(', ', $un); ?>
            </td>
        </tr>
        <tr>
            <td><?php echo __('Nível'); ?></td>
            <td><?php echo h($usuario['Nivei']['nome']); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Setores'); ?></td>
            <td>
                <?php foreach ($usuario['Setore'] as $setor) { ?>
                    <?php $st[] = $setor['nome'] ?>
                <?php } ?>
                <?php echo implode(', ', $st); ?>
            </td>
        </tr>
        <tr>
            <td><?php echo __('Ativo'); ?></td>
            <td><?php echo $usuario['Usuario']['ativo'] == 1 ? 'Ativo' : 'Desativado'; ?></td>
        </tr>
        <tr>
            <td><?php echo __('Criado as '); ?></td>
            <td><?php echo date("d/m/Y H:i:s", strtotime($usuario['Usuario']['created'])); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Modificado as'); ?></td>
            <td><?php echo date("d/m/Y H:i:s", strtotime($usuario['Usuario']['modified'])); ?></td>
        </tr>
    </table>
</div>
<hr />
<?php echo $this->Html->link('<i class="glyphicon glyphicon-arrow-left"></i> ' . 'Voltar', array('action' => 'index'), array('class' => 'btn btn-default', 'escape' => false)); ?>&nbsp;
<?php echo $this->Html->link('<i class="glyphicon glyphicon-ok"></i> ' . __('Cadastrar Novo'), array('action' => 'add'), array('class' => 'btn btn-success', 'escape' => false)); ?>&nbsp;
<?php echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i> ' . __('Editar'), array('action' => 'edit', $usuario['Usuario']['id']), array('class' => 'btn btn-warning', 'escape' => false)); ?>&nbsp;
<?php echo $this->Form->postLink('<i class="glyphicon glyphicon-remove"></i> ' . __('Deletar'), array('action' => 'delete', $usuario['Usuario']['id']), array('class' => 'btn btn-danger', 'escape' => false), __('Deseja deletar o setor?', $usuario['Usuario']['id'])); ?>&nbsp;
