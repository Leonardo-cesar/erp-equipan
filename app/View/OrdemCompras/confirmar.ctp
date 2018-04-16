<div class="pedidos form">
    <?php echo $this->Form->create('OrdemCompra', array("class" => "form-horizontal", 'action' => 'cadastrar')); ?>
    <?php echo $this->Session->flash('OrdemCompra') ?> 
    <fieldset>
        <legend>Gerar Ordem de Compras</legend>
        <div class="cliente">
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('fornecedore_id', array('type' => 'hidden')); ?>
                <?php echo $this->Form->input('empresa', array('readonly', 'type' => 'text', 'label' => 'Empresa', 'div' => 'col-sm-12', 'class' => 'aFornecedor form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('cidade', array('readonly', 'type' => 'text', 'label' => 'Cidade', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('contato', array('readonly', 'type' => 'text', 'label' => 'Contato', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('email', array('readonly', 'type' => 'text', 'label' => 'E-mail', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('telefone', array('readonly', 'type' => 'text', 'label' => 'Telefone', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <br clear="all"/>
            <hr />
            <div class="form-group col-sm-12">
                <table class="table table-bordered table-hover table-striped tpedido" id="tableKit" style="margin-left: 15px;">
                    <thead>
                        <tr>
                            <th style="width: 6%;">#</th>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($this->request->data['OrdemCompra']['id'] as $key => $produto) { ?>
                            <tr>
                                <td><input name="OrdemCompras[id][]" readonly value="<?php echo $produto; ?>" ></td>
                                <td style="width: 45%;"><input name="OrdemCompras[Produto][]" readonly value="<?php echo $this->request->data['OrdemCompra']['Produto'][$key]; ?>" ></td>
                                <td><input name="OrdemCompras[quantidade][]" readonly value="<?php echo $this->request->data['OrdemCompra']['quantidade'][$key]; ?>" ></td>
                                <td><input name="OrdemCompras[valor][]" readonly value="<?php echo $this->request->data['OrdemCompra']['valor'][$key]; ?>" ></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <?php
                            if ($this->request->data['OrdemCompra']['taxas'] != '') {
                                $taxa = str_replace('.', '', $this->request->data['OrdemCompra']['taxas']);
                                $taxa = str_replace(',', '.', $taxa);
                            } else {
                                $taxa = 0.0;
                            }

                            if ($this->request->data['OrdemCompra']['frete'] != '') {
                                $frete = str_replace('.', '', $this->request->data['OrdemCompra']['frete']);
                                $frete = str_replace(',', '.', $frete);
                            } else {
                                $frete = 0.0;
                            }
                            ?>
                            <th colspan="2">
                                <div class="total">Taxa: <span class="stotal">R$ <?php echo number_format($taxa, 2, ',', '.') ?></span></div><br />
                                <div class="desconto">Frete: <span class="sdesconto">R$ <?php echo number_format($frete, 2, ',', '.') ?></span></div><br />
                                <div class="td">Total: <span class="std">R$ <?php echo number_format($this->request->data['OrdemCompra']['Vtotal'] + $frete + $taxa, 2, ',', '.') ?></span></div>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <br clear="all" />
            <hr />
            <div class="form-group col-sm-6">
                <?php echo $this->Form->input('endereco', array('readonly' ,'type' => 'textarea', 'label' => 'Endereço de entrega', 'rows' => '6', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-6">
                <?php echo $this->Form->input('comentarios', array('readonly', 'type' => 'textarea', 'label' => 'Comentários', 'rows' => '6', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <br clear="all" />
            <hr />
            <div class="form-group col-sm-6">
                <?php echo $this->Form->input('condicoes_pagamento', array('readonly', 'type' => 'text', 'label' => 'Condições de Pagamento', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-3">
                <?php echo $this->Form->input('moeda', array('readonly', 'type' => 'text', 'label' => 'Moeda', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <br clear="all" />
            <hr />
            <?php echo $this->Form->input('taxas', array('type' => 'hidden')); ?>
            <?php echo $this->Form->input('frete', array('type' => 'hidden')); ?>
            <?php echo $this->Form->end(); ?>
            <button class="btn btn-success"><i class="glyphicon glyphicon-shopping-cart"></i> Gerar Pedido</button>
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-minus"></i> ' . 'Limpar pedido', 'add', array('class' => "btn btn-danger", 'escape' => FALSE), __('Deseja realmente limpar o pedido?')); ?>
        </div>
    </fieldset>
</div>