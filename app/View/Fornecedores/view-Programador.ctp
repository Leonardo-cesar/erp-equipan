<div class="niveis view">
    <h2><?php echo __('Fornecedores'); ?></h2>
    <table class="table table-hover table-bordered">
        <tr>
            <td><?php echo __('Id'); ?></td>
            <td><?php echo h($fornecedore['Fornecedore']['id']); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Nome'); ?></td>
            <td><?php echo h($fornecedore['Fornecedore']['nome']); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Telefone'); ?></td>
            <td><?php echo h($fornecedore['Fornecedore']['telefone']); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Contato'); ?></td>
            <td><?php echo h($fornecedore['Fornecedore']['contato']); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Cidade'); ?></td>
            <td><?php echo h($fornecedore['Fornecedore']['cidade']); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Insumo'); ?></td>
            <td><?php echo h($fornecedore['Fornecedore']['insumo']); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Qualificação'); ?></td>
            <td><?php echo $qu[$fornecedore['Fornecedore']['qualificacao']]; ?></td>
        </tr>
        <tr>
            <td><?php echo __('Observação'); ?></td>
            <td><?php echo h($fornecedore['Fornecedore']['observacao']); ?></td>
        </tr>
        <tr>
        <tr>
            <td><?php echo __('Ativo'); ?></td>
            <td><?php echo $fornecedore['Fornecedore']['ativo'] == 1 ? 'Ativo' : 'Desativado'; ?></td>
        </tr>
        <tr>
            <td><?php echo __('Criado as '); ?></td>
            <td><?php echo date("d/m/Y H:i:s", strtotime($fornecedore['Fornecedore']['created'])); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Modificado as'); ?></td>
            <td><?php echo date("d/m/Y H:i:s", strtotime($fornecedore['Fornecedore']['modified'])); ?></td>
        </tr>
    </table>
</div>
<hr />