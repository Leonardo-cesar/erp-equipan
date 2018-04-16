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
            <?php echo $this->Form->create('OrdemCompra', array("class" => "form-horizontal")); ?>
            <legend>Analise de Entrega</legend>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => $data['OrdemCompra']['id'])); ?>
                <?php echo $this->Form->input('avaliado', array('type' => 'hidden', 'value' => 1)); ?>
                <?php echo $this->Form->input('quantidade', array('type' => 'select', 'label' => 'Quantidade', 'div' => 'col-sm-12', 'class' => 'aFornecedor form-control', 'empty' => ' - Selecione -', 'options' => array('0' => 'Correta', '1' => 'Errada'))); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('especificacoes', array('type' => 'select', 'label' => 'Especificações', 'div' => 'col-sm-12', 'class' => 'form-control', 'empty' => ' - Selecione -', 'options' => array('0' => 'Ruim', '1' => 'Regular', '2' => 'Bom', '3' => 'Otimo'))); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('qualidade', array('type' => 'select', 'label' => 'Qualidade', 'div' => 'col-sm-12', 'class' => 'form-control', 'empty' => ' - Selecione -', 'options' => array('0' => 'Ruim', '1' => 'Regular', '2' => 'Bom', '3' => 'Otimo'))); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('embalagem', array('type' => 'select', 'label' => 'embalagem', 'div' => 'col-sm-12', 'class' => 'form-control', 'empty' => ' - Selecione -', 'options' => array('0' => 'Ruim', '1' => 'Regular', '2' => 'Bom', '3' => 'Otimo'))); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('prazo', array('type' => 'select', 'label' => 'Prazo', 'div' => 'col-sm-12', 'class' => 'form-control', 'empty' => ' - Selecione -', 'options' => array('0' => 'Ruim', '1' => 'Regular', '2' => 'Bom', '3' => 'Otimo'))); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('data_entrega', array('type' => 'text', 'label' => 'Data de Entrega', 'div' => 'col-sm-12', 'class' => 'datepicker form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('data_inspecao', array('type' => 'text', 'label' => 'Data de Inspeção', 'div' => 'col-sm-12', 'class' => 'datepicker form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('causa_atrasos', array('type' => 'textarea', 'label' => 'Causa Raiz de Atraso', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <br clear="all"/>
            <hr />
            <button class="btn btn-success"><i class="glyphicon glyphicon-refresh"></i> Avaliar</button>
            <?php echo $this->Form->end(); ?>
        </div>
    </fieldset>
</div>