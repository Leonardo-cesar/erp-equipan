<div class="pedidos form">
    <fieldset>
        <legend>Relatorio de Perda de Material</legend>
        <?php echo $this->Form->create('Perda', array("class" => "form-horizontal")); ?>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('dataInicial', array('type' => 'text', 'div' => 'col-sm-12', 'label' => 'De', 'class' => 'datepicker form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('dataFinal', array('type' => 'text', 'div' => 'col-sm-12', 'label' => 'Até', 'class' => 'datepicker form-control')); ?>
        </div>
        <div class="form-group col-sm-4">
            <?php echo count($UnidadesLogadas) > 1 || $this->Session->read('Auth.User.nivel_id') == 1 ? $this->Form->input('unidade_id', array('label' => 'Unidade', 'class' => 'form-control', 'div' => 'col-sm-12', 'empty' => ' - Todas -', 'options' => $UnidadesLogadas)) : $this->Form->input('unidade_id', array('label' => 'Unidade', 'div' => 'col-sm-12', 'class' => 'obrigatorio form-control', 'options' => $UnidadesLogadas)); ?>
        </div>
        <br clear="all"/>
        <div class="form-group col-sm-4">
            <?php echo $this->Form->input('produto_id', array('type' => 'select', 'empty' => ' - Todos -', 'div' => 'col-sm-12', 'label' => 'Produtos', 'class' => 'form-control')); ?>
        </div>
        <br clear="all"/>
        <button type="submit" class="btn btn-success" id="gerarPerda"><i class="glyphicon glyphicon-refresh"></i> Gerar</button>
        <br clear="all"/>
        <?php echo $this->Form->end(); ?>
        <div class="divPR form-group col-sm-12" style="display: none">
            <br clear="all"/>
            <hr />
            <br clear="all"/>
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-print"></i> Imprimir', '/Perdas/rimprimir/', array('escape' => false, 'class' => 'btn btn-primary', 'target' => '_blank')) ?>
            <?php echo $this->Html->link('<i class="glyphicon glyphicon glyphicon-download-alt"></i> Excel', '/Perdas/excelPerdas/', array('escape' => false, 'class' => 'btn btn-info', 'target' => '_blank')) ?>
            <br />
            <br />
            <table class='TableJquery' id="tablePerda">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Pedido</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Data</th>
                        <th>Motivo</th>
                        <th>Unidade</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Usuario</th>
                        <th>Pedido</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Data</th>
                        <th>Motivo</th>
                        <th>Unidade</th>
                    </tr>
                    <tr>
                        <th colspan="6" class="ts-pager form-horizontal">
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
                </tbody>
            </table>
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-print"></i> Imprimir Grafico', '/perdas/vgrafico/', array('escape' => false, 'class' => 'btn btn-primary', 'target' => '_blank')) ?>
            <div id="columnchart_values" style="width: 900px; height: 500px;"></div>
        </div>
    </fieldset>
</div>