<style>
    body{
            padding: 20px;
    }
</style>
<div class="col-sm-12" style="font-size: 14px; background: #f3f1f1;border: 1px solid;padding: 20px;">
    <span class="col-sm-6" ><strong>Numero: <?php echo strtoupper($data['OrdemCompra']['id']) ?></strong> </span>
    <br clear="all" />
    <span class="col-sm-6" ><strong>Fornecedor: <?php echo strtoupper($data['Fornecedore']['nome']) ?></strong> </span>
    <span class="col-sm-6" ><strong>Contato: <?php echo strtoupper($data['Fornecedore']['contato']) ?></strong> </span>
    <span class="col-sm-6" ><strong>Cidade: <?php echo strtoupper($data['Fornecedore']['cidade']) ?></strong> </span>
    <span class="col-sm-6" ><strong>Telefone: <?php echo strtoupper($data['Fornecedore']['telefone']) ?></strong> </span>
    <span class="col-sm-6" ><strong>Email: <?php echo strtoupper($data['Fornecedore']['email']) ?></strong> </span>
     <br clear="all" />
    <span class="col-sm-6" ><strong>Condição de pagamento: <?php echo strtoupper($data['OrdemCompra']['condicoes_pagamento']) ?></strong> </span>
    <span class="col-sm-6" ><strong>Comprador: <?php echo strtoupper($data['Usuario']['nome']) ?></strong> </span> 
    <br clear="all" />
    <span class="col-sm-6" style="text-align: center"><strong>Local de Entrega: <br /><?php echo strtoupper($data['OrdemCompra']['endereco']) ?></strong> </span>
    <span class="col-sm-6" style="text-align: center"><strong>Observação: <br /><?php echo strtoupper($data['OrdemCompra']['comentarios']) ?></strong> </span>
    <br>
    <table class="table table-bordered" style="font-size: 11px;">
        <thead>
        <tr>
            <td><b>Descrição</b></td>
            <td><b>Unidade</b></td>
            <td><b>Quantidade</b></td>
            <td><b>Valor</b></td>
            <td><b>Total</b></td>
        </tr>
        </thead>
        <tbody>
            <?php $tt = 0.0 ?>
            <?php foreach ($data['OcProdutosOrdemCompra'] as $key => $OcProdutosOrdemCompra) { ?>
                <tr>
                    <td><?php echo strtoupper($OcProdutosOrdemCompra['OcProduto']['descricao']) ?></td>
                    <td><?php echo strtoupper($OcProdutosOrdemCompra['OcProduto']['unidade']) ?></td>
                    <td><?php echo strtoupper($OcProdutosOrdemCompra['quantidade']) ?></td>
                    <td>R$: <?php echo number_format($OcProdutosOrdemCompra['valor'], 2, ',', '.') ?></td>
                    <td>R$: <?php echo number_format($OcProdutosOrdemCompra['quantidade']*$OcProdutosOrdemCompra['valor'], 2, ',', '.') ?></td>
                </tr>
                 <?php $tt = $tt + ($OcProdutosOrdemCompra['quantidade']*$OcProdutosOrdemCompra['valor']) ?>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" style="text-align: right">
                    <b>Total Produtos: <?php echo number_format($tt, 2, ',', '.') ?></b><br />
                    <b>Frete: <?php echo number_format($data['OrdemCompra']['frete'], 2, ',', '.') ?></b><br />
                    <b>Taxas: <?php echo number_format($data['OrdemCompra']['taxas'], 2, ',', '.') ?></b><br />
                    <b>Total Geral: <?php echo number_format($data['OrdemCompra']['taxas'] + $data['OrdemCompra']['frete'] + $tt, 2, ',', '.') ?></b><br />
                </td>
            </tr>
        </tfoot>
    </table>
    <br />
    <span style="text-align: right" class="col-sm-12" >_________________________________  / ______________________</span><br />
    <span style="float: right;margin-right: 143px;text-align: right;" class="col-sm-12" >ASSINATURA / Data</span><br />
</div>
<br clear="all" />