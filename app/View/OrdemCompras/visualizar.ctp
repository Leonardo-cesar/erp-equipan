<style>
    .erro{
        font-weight: bold;
        text-transform: uppercase;
        color: red;
    }
</style>
<div class="pedidos form">
    <fieldset>
        <legend>Gerar Ordem de Compras</legend>
        <div class="cliente">
            <div class="form-group col-sm-12" style="text-align: center">
                <div class="col-sm-12">
                    <label>Numero</label><br />
                    <span class="erro" style="font-size: 20px;"><?php echo $data['OrdemCompra']['id'] ?></span>
                </div>
            </div>
            <div class="form-group col-sm-4">
                <div class="col-sm-12">
                    <label>Empresa</label><br />
                    <span class="erro"><?php echo $data['Fornecedore']['nome'] ?></span>
                </div>
            </div>
            <div class="form-group col-sm-4">
                <div class="col-sm-12">
                    <label>Cidade</label><br />
                    <span class="erro"><?php echo $data['Fornecedore']['cidade'] ?></span>
                </div>
            </div>
            <div class="form-group col-sm-4">
                <div class="col-sm-12">
                    <label>Contato</label><br />
                    <span class="erro"><?php echo $data['Fornecedore']['contato'] ?></span>
                </div>
            </div>
            <div class="form-group col-sm-4">
                <div class="col-sm-12">
                    <label>Email</label><br />
                    <span class="erro"><?php echo $data['Fornecedore']['email'] ?></span>
                </div>
            </div>
            <div class="form-group col-sm-4">
                <div class="col-sm-12">
                    <label>Telefone</label><br />
                    <span class="erro"><?php echo $data['Fornecedore']['telefone'] ?></span>
                </div>
            </div>
            <br clear="all"/>
            <hr />
            <div class="form-group col-sm-12">
                <table class="table table-bordered table-hover table-striped tpedido" id="tableKit" style="margin-left: 15px;">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Unidade</th>
                            <th>Quantidade</th>
                            <th>Valor</th>
                            <th>Total</th>
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
                                <td>R$: <?php echo number_format($OcProdutosOrdemCompra['quantidade'] * $OcProdutosOrdemCompra['valor'], 2, ',', '.') ?></td>
                            </tr>
                            <?php $tt = $tt + ($OcProdutosOrdemCompra['quantidade'] * $OcProdutosOrdemCompra['valor']) ?>
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
            </div>
            <br clear="all" />
            <hr />
            <div class="form-group col-sm-6">
                <label>Endereço</label><br />
                <span class="erro"><?php echo $data['OrdemCompra']['endereco'] ?></span>
            </div>
            <div class="form-group col-sm-6">
                <label>Comentário</label><br />
                <span class="erro"><?php echo $data['OrdemCompra']['comentarios'] ?></span>
            </div>
            <br clear="all" />
            <hr />
            <div class="form-group col-sm-6">
                <label>Condições de Pagamento</label><br />
                <span class="erro"><?php echo $data['OrdemCompra']['condicoes_pagamento'] ?></span>
            </div>
            <div class="form-group col-sm-3">
                <label>Moeda</label><br />
                <span class="erro"><?php echo $data['OrdemCompra']['moeda'] ?></span>
            </div>
            <br clear="all" />
            <hr />
            <?php if ($data['OrdemCompra']['avaliado'] == 1) { ?>
                <legend>Analise de Entrega</legend>
                <div class="form-group col-sm-4">
                    <label>Quantidade</label><br />
                    <span class="erro"><?php echo $q[$data['OrdemCompra']['quantidade']] ?></span>
                </div>
                <div class="form-group col-sm-4">
                    <label>Especificações</label><br />
                    <span class="erro" ><?php echo $b[$data['OrdemCompra']['especificacoes']] ?></span>
                </div>
                <div class="form-group col-sm-4">
                    <label>Especificações</label><br />
                    <span class="erro" ><?php echo $b[$data['OrdemCompra']['especificacoes']] ?></span>
                </div>
                <div class="form-group col-sm-4">
                    <label>Embalagem</label><br />
                    <span class="erro"><?php echo $b[$data['OrdemCompra']['embalagem']] ?></span>
                </div>
                <div class="form-group col-sm-4">
                    <label>Prazo</label><br />
                    <span class="erro" ><?php echo $b[$data['OrdemCompra']['prazo']] ?></span>
                </div>
                <div class="form-group col-sm-4">
                    <label>Data de Entrega</label><br />
                    <span class="erro" ><?php echo date('d/m/Y H:i:s', strtotime($data['OrdemCompra']['data_entrega'])) ?></span>
                </div>
                <div class="form-group col-sm-4">
                    <label>Data de Inspeção</label><br />
                    <span class="erro" ><?php echo date('d/m/Y H:i:s', strtotime($data['OrdemCompra']['data_inspecao'])) ?></span>
                </div>
                <div class="form-group col-sm-4">
                    <label>Causa Raiz de Atraso</label><br />
                    <span class="erro" ><?php echo $data['OrdemCompra']['causa_atrasos'] ?></span>
                </div>
            </div>
            <br clear="all" />
            <hr />
        <?php } ?>
        <?php echo $this->Html->link('<i class="glyphicon glyphicon-print"></i> Imprimir', array('action' => 'imprimir', $data['OrdemCompra']['id']), array('type' => "button", 'target' => '_blank', 'class' => "btn btn-info", 'escape' => FALSE)); ?>
    </fieldset>
</div>