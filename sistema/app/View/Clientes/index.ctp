<div class="niveis index">
    <h2><?php echo __('Clientes'); ?></h2>
    <?php echo $this->Html->link('<i class="glyphicon glyphicon-plus"></i> ' . __('Cadastrar Novo'), array('action' => 'add'), array('class' => 'btn btn-success', 'escape' => false)); ?>&nbsp;
    <br clear="all"/>
    <br clear="all"/>
    <?php echo $this->Session->flash('clientes') ?> 
    <table class="TableJquery">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>CPF/CNPJ</th>
                <th>Ações</th>
        </thead>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th>CPF/CNPJ</th>
                <th>Ações</th>
            </tr>
            <tr>
                <th colspan="5" class="ts-pager form-horizontal">
                    <button type="button" class="btn first"><i class="icon-step-backward glyphicon glyphicon-step-backward"></i></button>
                    <button type="button" class="btn prev"><i class="icon-arrow-left glyphicon glyphicon-backward"></i></button>
                    <span class="pagedisplay"></span> <!-- this can be any element, including an input -->
                    <button type="button" class="btn next"><i class="icon-arrow-right glyphicon glyphicon-forward"></i></button>
                    <button type="button" class="btn last"><i class="icon-step-forward glyphicon glyphicon-step-forward"></i></button>
                    <select class="pagesize input-mini" title="Select page size">
                        <option selected="selected" value="50">50</option>
                        <option value="100">100</option>
                        <option value="150">150</option>
                        <option value="200">200</option>
                    </select>
                    <select class="pagenum input-mini" title="Select page number"></select>
                </th>
            </tr>
        </tfoot>
        <tbody>
            <?php foreach ($clientes as $cliente) { ?>
                <tr>
                    <td><?php echo h($cliente['Cliente']['id']); ?>&nbsp;</td>
                    <td><?php echo h($cliente['Cliente']['nome']); ?>&nbsp;</td>
                    <td><?php echo $this->Html->link($cliente['Categoria']['nome'], array('controller' => 'categorias', 'action' => 'view', $cliente['Categoria']['id'])); ?>&nbsp;</td>
                    <td><?php echo $cliente['Cliente']['cpf'] ? $cliente['Cliente']['cpf'] : $cliente['Cliente']['cnpj']; ?>&nbsp;</td>
                    <td class="actions">
                        <?php echo $this->Html->link('<i class="glyphicon glyphicon-search"></i>', array('action' => 'view', $cliente['Cliente']['id']), array('type' => "button", 'class' => "btn btn-info btn-xs", 'escape' => FALSE)); ?>
                        <?php echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i>', array('action' => 'edit', $cliente['Cliente']['id']), array('type' => "button", 'class' => "btn btn-warning btn-xs", 'escape' => FALSE)); ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script>
    $(window).load(function () {
        table();
    });
</script>