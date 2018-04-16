<h4 style="text-align: center;font-weight: bold">Unidade: <?php echo $unidade['Unidade']['nome'] ?></h4>
<hr />
<table class="table table-bordered">
    <thead>
        <tr>
            <th>nome</th>
            <th>Quantidade</th>
            <th>Minímo</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($estoques as $estoque) { ?>
            <tr>
                <td><?php echo $estoque['Produto']['nome'] ?>&nbsp;</td>
                <td>
                    <?php echo $estoque['Estoque']['quantidade']; ?>
                </td>
                <td><?php echo $estoque['Produto']['minimo']; ?>&nbsp;</td>
            </tr>
        <?php } ?>
    </tbody>
</table>