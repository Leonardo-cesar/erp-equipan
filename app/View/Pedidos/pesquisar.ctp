<div class="pedidos form">
    <fieldset>
        <legend>Pesquisar Pedido</legend>
        <?php echo $this->Session->flash('pesquisar') ?> 
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('pedido', array('type' => 'text', 'label' => 'Digite o Pedido', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('placa', array('type' => 'text', 'label' => 'Digite a Placa', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group col-sm-12">
            <a href="javascript:;" class="btn btn-success" id="pesquisarPedido"><i class="glyphicon glyphicon-search"></i> Pesquisar</a>
        </div>
        <br clear="all" />
        <p class="naoEncontrado bg-danger" style="display: none"></p>
        <div id="Pesquisar" style="display: none">
            <br clear="all"/>
            <hr />
            <p class="tituloLancamento col-sm-12">Número do Pedido</p>
            <span class="numeroLancamento col-sm-12" id="numeroPedido"></span>
            <br clear="all"/>
            <hr />
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('nome', array('disabled', 'type' => 'text', 'label' => 'Nome', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('categoria', array('disabled', 'type' => 'text', 'label' => 'Categoria', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
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
                            <th>Renavan</th>
                            <th>Autorização</th>
                            <th>P.Parcial</th>
                            <th>V.Parcial</th>
                            <th>Entregue</th>
                            <th>Paga</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2">
                    <div class="total">Total: <span class="stotal"></span></div><br />
                    <div class="desconto">Desconto: <span class="sdesconto"></span></div><br />
                    <div class="td">Total com Desconto: <span class="std"></span></div>
                    </th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <br clear="all" />
            <hr />
            <label class="tipo">Código de Barras</label>
            <div class="form-group col-sm-12">
                <table class="table table-bordered table-hover table-striped tpedido" id="tableCodigo" style="margin-bottom: 0px">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Placa</th>
                            <th>Placa Dianteira</th>
                            <th>Placa Traseira</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <br clear="all" />
            <hr />
            <label class="tipo">Tipo de Pedido</label>
            <div id="tipoPedido"></div>
            <br clear="all" />
            <hr />
            <label class="tipo">Histórico do Pedido</label>
            <br clear="all" />
            <div class="col-sm-12">
                <div class="col-sm-4">
                    <b>Pedido</b>
                    <br>
                    <span class="pb">Gerado por:</span> <span class="pg" id="pus"></span>
                    <br />
                    <span class="pb">Data:</span> <span class="pg" id="pda"></span>
                    <br />
                    <span class="pb">Na Unidade:</span> <span class="pg" id="pun"></span>
                    <br />
                    <span class="pb">Observação:</span> <span class="pg" id="pob"></span>
                </div>
                <div class="col-sm-4">
                    <b>Caixa</b>
                    <br>
                    <div class="caixa" style="display: none">
                        <span class="pb">Quitado por:</span> <span class="pr" id="cQ"></span>
                        <br />
                        <span class="pb">Data:</span> <span class="pr" id="cD"></span>
                        <br />
                        <span class="pb">Na Unidade:</span> <span class="pr" id="cU"></span>
                        <br />
                        <span class="pb">Observação:</span> <span class="pr" id="cO"></span>
                    </div>
                    <div class="Ncaixa" style="display: none"><span class="pr">Ainda não foi pago</span></div>
                </div>
                <div class="col-sm-4">
                    <b>Entrega</b>
                    <br>
                    <div class="entregue" style="display: none">
                        <span class="pb">Entregue por:</span> <span class="pg" id="eU"></span>
                        <br />
                        <span class="pb">Data:</span> <span class="pg" id="eD"></span>
                        <br />
                        <span class="pb">Na Unidade:</span> <span class="pg" id="eUn"></span>
                        <br />
                        <span class="pb">Observação:</span> <span class="pg" id="eOb"></span>
                    </div>
                    <div class="Nentregue" style="display: none"><span class="pr">Ainda não foi entregue</span></div>
                </div>
            </div>
            <br clear="all" />
            <hr />
            <div class="PedidoExcluido alert alert-danger" role="alert" style="display: none;"><p style="font-weight: bold;font-size: 20px;">Esse pedido foi excluido!</p><p class="data"></p><p class="motivo"></p></div>
            <div class="PedidoCancelado alert alert-warning" role="alert" style="display: none;"><p style="font-weight: bold;font-size: 20px;">Esse pedido foi cancelado!</p><p class="dataC"></p><p class="motivoC"></p></div>
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-ok-sign"></i> Concluir Pedido', '', array('escape' => false, 'class' => 'concluir btn btn-success', 'style' => 'display:none;', 'target' => '_blank')) ?>
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-print"></i> Reimprimir', '', array('escape' => false, 'class' => 'imprimir btn btn-primary', 'target' => '_blank')) ?>
            <?php if ($this->Session->read('Auth.User.nivel_id') == 1) { ?>
                <?php echo $this->Html->link('<i class="glyphicon glyphicon-remove"></i> Excluir', '', array('escape' => false, 'class' => 'excluir btn btn-danger')) ?>
                <?php echo $this->Html->link('<i class="glyphicon glyphicon-ban-circle"></i> Cancelar', '', array('escape' => false, 'class' => 'cancelar btn btn-warning')) ?>
            <?php } ?>
        </div>
        <div id="placasM" style="display: none">
            <br clear="all"/>
            <hr />
            <label class="tipo" style="width: 100%;color: red;text-align: center;font-size: 16px;">Está Placa esta em mais de um pedido</label>
            <div class="form-group col-sm-12">
                <table class="table table-bordered table-hover table-striped tpedido" id="tablePlaca" style="margin-bottom: 0px">
                    <thead>
                        <tr>
                            <th>Pedido</th>
                            <th>Placa</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </fieldset>
</div>