<div class="niveis index">
    <h2><?php echo __('Estoques'); ?></h2>
    <?php echo $this->Form->create('Estoque', array("class" => "form-horizontal", 'id' => 'validate')); ?>
    <div class="col-sm-4" style="padding: 0;">
        <?php echo count($UnidadesLogadas) > 1 || $this->Session->read('Auth.User.nivel_id') == 1 ? $this->Form->input('unidade_id', array('label' => 'Unidade', 'class' => 'obrigatorio form-control', 'empty' => ' - Selecione a Unidade -', 'options' => $UnidadesLogadas)) : $this->Form->input('unidade_id', array('label' => 'Unidade', 'class' => 'obrigatorio form-control', 'options' => $UnidadesLogadas)); ?>
    </div>
    <div class="col-sm-4" style="margin-top: 25px;">
        <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-search"></i> Gerar Relatório</button>
    </div>
    <?php echo $this->Form->end(); ?>
    <br clear="all"/>
    <br clear="all"/>
    <?php if ($this->request->is('post')) { ?>
        <?php echo $this->Session->flash('estoque') ?> 
        <?php echo $this->Html->link('<i class="glyphicon glyphicon-print"></i> Imprimir', '/estoques/imprimir/', array('escape' => false, 'class' => 'btn btn-primary', 'target' => '_blank')) ?>
        <br />
        <br />
        <table class="TableJquery">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Quantidade</th>
                    <th>Minimo</th>
                    <th>Valor UN</th>
                    <th>Total</th>
            </thead>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Quantidade</th>
                    <th>Minimo</th>
                    <th>Valor UN</th>
                    <th>Total</th>
                </tr>
                <tr>
                    <th colspan="7" class="ts-pager form-horizontal">
                        <button type="button" class="btn first"><i class="icon-step-backward glyphicon glyphicon-step-backward"></i></button>
                        <button type="button" class="btn prev"><i class="icon-arrow-left glyphicon glyphicon-backward"></i></button>
                        <span class="pagedisplay"></span> <!-- this can be any element, including an input -->
                        <button type="button" class="btn next"><i class="icon-arrow-right glyphicon glyphicon-forward"></i></button>
                        <button type="button" class="btn last"><i class="icon-step-forward glyphicon glyphicon-step-forward"></i></button>
                        <select class="pagesize input-mini" title="Select page size">
                            <option selected="selected" value="50">50</option>
                            <option value="100">100</option>
                            <option value="150">150</option>
                            <option value="200">200</option>
                        </select>
                        <select class="pagenum input-mini" title="Select page number"></select>
                    </th>
                </tr>
            </tfoot>
            <tbody>
                <?php $total = 0.0 ?>
                <?php foreach ($estoques as $estoque) { ?>
                    <tr>
                        <td><?php echo $estoque['Estoque']['id']; ?>&nbsp;</td>
                        <td><?php echo $estoque['Produto']['nome'] ?>&nbsp;</td>
                        <td>
                            <?php echo $estoque['Estoque']['quantidade']; ?>&nbsp;
                            <?php if ($estoque['Estoque']['quantidade'] < $estoque['Produto']['minimo']) { ?>
                                <i class="glyphicon glyphicon-remove-sign" style="color:red"></i>
                            <?php } elseif (($estoque['Estoque']['quantidade'] - $estoque['Produto']['minimo']) <= 10) { ?>
                                <i class="glyphicon glyphicon-info-sign" style="color: #f0ad4e;"></i>
                            <?php } else { ?>
                                <i class="glyphicon glyphicon-ok-sign" style="color: green"></i>
                            <?php } ?>
                        </td>
                        <td><?php echo $estoque['Produto']['minimo']; ?>&nbsp;</td>
                        <td><?php echo number_format($estoque['Produto']['valor'], 2, ',', '.'); ?>&nbsp;</td>
                        <td><?php echo number_format($estoque['Estoque']['quantidade'] * $estoque['Produto']['valor'], 2, ',', '.'); ?>&nbsp;</td>
                    </tr>
                    <?php $total = ($estoque['Estoque']['quantidade'] * $estoque['Produto']['valor']) + $total ?>
                <?php } ?>
                    <tr>
                        <td  colspan="4"></td>
                        <td style="font-weight: bold;">Total:</td>
                        <td style="font-weight: bold;color:  red;">R$ <?php echo number_format($total, 2, ',', '.') ?>&nbsp;</td>
                    </tr>
            </tbody>
        </table>
    <?php } ?>
</div>
<script>
    $(window).load(function () {
        table();
    });
</script>