<div class="pedidos form confirmar">
    <?php echo $this->Form->create('Pedido', array("class" => "form-horizontal", 'action' => 'cadastrarLocaliza')); ?>
    <fieldset>
        <legend>Confirmar Pedido</legend>
        <div class="cliente">
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('cliente_id', array('readonly', 'type' => 'text', 'label' => 'Número', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <div class="form-group col-sm-4">
                <?php echo $this->Form->input('nome', array('readonly', 'type' => 'text', 'label' => 'Nome', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <br clear="all"/>
            <hr />
            <div class="form-group col-sm-12">
                <table class="table table-bordered table-hover table-striped tpedido" id="tableKit" style="margin-left: 15px;">
                    <thead>
                        <tr>
                            <th style="width: 6%;">#</th>
                            <th>Produto</th>
                            <th>Renavam</th>
                            <th>Placa</th>
                            <th>Tarjeta</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $placas = explode(',', $this->request->data['Pedido']['placas']);
                        $renavam = explode(',', $this->request->data['Pedido']['renavam']);
                        ?>
                        <?php foreach ($placas as $key => $placa) { ?>
                            <tr>
                                <td><input name="Produto[id][]" readonly value="<?php echo $this->request->data['Pedido']['kit']; ?>" ></td>
                                <td style="width: 45%;"><input name="Produto[Produto][]" readonly value="<?php echo $kit['Kit']['nome']; ?>" ></td>
                                <td><input name="Produto[renavam][]" readonly value="<?php echo $renavam[$key]; ?>" ></td>
                                <td><input name="Produto[placa][]" readonly value="<?php echo substr($placa, 0, 3) . '-' . substr($placa, 3, 5); ?>" ></td>
                                <td><input name="Produto[tarjeta][]" readonly value="<?php echo $this->request->data['Pedido']['tarjeta']; ?>" ></td>
                                <td><input name="Produto[valor][]" readonly value="<?php echo $this->request->data['Pedido']['valor']; ?>" ></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2">
                                <div class="td">Total de Placas: <span class="std"><?php echo $this->request->data['Pedido']['qtdTotal'] ?></span></div><br />
                                <div class="total">Valor Total: <span class="stotal">R$ <?php echo $this->request->data['Pedido']['Vtotal'] ?></span></div>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <br clear="all" />
            <hr />
            <label class="tipo">Tipo de Pedido</label>
            <div><p class="bg-danger aprazo col-sm-2">A Prazo</p></div>
            <br clear="all" />
            <hr />
            <div class="form-group col-sm-6">
                <?php echo $this->Form->input('observacao', array('readonly', 'type' => 'textarea', 'label' => 'Observação', 'rows' => '8', 'div' => 'col-sm-12', 'class' => 'form-control')); ?>
            </div>
            <br clear="all" />
            <hr />
            <?php echo $this->Form->input('tipo', array('type' => 'hidden', 'label' => false, 'div' => false, 'value' => 1)); ?>
            <?php echo $this->Form->input('unidade_id', array('type' => 'hidden', 'label' => false, 'div' => false)); ?>
            <?php echo $this->Form->input('created', array('type' => 'hidden', 'label' => false, 'div' => false)); ?>
            <?php echo $this->Form->input('desconto', array('type' => 'hidden', 'label' => false, 'div' => false)); ?>
            <?php echo $this->Form->input('valor', array('value' => $this->request->data['Pedido']['Vtotal'], 'type' => 'hidden', 'label' => false, 'div' => false)); ?>
            <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Confirmar Pedido</button>
            <?php echo $this->Form->postLink('<i class="glyphicon glyphicon-remove-sign"></i> ' . ' Cancelar Pedido', '/', array('class' => "btn btn-danger", 'escape' => FALSE), __('Deseja realmente cancelar o cadastro?')); ?>
        </div>
    </fieldset>
    <?php echo $this->Form->end(); ?>
</div>