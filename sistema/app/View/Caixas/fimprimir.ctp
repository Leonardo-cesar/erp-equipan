<h4 style="text-align: center;font-weight: bold">Período: <?php echo date('d/m/Y', strtotime($this->Session->read('Caixa.fechamento.de'))) ?> à <?php echo date('d/m/Y', strtotime($this->Session->read('Caixa.fechamento.ate'))) ?> </h3>
<h4 style="text-align: center;font-weight: bold">Unidade: <?php echo $unidade['Unidade']['nome'] ?></h3>
<hr />
<table class="table table-bordered" >
    <thead>
        <tr>
            <th>Pedido/Placa</th>
            <th>Dinheiro</th>
            <th>Cheque</th>
            <th>C. Débito</th>
            <th>C. Crédito</th>
            <th>Depósito</th>
            <th>Desconto</th>
            <th>Total</th>
            <th>Total C/ Desconto</th>
        </tr>
    </thead>
    <?php
    $Tdinheiro = 0;
    $Tcheque = 0;
    $TcartaoDebito = 0;
    $TcartaoCredito = 0;
    $Tdeposito = 0;
    $Tdesconto = 0;
    $Tvalor = 0;
    ?>
    <tbody>
        <?php foreach ($data as $pedido) { ?>
            <tr>
                <?php $pl = $pedido['KitsPedido']['Placa'] != '' ? $pedido['KitsPedido']['Placa'] : ' - BAIXA EM LOTE - ' ?>
                <td><?php echo $pedido['Caixa']['pedido_id'] != '' ? $pedido['Caixa']['pedido_id'] : $pl ?></td>
                <td><?php echo $pedido['Caixa']['dinheiro'] != '' ? number_format($pedido['Caixa']['dinheiro'], 2, ',', '.') : ' - ' ?></td>
                <td><?php echo $pedido['Caixa']['cheque'] != '' ? number_format($pedido['Caixa']['cheque'], 2, ',', '.') : ' - ' ?></td>
                <td><?php echo $pedido['Caixa']['cartaoDebito'] != '' ? number_format($pedido['Caixa']['cartaoDebito'], 2, ',', '.') : ' - ' ?></td>
                <td><?php echo $pedido['Caixa']['cartaoCredito'] != '' ? number_format($pedido['Caixa']['cartaoCredito'], 2, ',', '.') : ' - ' ?></td>
                <td><?php echo $pedido['Caixa']['deposito'] != '' ? number_format($pedido['Caixa']['deposito'], 2, ',', '.') : ' - ' ?></td>
                <td><?php echo $pedido['Caixa']['desconto'] != '' ? number_format($pedido['Caixa']['desconto'], 2, ',', '.') : ' - ' ?></td>
                <td><?php echo $pedido['Caixa']['valor'] != '' ?  number_format($pedido['Caixa']['valor'], 2, ',', '.') : ' - ' ?></td>
                <td><?php echo $pedido['Caixa']['valor'] != '' ?  number_format($pedido['Caixa']['valor'] - $pedido['Caixa']['desconto'], 2, ',', '.') : ' - ' ?></td>
            </tr>
            <?php $Tdinheiro = $Tdinheiro + $pedido['Caixa']['dinheiro']; ?>
            <?php $Tcheque = $Tcheque + $pedido['Caixa']['cheque']; ?>
            <?php $TcartaoDebito = $TcartaoDebito + $pedido['Caixa']['cartaoDebito']; ?>
            <?php $TcartaoCredito = $TcartaoCredito + $pedido['Caixa']['cartaoCredito']; ?>
            <?php $Tdeposito = $Tdeposito + $pedido['Caixa']['deposito']; ?>
            <?php $Tdesconto = $Tdesconto + $pedido['Caixa']['desconto']; ?>
            <?php $Tvalor = $Tvalor + ($pedido['Caixa']['valor']); ?>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Totais</th>
            <th id="tDinheiro"><?php echo $Tdinheiro != '' ? number_format($Tdinheiro, 2, ',', '.') : ' - ' ?></th>
            <th id="tCheque"><?php echo $Tcheque != '' ? number_format($Tcheque, 2, ',', '.') : ' - ' ?></th>
            <th id="tDebito"><?php echo $TcartaoDebito != '' ? number_format($TcartaoDebito, 2, ',', '.') : ' - ' ?></th>
            <th id="tCredito"><?php echo $TcartaoCredito != '' ? number_format($TcartaoCredito, 2, ',', '.') : ' - ' ?></th>
            <th id="tDeposito"><?php echo $Tdeposito != '' ? number_format($Tdeposito, 2, ',', '.') : ' - ' ?></th>
            <th id="tDesconto"><?php echo $Tdesconto != '' ? number_format($Tdesconto, 2, ',', '.') : ' - ' ?></th>
            <th id="tTotal"><?php echo $Tvalor != '' ? number_format($Tvalor, 2, ',', '.') : ' - ' ?></th>
            <th id="tTotal"><?php echo $Tvalor != '' ? number_format($Tvalor - $Tdesconto, 2, ',', '.') : ' - ' ?></th>
        </tr>
    </tfoot>
</table>