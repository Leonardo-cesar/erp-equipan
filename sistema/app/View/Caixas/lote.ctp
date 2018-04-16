<div class="pedidos form">
    <fieldset>
        <legend>Baixar Pedido</legend>
        <?php echo $this->Form->create('Pesquisa'); ?>
        <div class="form-group col-sm-3">
            <?php echo $this->Form->input('dataInicial', array('type' => 'text', 'label' => 'Data de ínicio', 'class' => 'datepicker form-control')); ?>
        </div>
        <div class="form-group col-sm-3">
            <?php echo $this->Form->input('dataFinal', array('type' => 'text', 'label' => 'Data de Término', 'class' => 'datepicker form-control')); ?>
        </div>
        <div class="form-group col-sm-3">
            <?php echo count($UnidadesLogadas) > 1 || $this->Session->read('Auth.User.nivel_id') == 1 ? $this->Form->input('unidade_id', array('label' => 'Unidade', 'class' => 'obrigatorio form-control', 'empty' => ' - Selecione a Unidade -', 'options' => $UnidadesLogadas)) : $this->Form->input('unidade_id', array('label' => 'Unidade', 'class' => 'obrigatorio form-control', 'options' => $UnidadesLogadas)); ?>
        </div>
        <div class="form-group col-sm-3">
            <?php echo $this->Form->input('cliente_id', array('empty' => '-selecione-', 'label' => 'Cliente', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group col-sm-12">
            <a href="javascript:;" class="btn btn-success" id="pesquisarCaixaLote"><i class="glyphicon glyphicon-search"></i> Pesquisar</a>
        </div>
        <?php echo $this->Form->end(); ?>
        <?php echo $this->Form->create('Caixa'); ?>
        <br clear="all"/>
        <div class="alert alert-success alert-dismissible fade in col-sm-3" role="alert" style="display: none;"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>Baixa concluida com sucesso! </div>
        <div id="caixaLote" style="display: none">
            <br clear="all"/>
            <hr />
            <div class="form-group col-sm-12">
                <table class="table table-bordered table-hover table-striped tpedido" id="tabelaLote" style="margin-bottom: 0px">
                    <thead>
                        <tr>
                            <th style="width:5%;">#</th>
                            <th>Produto</th>
                            <th>Placa</th>
                            <th>Tarjeta</th>
                            <th>Observaçao</th>
                            <th>Data</th>
                            <th>Valor</th>
                            <th>P. Parcial</th>
                            <th>V. Parcial</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2">
                                <div class="total" style="font-size:16px;">Total: <span class="stotal">R$ <?php echo $this->Form->input('valor', array('readonly', 'type' => 'text', 'label' => false, 'div' => false, 'style' => 'display: inline;width: 40%!important;border: none;', 'id' => 'valor')); ?></span></div><br />
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <br clear="all" />
            <hr />
            <?php echo $this->Form->end(); ?>
            <?php echo $this->Form->create('Quitar'); ?>
            <div class="form-group col-sm-12">
                <?php echo $this->Form->input('desconto', array('div' => 'col-sm-4', 'label' => 'Desconto', 'class' => 'maskMoney form-control', 'empty' => '- Selecione o Método -')); ?>
            </div>
            <br clear="all" />
            <hr />
            <div class="form-group col-sm-12">
                <?php echo $this->Form->input('dinheiro', array('div' => 'col-sm-2', 'label' => 'Dinheiro', 'class' => 'maskMoney form-control')); ?>
                <?php echo $this->Form->input('cartaoCredito', array('div' => 'col-sm-2', 'label' => 'Cartão de Crédito', 'class' => 'maskMoney form-control')); ?>
                <?php echo $this->Form->input('cartaoDebito', array('div' => 'col-sm-2', 'label' => 'Cartão de Débito', 'class' => 'maskMoney form-control')); ?>
                <?php echo $this->Form->input('deposito', array('div' => 'col-sm-2', 'label' => 'Depósito', 'class' => 'maskMoney form-control')); ?>
                <?php echo $this->Form->input('cheque', array('div' => 'col-sm-2', 'label' => 'Cheque', 'class' => 'maskMoney form-control')); ?>
            </div>
            <div class="form-group col-sm-12">
                <?php echo $this->Form->input('observacao', array('type' => 'textarea', 'div' => 'col-sm-6', 'label' => 'Observações', 'class' => 'form-control')); ?>
            </div>
            <br clear="all" />
            <hr />
            <p class="bg-danger" style="display: none">O valor informado é diferente do valor total do Lote!<br /><strong><i class="vs"></i></strong></p>
            <?php echo $this->Form->input('total', array('id' => 'total', 'type' => 'hidden')) ?>
            <?php echo $this->Form->input('up', array('id' => 'up', 'type' => 'hidden')) ?>
            <?php echo $this->Form->input('usuario_id', array('value' => $this->Session->read('Auth.User.id'), 'type' => 'hidden', 'label' => false, 'div' => false)); ?>
            <?php echo $qu > 1 || $this->Session->read('Auth.User.nivel_id') == 1 ? $this->Form->input('unidade_id', array('type' => 'hidden', 'label' => false, 'div' => false)) : $this->Form->input('unidade_id', array('type' => 'hidden', 'label' => false, 'div' => false, 'value' => $unidades)) ?>
            <a href="javascript:;" class="btn btn-success" id="loteQuitar"><i class="glyphicon glyphicon-usd"></i> Baixar</a>
            <?php echo $this->Form->end(); ?>
        </div>
    </fieldset>
</div>