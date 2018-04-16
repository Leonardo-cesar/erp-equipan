<div class="pedidos form">
    <?php echo $this->Form->create('Pedido', array("class" => "form-horizontal", 'action' => 'confirmar')); ?>
    <?php echo $this->Session->flash('pedido') ?> 
    <fieldset>
        <legend>Gerar Pedido</legend>
        <div class="form-group col-sm-12">
            <?php echo $this->Form->input('cliente', array('type' => 'text', 'label' => 'Selecione o Cliente', 'div' => 'col-sm-5', 'class' => 'bCliente form-control')); ?>
            <?php echo count($UnidadesLogadas) > 1 || $this->Session->read('Auth.User.nivel_id') == 1 ? $this->Form->input('unidade_id', array('label' => 'Unidade', 'div' => 'col-sm-4', 'class' => 'obrigatorio form-control', 'empty' => ' - Selecione a Unidade -', 'options' => $UnidadesLogadas)) : $this->Form->input('unidade_id', array('style' => 'display:none', 'label' => false, 'div' => 'false', 'options' => $UnidadesLogadas)); ?>
        </div>
        <div class="cliente" style="display: none;">
            <br clear="all"/>
            <hr />
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('cliente_id', array('readonly', 'type' => 'text', 'label' => 'Número', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('nome', array('readonly', 'type' => 'text', 'label' => 'Nome', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('cpf', array('readonly', 'type' => 'text', 'label' => 'CPF / CNPJ', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('telefone', array('readonly', 'type' => 'text', 'label' => 'Telefone', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('email', array('readonly', 'type' => 'text', 'label' => 'E-mail', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('categoria', array('readonly', 'type' => 'text', 'label' => 'Categoria', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <?php echo $this->Form->input('categoria_id', array('disabled', 'type' => 'hidden', 'label' => false, 'div' => false)); ?>
            <br clear="all"/>
            <hr />
            <div class="dv-repre">
                <label style="color: red;font-size: 18px"><i>Representantes</i></label>
                <div class="dv-representantes"></div>
                <br clear="all"/>
                <hr />
            </div>
            <div class="form-group col-sm-6">
                <?php echo $this->Form->input('kit', array('label' => 'Kits', 'div' => 'col-sm-12', 'class' => 'form-control', 'type' => 'select', 'options' => $kits, 'empty' => '-- Selecione o KIT --')); ?>
            </div>
            <br clear="all"/>
            <div class="alert alert-danger feita" role="alert" style="display: none">
                <b>Ops!</b><br />A placa <b id="tplaca"></b> já foi geradada no dia <b id="tdata"></b> na unidade <b id="tloja"></b>!<br />Por Favor insira a senha de coordenador para liberar a venda!
                <br />
                <?php echo $this->Form->input('usuario', array('label' => false, 'div' => 'col-sm-2', 'class' => 'form-control', 'type' => 'text')); ?>
                <?php echo $this->Form->input('senha', array('label' => false, 'div' => 'col-sm-2', 'class' => 'form-control', 'type' => 'password')); ?>
                <button type="button" class="btn btn-success col-sm-1" id="liberarVenda">Liberar</button>
                <br clear="all"/>
            </div>
            <div class="form-group col-sm-3">
                <?php echo $this->Form->input('placa', array('type' => 'text', 'label' => 'Placa', 'div' => 'col-sm-12', 'class' => 'form-control', 'style' => 'text-transform:uppercase', 'disabled' => "disabled")); ?>
            </div>
            <div class="form-group col-sm-3">
                <?php echo $this->Form->input('tarjeta', array('type' => 'text', 'label' => 'Tarjeta', 'div' => 'col-sm-12', 'class' => 'form-control', 'style' => 'text-transform:uppercase', 'disabled' => "disabled")); ?>
            </div>
            <div class="form-group col-sm-3">
                <?php echo $this->Form->input('valor', array('readonly', 'type' => 'text', 'label' => 'Valor', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-3" style="margin-top: 25px;">
                <a href="javascript:;" class="btn btn-success" id="addkitPedido" style='display:none;' disabled><i class="glyphicon glyphicon-plus"></i> Adicionar</a>
            </div>
            <br clear="all"/>
            <div class="alert alert-warning" role="alert" id="mEstoque" style="display: none">
                <ul></ul>
            </div>
            <div class="form-group col-sm-12">
                <table class="table table-bordered table-hover table-striped tpedido" id="tableKit" style="display: none;margin-left: 15px;">
                    <thead>
                        <tr>
                            <th style="width: 6%;">#</th>
                            <th>Produto</th>
                            <th>Placa</th>
                            <th>Tarjeta</th>
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
            <div class="form-group col-sm-3">
                <?php echo $this->Form->input('desconto', array('readonly', 'type' => 'text', 'label' => 'Desconto', 'div' => 'col-sm-12', 'class' => 'maskMoney form-control')); ?>
                <?php echo $this->Form->input('usuario_desconto_id', array('type' => 'hidden', 'label' => false, 'div' => false)); ?>
            </div>
            <div class="form-group col-sm-6" style="margin-top: 30px;">
                <?php echo $this->Html->link('<i class="glyphicon glyphicon-asterisk"></i> ' . 'Informar senha para liberação', 'javascritp:;', array('style' => 'margin-left: 15px;', 'class' => 'alert alert-info', 'id' => 'liberar', 'data-toggle' => "modal", 'data-target' => ".bs-example-modal-sm", 'escape' => FALSE)) ?>
                <div class="alert alert-success col-sm-7" role="alert" id="liberado" style="margin-left: 15px;display:none;margin-bottom: 0;margin-top: -22px;"></div>
            </div>
            <br clear="all" />
            <div class="form-group col-sm-4" style="margin-left: 4px;">
                <?php echo $this->Form->radio('tipo', array(0 => 'A Vista', 1 => 'A Prazo'), array('value' => 0, 'disabled' => array('1'))); ?>
            </div>
            <br clear="all" />
            <hr />
            <div class="form-group col-sm-6">
                <?php echo $this->Form->input('observacao', array('type' => 'textarea', 'label' => 'Observação', 'rows' => '8', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <hr />
            <br clear="all" />
            <div class="form-group col-sm-12">
                <div class="col-sm-12 alert alert-danger" style="min-height: 52px;">
                    <input type="checkbox" name="data[Pedido][pendente]" value="1" id="PedidoPendente" style="float: left"/><strong style="float: left;padding-left: 5px;">Pedido Pendente</strong>
                </div>
            </div>
            <div class="form-group col-sm-12">
                <div class="col-sm-12 alert alert-warning" style="min-height: 52px;border: 1px #9e9200 solid!important;">
                    <i class="glyphicon glyphicon-warning-sign" style="float: left;padding: 2px 10px 0 0;"></i><input type="checkbox" value="1" id="cAtender" style="float: left"/><strong style="float: left;padding-left: 5px;">A Equipan tem a capacidade parar atender ?</strong>
                </div>
            </div>
            <?php echo $this->Form->end(); ?>
            <br clear="all" />
            <hr />
            <button id='bConfirmar' class="btn btn-success"><i class="glyphicon glyphicon-shopping-cart"></i> Gerar Pedido</button>
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-minus"></i> ' . 'Limpar pedido', 'add', array('class' => "btn btn-danger", 'escape' => FALSE), __('Deseja realmente limpar o pedido?')); ?>
        </div>
    </fieldset>
</div>


<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Autorização</h4>
            </div>
            <div class="modal-body">
                <?php echo $this->Form->create('Liberar'); ?>
                <?php echo $this->Form->input('usuario', array('label' => 'Usuário', 'type' => 'text', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
                <br clear="all" />
                <?php echo $this->Form->input('senha', array('label' => 'Senha', 'div' => 'col-sm-12', 'class' => 'form-control', 'type' => 'password')); ?>
                <?php echo $this->Form->end(); ?>
                <br clear="all" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="liberarDesconto">Liberar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>