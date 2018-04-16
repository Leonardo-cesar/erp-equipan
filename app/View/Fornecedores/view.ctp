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