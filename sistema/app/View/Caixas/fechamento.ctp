<div class="pedidos form">
    <fieldset>
        <legend>Fechamento de Caixa</legend>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('dataInicial', array('type' => 'text', 'label' => 'De', 'class' => 'datepicker form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('dataFinal', array('type' => 'text', 'label' => 'Até', 'class' => 'datepicker form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo count($UnidadesLogadas) > 1 || $this->Session->read('Auth.User.nivel_id') == 1 ? $this->Form->input('unidade_id', array('label' => 'Unidade', 'class' => 'obrigatorio form-control', 'empty' => ' - Selecione a Unidade -', 'options' => $UnidadesLogadas)) : $this->Form->input('unidade_id', array('style' => 'display:none', 'label' => false, 'div' => 'false', 'options' => $UnidadesLogadas)); ?>
        </div>
        <button type="submit" class="btn btn-success" id="fechamentoCaixa"><i class="glyphicon glyphicon-refresh"></i> Gerar Fechamento</button>
        <br clear="all"/>
        <hr />
        <div class="divF form-group col-sm-12" style="display: none">
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-print"></i> Imprimir', '/caixas/fimprimir/', array('escape' => false, 'class' => 'btn btn-primary', 'target' => '_blank')) ?>
            <br />
            <br />
            <table class="table table-bordered table-hover table-striped tpedido" id="tablefechamento" style="margin-bottom: 0px">
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
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Totais</th>
                        <th id="tDinheiro"></th>
                        <th id="tCheque"></th>
                        <th id="tDebito"></th>
                        <th id="tCredito"></th>
                        <th id="tDeposito"></th>
                        <th id="tDesconto"></th>
                        <th id="tTotal"></th>
                        <th id="tTotalcDe"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </fieldset>
</div>