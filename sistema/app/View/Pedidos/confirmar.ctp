<div class="pedidos form confirmar">
    <?php echo $this->Form->create('Pedido', array("class" => "form-horizontal", 'action' => 'cadastrar')); ?>
    <fieldset>
        <legend>Confirmar Pedido</legend>
        <div class="cliente">
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
            <?php if (isset($this->request->data['Pedido']['representante_id'])) { ?>
                <label style="color: red;font-size: 18px"><i>Representante</i></label><br />
                <div class="dv-representantes col-sm-6">
                    <?php
                    $representante = explode('#', $this->request->data['Pedido']['representante_id']);
                    echo '<strong>' . $representante[1] . '</strong>';
                    echo $this->Form->input('representante_id', array('type' => 'hidden', 'label' => false, 'div' => false, 'value' => $representante[0]));
                    ?>
                </div>
                <br clear="all"/>
                <hr />
            <?php } ?>
            <div class="form-group col-sm-12">
                <table class="table table-bordered table-hover table-striped tpedido" id="tableKit" style="margin-left: 15px;">
                    <thead>
                        <tr>
                            <th style="width: 6%;">#</th>
                            <th>Produto</th>
                            <th>Placa</th>
                            <th>Tarjeta</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($this->request->data['Produto']['id'] as $key => $produto) { ?>
                            <tr>
                                <td><input name="Produto[id][]" readonly value="<?php echo $produto; ?>" ></td>
                                <td style="width: 45%;"><input name="Produto[Produto][]" readonly value="<?php echo $this->request->data['Produto']['Produto'][$key]; ?>" ></td>
                                <td><input name="Produto[placa][]" readonly value="<?php echo $this->request->data['Produto']['placa'][$key]; ?>" ></td>
                                <td><input name="Produto[tarjeta][]" readonly value="<?php echo $this->request->data['Produto']['tarjeta'][$key]; ?>" ></td>
                                <td><input name="Produto[valor][]" readonly value="<?php echo $this->request->data['Produto']['valor'][$key]; ?>" ></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2">
                                <div class="total">Total: <span class="stotal">R$ <?php echo number_format($this->request->data['Pedido']['Vtotal'], 2, ',', '.') ?></span></div><br />
                                <div class="desconto">Desconto: <span class="sdesconto">R$ <?php echo $this->request->data['Pedido']['desconto'] != '' ? number_format($this->request->data['Pedido']['desconto'], 2, ',', '.') : '0,0' ?></span></div><br />
                                <div class="td">Total com Desconto: <span class="std">R$ <?php echo number_format($this->request->data['Pedido']['Vtotal'] - $this->request->data['Pedido']['desconto'], 2, ',', '.') ?></span></div>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <br clear="all" />
            <hr />
            <label class="tipo">Tipo de Pedido</label>
            <div><?php echo $this->request->data['Pedido']['tipo'] == 0 ? '<p class="bg-success avista col-sm-2">A Vista</p>' : '<p class="bg-danger aprazo col-sm-2">A Prazo</p>' ?></div>
            <br clear="all" />
            <hr />
            <div class="form-group col-sm-6">
                <?php echo $this->Form->input('observacao', array('readonly', 'type' => 'textarea', 'label' => 'Observação', 'rows' => '8', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <br clear="all" />
            <hr />
            <?php echo $this->Form->input('usuario_desconto_id', array('type' => 'hidden', 'label' => false, 'div' => false)); ?>
            <?php echo $this->Form->input('tipo', array('type' => 'hidden', 'label' => false, 'div' => false)); ?>
            <?php echo $this->Form->input('unidade_id', array('type' => 'hidden', 'label' => false, 'div' => false)); ?>
            <?php echo $this->Form->input('desconto', array('type' => 'hidden', 'label' => false, 'div' => false)); ?>
            <?php echo $this->Form->input('valor', array('value' => $this->request->data['Pedido']['Vtotal'], 'type' => 'hidden', 'label' => false, 'div' => false)); ?>
            <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Confirmar Pedido</button>
            <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-remove-sign"></i> ' . ' Cancelar Pedido', '/categorias', array('class' => "btn btn-danger", 'escape' => FALSE), __('Deseja realmente cancelar o cadastro?')); ?>
        </div>
    </fieldset>
    <?php echo $this->Form->end(); ?>
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