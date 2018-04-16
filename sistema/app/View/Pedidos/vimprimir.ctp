<h4 style="text-align: center;font-weight: bold">Período: <?php echo date("d/m/Y", strtotime($this->request->data['Pedidos']['dataInicial'])) ?> à <?php echo date("d/m/Y", strtotime($this->request->data['Pedidos']['dataFinal'])) ?> </h4>
<h4 style="text-align: center;font-weight: bold">Unidade: <?php echo $unidade ?></h4>
<hr />
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Usuário</th>
            <th>Venda</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $pedido) { ?>
            <tr>
                <td><?php echo $pedido['usuario'] ?></td>
                <td>R$ <?php echo number_format($pedido['valor'], 2, ',', '.') ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>