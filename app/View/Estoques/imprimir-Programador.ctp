<h4 style="text-align: center;font-weight: bold">Unidade: <?php echo $unidade['Unidade']['nome'] ?></h4>
<hr />
<table class="table table-bordered">
    <thead>
        <tr>
            <th>nome</th>
            <th>Quantidade</th>
            <th>Minímo</th>
            <th>Valor UN</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php $total = 0.0 ?>
        <?php foreach ($estoques as $estoque) { ?>
            <tr>
                <td><?php echo $estoque['Produto']['nome'] ?>&nbsp;</td>
                <td>
                    <?php echo $estoque['Estoque']['quantidade']; ?>
                </td>
                <td><?php echo $estoque['Produto']['minimo']; ?>&nbsp;</td>
                <td><?php echo number_format($estoque['Produto']['valor'], 2, ',', '.'); ?>&nbsp;</td>
                <td><?php echo number_format($estoque['Estoque']['quantidade'] * $estoque['Produto']['valor'], 2, ',', '.'); ?>&nbsp;</td>
            </tr>
            <?php $total = ($estoque['Estoque']['quantidade'] * $estoque['Produto']['valor']) + $total ?>
        <?php } ?>
        <tr>
            <td  colspan="3"></td>
            <td style="font-weight: bold;">Total:</td>
            <td style="font-weight: bold;color:  red;">R$ <?php echo number_format($total, 2, ',', '.') ?>&nbsp;</td>
        </tr>
    </tbody>
</table>