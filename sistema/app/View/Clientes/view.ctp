<div class="niveis view">
    <h2><?php echo __('Cliente'); ?></h2>
    <table class="table table-hover table-bordered">
        <tr>            
            <td><?php echo __('Id'); ?></td>
            <td><?php echo h($cliente['Cliente']['id']); ?>&nbsp;</td>
        </tr> 
        <tr>            
            <td><?php echo __('Nome'); ?></td>
            <td><?php echo h($cliente['Cliente']['nome']); ?>&nbsp;</td>
        </tr> 
        <tr>            
            <td><?php echo __('Email'); ?></td>
            <td><?php echo h($cliente['Cliente']['email']); ?>&nbsp;</td>
        </tr> 
        <tr>            
            <td><?php echo __('Telefone'); ?></td>
            <td><?php echo h($cliente['Cliente']['telefone']); ?>&nbsp;</td>
        </tr> 
        <tr>            
            <td><?php echo __('Telefone2'); ?></td>
            <td><?php echo h($cliente['Cliente']['telefone2']); ?>&nbsp;</td>
        </tr> 
        <tr>            
            <td><?php echo __('Celular'); ?></td>
            <td><?php echo h($cliente['Cliente']['celular']); ?>&nbsp;</td>
        </tr> 
        <tr>            
            <td><?php echo __('Data Nascimento'); ?></td>
            <td><?php echo h($cliente['Cliente']['data_nascimento']); ?>&nbsp;</td>
        </tr> 
        <tr>            
            <td><?php echo __('Endereco'); ?></td>
            <td><?php echo h($cliente['Cliente']['endereco']); ?>&nbsp;</td>
        </tr> 
        <tr>            
            <td><?php echo __('Numero'); ?></td>
            <td><?php echo h($cliente['Cliente']['numero']); ?>&nbsp;</td>
        </tr> 
        <tr>            
            <td><?php echo __('Complemento'); ?></td>
            <td><?php echo h($cliente['Cliente']['complemento']); ?>&nbsp;</td>
        </tr> 
        <tr>            
            <td><?php echo __('Bairro'); ?></td>
            <td><?php echo h($cliente['Cliente']['bairro']); ?>&nbsp;</td>
        </tr> 
        <tr>            
            <td><?php echo __('Cidade'); ?></td>
            <td><?php echo h($cliente['Cliente']['cidade']); ?>&nbsp;</td>
        </tr> 
        <tr>            
            <td><?php echo __('Estado'); ?></td>
            <td><?php echo h($cliente['Cliente']['estado']); ?>&nbsp;</td>
        </tr> 
        <tr>            
            <td><?php echo __('Cpf'); ?></td>
            <td><?php echo h($cliente['Cliente']['cpf']); ?>&nbsp;</td>
        </tr> 
        <tr>            
            <td><?php echo __('Cnpj'); ?></td>
            <td><?php echo h($cliente['Cliente']['cnpj']); ?>&nbsp;</td>
        </tr> 
        <tr>            
            <td><?php echo __('Site'); ?></td>
            <td><?php echo h($cliente['Cliente']['site']); ?>&nbsp;</td>
        </tr> 
        <tr>            
            <td><?php echo __('Tipo'); ?></td>
            <td><?php echo $cliente['Cliente']['ativo'] == 1 ? 'A Prazo' : 'A Vista'; ?>&nbsp;</td>
        </tr> 
        <tr>            
            <td><?php echo __('Ativo'); ?></td>
            <td><?php echo $cliente['Cliente']['ativo'] == 1 ? 'Ativo' : 'Desativado'; ?>&nbsp;</td>
        </tr> 
        <tr>            
            <td><?php echo __('Created'); ?></td>
            <td><?php echo h($cliente['Cliente']['created']); ?>&nbsp;</td>
        </tr> 
        <tr>            
            <td><?php echo __('Modified'); ?></td>
            <td><?php echo h($cliente['Cliente']['modified']); ?>&nbsp;</td>
        </tr> 
        <tr>            
            <td><?php echo __('Usuario'); ?></td>
            <td><?php echo $this->Html->link($cliente['Usuario']['nome'], array('controller' => 'usuarios', 'action' => 'view', $cliente['Usuario']['id'])); ?>&nbsp;</td>
        </tr> 
        <tr>            
            <td><?php echo __('Categoria'); ?></td>
            <td><?php echo $this->Html->link($cliente['Categoria']['nome'], array('controller' => 'categorias', 'action' => 'view', $cliente['Categoria']['id'])); ?>&nbsp;</td>
        </tr> 
        <tr>           
            <td><?php echo __('Unidade'); ?></td>
            <td><?php echo $this->Html->link($cliente['Unidade']['nome'], array('controller' => 'unidades', 'action' => 'view', $cliente['Unidade']['id'])); ?></td>
        </tr> 
    </table>
</div>
<hr />

<?php echo $this->Html->link('<i class="glyphicon glyphicon-arrow-left"></i> ' . 'Voltar', array('action' => 'index'), array('class' => 'btn btn-default', 'escape' => false)); ?>&nbsp;
<?php echo $this->Html->link('<i class="glyphicon glyphicon-ok"></i> ' . __('Cadastrar Novo'), array('action' => 'add'), array('class' => 'btn btn-success', 'escape' => false)); ?>&nbsp;
<?php echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i> ' . __('Editar'), array('action' => 'edit', $cliente['Cliente']['id']), array('class' => 'btn btn-warning', 'escape' => false)); ?>&nbsp;
<?php echo $this->Form->postLink('<i class="glyphicon glyphicon-remove"></i> ' . __('Deletar'), array('action' => 'delete', $cliente['Cliente']['id']), array('class' => 'btn btn-danger', 'escape' => false), __('Deseja deletar o Cliente?', $cliente['Cliente']['id'])); ?>&nbsp;