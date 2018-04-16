<?php if ($data['Producao'] == TRUE) {
    foreach ($data['Producao'] as $pr) {
        ?>
        <tr>
            <td><?php echo strtoupper($pr['Kit']['nome']) ?></td>
            <td style="font-weight: bold;" ><?php echo strtoupper($pr['KitsPedido']['placa']) ?></td>
            <td><?php echo strtoupper($pr['KitsPedido']['tarjeta']) ?></td>
            <td><?php echo $this->Html->link('<i class="glyphicon glyphicon-ok"></i>', 'javascript:;', array('id' => $pr['KitsPedido']['id'], 'escape' => false, 'class' => 'concluir btn btn-success btn-xs')) ?>&nbsp;<?php echo $this->Html->link('<i class="glyphicon glyphicon-remove"></i>', 'javascript:;', array('id' => $pr['KitsPedido']['id'], 'escape' => false, 'class' => 'cancelar btn btn-danger btn-xs')) ?></td>
        </tr>
    <?php }
} else {
    ?>
    <tr>
        <td><div class="alert alert-success" style="text-align: center" role="alert">Nenhuma foi placa pendente!</div></td>
    </tr>
<?php } ?>

<?php if ($data['Atualiza'] == TRUE) { ?>
    <script>
        beepThree.pause();
        beepThree.play();
    </script>
<?php } ?>