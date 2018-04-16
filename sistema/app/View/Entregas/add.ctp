<div class="pedidos form">
    <fieldset>
        <legend>Entregar Pedido</legend>
        <div class="alert alert-success" role="alert" style="display: none;"><i class="glyphicon glyphicon-ok-sign"></i> Entrega concluída com sucesso!</div>
        <div class="form-group col-sm-6">
            <?php echo $this->Form->input('pedido', array('type' => 'text', 'label' => 'Digite o Pedido', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group col-sm-6">
            <?php echo $this->Form->input('placa', array('type' => 'text', 'label' => 'Digite a Placa', 'class' => 'form-control')); ?>
        </div>
        <div class="form-group col-sm-12">
            <a href="javascript:;" class="btn btn-success" id="pesquisarEntrega"><i class="glyphicon glyphicon-search"></i> Pesquisar</a>
        </div>
        <div id="entrega" style="display: none">
            <br clear="all" />
            <hr />
            <?php echo $this->Form->create('Entrega', array("class" => "form-horizontal")); ?>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('pedido_id', array('readonly', 'type' => 'text', 'label' => 'Pedido', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('nome', array('disabled', 'type' => 'text', 'label' => 'Nome', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-8">
                <?php echo $this->Form->input('observacaoPedido', array('disabled', 'type' => 'textarea', 'label' => 'Observação do Pedido', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
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
                            <th>Entregue</th>
                            <th>Paga</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <br clear="all" />
            <hr />
            <label class="tipo">Cadastrar Código de Barras</label>
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
            <p class="erro alert alert-danger" role="alert" id="erroCodigo" style="display: none"></p>
            <br clear="all" />
            <hr />
            <label class="tipo">Tipo de Pedido</label>
            <div id="tipoPedido"></div>
            <br clear="all" />
            <hr />
            <div class="form-group col-sm-12">
                <?php echo $this->Form->input('observacao', array('type' => 'textarea', 'div' => 'col-sm-6', 'label' => 'Observações', 'class' => 'form-control')); ?>
            </div>
            <br clear="all" />
            <hr />
            <div class="form-group col-sm-12" >
                <?php echo $this->Form->input('situacao', array('type' => 'select', 'options' => array('1' => 'Entregue', '0' => 'Em Aberto'), 'div' => 'col-sm-3', 'label' => 'Situação', 'class' => 'form-control')); ?>
                <span class='pentregue col-sm-12' style='display:none;color: red;font-weight: bold;font-size: 16px;'>Pedido entregue</span>
            </div>
            <div id="concluir" >
                <br clear="all" />
                <hr />
                <?php echo $this->Form->input('usuario_id', array('value' => $this->Session->read('Auth.User.id'), 'type' => 'hidden', 'label' => false, 'div' => false)); ?>
                <?php echo $this->Form->input('unidade_id', array('type' => 'hidden', 'label' => false, 'div' => false)); ?>
                <a href="javascript:;" class="btn btn-success" id="baixarEntrega"><i class="glyphicon glyphicon-road"></i> Concluir Entrega</a>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </fieldset>
</div>