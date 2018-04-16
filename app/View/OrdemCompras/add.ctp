<div class="pedidos form">
    <?php echo $this->Form->create('OrdemCompra', array("class" => "form-horizontal", 'action' => 'confirmar')); ?>
    <?php echo $this->Session->flash('OrdemCompra') ?> 
    <fieldset>
        <legend>Gerar Ordem de Compras</legend>
        <div class="cliente">
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('fornecedore_id', array('type' => 'hidden')); ?>
                <?php echo $this->Form->input('empresa', array('type' => 'text', 'label' => 'Empresa', 'div' => 'col-sm-12', 'class' => 'aFornecedor form-control')); ?>
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
            <div class="form-group col-sm-5">
                <?php echo $this->Form->input('kit', array('label' => 'Produtos', 'div' => 'col-sm-12', 'class' => 'form-control', 'type' => 'select', 'options' => $produtos, 'empty' => '-- Selecione o Produto --')); ?>
            </div>
            <div class="form-group col-sm-2">
                <?php echo $this->Form->input('quantidade', array('type' => 'text', 'label' => 'Quantidade', 'div' => 'col-sm-12', 'class' => 'form-control', 'style' => 'text-transform:uppercase')); ?>
            </div>
            <div class="form-group col-sm-2">
                <?php echo $this->Form->input('valor', array('type' => 'text', 'label' => 'Valor', 'div' => 'col-sm-12', 'class' => 'maskMoney form-control')); ?>
            </div>
            <div class="form-group col-sm-1" style="margin-top: 25px;">
                <a href="javascript:;" class="btn btn-success" id="addProduto" ><i class="glyphicon glyphicon-plus"></i> Adicionar</a>
            </div>
            <br clear="all"/>
            <div class="form-group col-sm-12">
                <table class="table table-bordered table-hover table-striped tpedido" id="tableKit" style="display: none;margin-left: 15px;">
                    <thead>
                        <tr>
                            <th style="width: 6%;">#</th>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Valor</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <?php echo $this->Form->input('Vtotal', array('type' => 'hidden', 'value' => '0.0')); ?>
                            <th colspan="2">Total: R$ <div id="total" style="display: inline;">00,00</div></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <br clear="all" />
            <hr />
            <div class="form-group col-sm-6">
                <?php echo $this->Form->input('endereco', array('type' => 'textarea', 'label' => 'Endereço de entrega', 'rows' => '6', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-6">
                <?php echo $this->Form->input('comentarios', array('type' => 'textarea', 'label' => 'Comentários', 'rows' => '6', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <br clear="all" />
            <hr />
            <div class="form-group col-sm-6">
                <?php echo $this->Form->input('condicoes_pagamento', array('type' => 'text', 'label' => 'Condições de Pagamento', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-3">
                <?php echo $this->Form->input('moeda', array('type' => 'text', 'label' => 'Moeda', 'div' => 'col-sm-12', 'class' => 'form-control', 'value' => 'R$')); ?>
            </div>
            <br clear="all" />
            <hr />
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('taxas', array('type' => 'text', 'label' => 'Taxas', 'div' => 'col-sm-12', 'class' => 'maskMoney form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('frete', array('type' => 'text', 'label' => 'Frete', 'div' => 'col-sm-12', 'class' => 'maskMoney form-control')); ?>
            </div>
            <?php echo $this->Form->end(); ?>
            <br clear="all" />
            <hr />
            <button class="btn btn-success"><i class="glyphicon glyphicon-shopping-cart"></i> Gerar Pedido</button>
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-minus"></i> ' . 'Limpar pedido', 'add', array('class' => "btn btn-danger", 'escape' => FALSE), __('Deseja realmente limpar o pedido?')); ?>
        </div>
    </fieldset>
</div>