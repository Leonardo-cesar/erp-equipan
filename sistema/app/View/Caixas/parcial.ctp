<div class="pedidos form">
    <fieldset>
        <legend>Baixar Pedido</legend>
        <div class="form-group col-sm-6">
            <?php echo $this->Form->input('placa', array('type' => 'text', 'label' => 'Digite a Placa', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group col-sm-6">
            <?php echo $this->Form->input('pedido', array('type' => 'hidden', 'label' => false, 'div' => false)); ?>
        </div>
        <div class="form-group col-sm-12">
            <a href="javascript:;" class="btn btn-success" id="pesquisarParcial"><i class="glyphicon glyphicon-search"></i> Pesquisar</a>
        </div>
        <br clear="all" />
        <p class="baixaParcial bg-danger" style="display: none"></p>
        <div id="caixa" style="display: none">
            <br clear="all" />
            <hr />
            <?php echo $this->Form->create('Caixa', array("class" => "form-horizontal", 'id' => 'CaixaIndexForm')); ?>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('pedido_id', array('disabled', 'type' => 'text', 'label' => 'Pedido', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('nome', array('readonly', 'type' => 'text', 'label' => 'Nome', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('documento', array('readonly', 'type' => 'text', 'label' => 'Categoria', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-8">
                <?php echo $this->Form->input('observacaoPedido', array('readonly', 'type' => 'textarea', 'label' => 'Observação do Pedido', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <br clear="all"/>
            <hr />
            <div class="form-group col-sm-12">
                <table class="table table-bordered table-hover table-striped tpedido" id="tableKit" style="margin-bottom: 0px">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Placa</th>
                            <th>Tarjeta</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2">
                    <div class="total">Total: <span class="stotal">R$ <?php echo $this->Form->input('valor', array('readonly', 'type' => 'text', 'label' => false, 'div' => false, 'style' => 'display: inline;width: 40%!important;')); ?></span></div><br />
                    </th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <br clear="all" />
            <hr />
            <label class="tipo">Tipo de Pedido</label>
            <div id="tipoPedido"></div>
            <br clear="all" />
            <hr />
            <div class="form-group col-sm-12">
                <?php echo $this->Form->input('desconto', array('type' => 'hidden')); ?>
                <?php echo $this->Form->input('dinheiro', array('div' => 'col-sm-2', 'label' => 'Dinheiro', 'class' => 'maskMoney form-control', 'empty' => '- Selecione o Método -')); ?>
                <?php echo $this->Form->input('cartaoCredito', array('div' => 'col-sm-2', 'label' => 'Cartão de Crédito', 'class' => 'maskMoney form-control', 'empty' => '- Selecione o Método -')); ?>
                <?php echo $this->Form->input('cartaoDebito', array('div' => 'col-sm-2', 'label' => 'Cartão de Débito', 'class' => 'maskMoney form-control', 'empty' => '- Selecione o Método -')); ?>
                <?php echo $this->Form->input('deposito', array('div' => 'col-sm-2', 'label' => 'Depósito', 'class' => 'maskMoney form-control', 'empty' => '- Selecione o Método -')); ?>
                <?php echo $this->Form->input('cheque', array('div' => 'col-sm-2', 'label' => 'Cheque', 'class' => 'maskMoney form-control', 'empty' => '- Selecione o Método -')); ?>
            </div>
            <div class="form-group col-sm-12">
                <?php echo $this->Form->input('observacao', array('type' => 'textarea', 'div' => 'col-sm-6', 'label' => 'Observações', 'class' => 'form-control')); ?>
            </div>
            <br clear="all" />
            <hr />
            <p class="bg-danger" style="display: none">O valor informado é diferente do valor total do pedido!</p>
            <?php echo $this->Form->input('valorTotal', array('type' => 'hidden', 'label' => false, 'div' => false)); ?>
            <?php echo $this->Form->input('kits_pedido_id', array('type' => 'hidden', 'label' => false, 'div' => false)); ?>
            <?php echo $this->Form->input('usuario_id', array('value' => $this->Session->read('Auth.User.id'), 'type' => 'hidden', 'label' => false, 'div' => false)); ?>
            <?php echo $this->Form->input('unidade_id', array('type' => 'hidden', 'label' => false, 'div' => false)); ?>
            <?php echo $this->Form->input('parcial', array('type' => 'hidden', 'value' => 1, 'label' => false, 'div' => false)); ?>
            <a href="javascript:;" class="btn btn-success" id="baixarCaixa"><i class="glyphicon glyphicon-usd"></i> Baixar</a>
            <?php echo $this->Form->end(); ?>
        </div>
    </fieldset>
</div>