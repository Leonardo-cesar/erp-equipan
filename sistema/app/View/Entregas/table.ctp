<?php if ($data['Producao'] == TRUE) { ?>
    <tr>
        <td class="col-sm-12"  colspan='2'>
            <span class="col-sm-5" style="font-weight: bold;" >Produto</span>
            <span class="col-sm-3" style="font-weight: bold;" >Tarjeta</span>
            <span class="col-sm-3" style="font-weight: bold;" >Placa</span>
        </td>
    </tr>
    <?php foreach ($data['Producao'] as $pedido => $pr) { ?>
        <tr>
            <td class="col-sm-10">
                <?php foreach ($pr as $prod) { ?>
                    <span class="col-sm-6"><?php echo strtoupper($prod['KitsPedido']['kit']) ?></span>
                    <span class="col-sm-4"><?php echo strtoupper($prod['KitsPedido']['tarjeta']) ?></span>
                    <span class="col-sm-2" style="font-weight: bold;" >
                        <?php echo strtoupper($prod['KitsPedido']['placa']) ?>&nbsp;&nbsp;&nbsp;
                        <?php echo $this->Html->link('<i class="glyphicon glyphicon-ok"></i>', 'javascript:;', array('id' => $pedido, 'escape' => false, 'class' => 'concluir btn btn-success btn-xs')) ?>
                    </span>
                    <br />
                    <br />
                <?php } ?>
            </td>
            <td class="col-sm-2">
                <span class="col-sm-4"><?php echo $pedido ?></span>
                <span class="col-sm-2"><?php echo $this->Html->link('<i class="glyphicon glyphicon-ok"></i>', 'javascript:;', array('id' => $pedido, 'escape' => false, 'class' => 'concluir btn btn-success btn-xs')) ?></span>
            </td>
        </tr>
    <?php } ?>
<?php } else { ?>
    <tr>
        <td><div class="alert alert-success" style="text-align: center" role="alert">Nenhuma foi placa pendente!</div></td>
    </tr>
<?php } ?>
