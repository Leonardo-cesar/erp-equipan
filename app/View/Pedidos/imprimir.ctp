<?php if (count($data['KitsPedido']) == 1) { ?>
    <div class="col-sm-3">
        AS PLACAS SERAO ARMAZENADAS POR ATÉ 30(TRINTA) DIAS APÓS A DATA DO PEDIDO, APÓS ESSE PRAZO AS PLACAS SERÃO DESTRUIDAS<br />
        "ESTE PEDIDO NÃO TEM VALOR FISCAL"<br />
        ---------------------------------<br />
        EQUIPAN LDTA - <?php echo strtoupper($data['Unidade']['nome']) ?><br />
        <span class="col-sm-12" style="text-align: center">N. PEDIDO <?php echo $pedido ?></span><br />
        CLIENTE: <?php echo strtoupper($data['Cliente']['Nome']) ?><br />
        <?php if (array_key_exists('Representante', $data)) { ?>
            <?php if ($data['Representante']['Nome'] != null) { ?>
                REPRESENTANTE: <?php echo strtoupper($data['Representante']['Nome']) ?><br />
            <?php } ?>
        <?php } ?>
        OPERADOR: <?php echo strtoupper($data['Usuario']['nome']) ?><br />
        DATA DO PEDIDO: <?php echo date('d/m/Y H:i:s', strtotime($data['Pedido']['created'])); ?><br />
        TIPO DO PEDIDO: <?php echo $data['Pedido']['tipo'] == 0 ? 'À VISTA' : 'A RECEBER' ?> / VALOR: R$ <?php echo number_format($vTotal, 2, ',', '.'); ?><br />
        OBS.: <?php echo strtoupper($data['Pedido']['observacao']) ?><br />
        ----------------------------------<br />
        <?php foreach ($data['KitsPedido'] as $key => $KitsPedido) { ?>
            <?php echo $key != 0 ? '-----------------------------------------------------------------' . '<br />' : ' ' ?>
            <?php echo strtoupper($KitsPedido['Kit']['nome']) ?><br />
            *******************<br />
            <?php echo strtoupper($KitsPedido['placa']) ?> / <?php echo strtoupper($KitsPedido['tarjeta']) ?><br />
        <?php } ?>
        <br />
        <br />
        _________________________________<br />
        ASSINATURA<br />
        ----------------------------------<br />
        NÃO ACEITAMOS DEVOLUÇÕES OU RECLAMAÇÕES POSTERIORES<br />
    </div>
<?php } else { ?>
    <style>
        .col-sm-12{
            text-align: center
        }
        .col-sm-4{
            text-align: center
        }
    </style>
    <div class="col-sm-12" style="font-size: 11px;">
        <span class="col-sm-12" >AS PLACAS SERAO ARMAZENADAS POR ATÉ 30(TRINTA) DIAS APÓS A DATA DO PEDIDO, APÓS ESSE PRAZO AS PLACAS SERÃO DESTRUIDAS<br /></span>
        <span class="col-sm-12" >"ESTE PEDIDO NÃO TEM VALOR FISCAL"<br /><br /></span>
        <span class="col-sm-12" >EQUIPAN LDTA - <strong><?php echo strtoupper($data['Unidade']['nome']) ?></strong></span><br />
        <span class="col-sm-4" >N. PEDIDO <strong><?php echo $pedido ?></strong></span>
        <span class="col-sm-4" >CLIENTE: <strong><?php echo strtoupper($data['Cliente']['Nome']) ?></strong></span>
        <?php if (array_key_exists('Representante', $data)) { ?>
            <?php if ($data['Representante']['Nome'] != null) { ?>
                REPRESENTANTE: <?php echo strtoupper($data['Representante']['Nome']) ?><br />
            <?php } ?>
        <?php } ?>
        <span class="col-sm-4" >OPERADOR: <strong><?php echo strtoupper($data['Usuario']['nome']) ?></strong></span><br />
        <span class="col-sm-4" >DATA DO PEDIDO: <strong><?php echo date('d/m/Y H:i:s', strtotime($data['Pedido']['created'])); ?></strong></span>
        <span class="col-sm-4" >TIPO DO PEDIDO: <strong><?php echo $data['Pedido']['tipo'] == 0 ? 'À VISTA' : 'A RECEBER' ?></strong></span>
        <span class="col-sm-4" >VALOR: R$ <?php echo number_format($vTotal, 2, ',', '.'); ?></strong></span><br />
        <span class="col-sm-12" style="margin-bottom: 20px;">OBS.: <strong><?php echo strtoupper($data['Pedido']['observacao']) ?></strong></span>
        <table class="table table-bordered" style="font-size: 11px;">
            <tbody>
                <?php foreach ($data['KitsPedido'] as $key => $KitsPedido) { ?>
                    <tr>
                        <td><?php echo strtoupper($KitsPedido['Kit']['nome']) ?></td>
                        <td><?php echo strtoupper($KitsPedido['placa']) ?></td>
                        <td><?php echo strtoupper($KitsPedido['tarjeta']) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <br />
        <span class="col-sm-12" >_________________________________</span><br />
        <span class="col-sm-12" >ASSINATURA</span><br />
        <span class="col-sm-12" style="font-weight: bold">NÃO ACEITAMOS DEVOLUÇÕES OU RECLAMAÇÕES POSTERIORES</span>
    </div>
<?php } ?>